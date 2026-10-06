<?php

namespace App\Services;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Throwable;

class DatabaseMigrationService
{
    protected function migrator(): Migrator
    {
        return app('migrator');
    }

    public function getMigrationFiles(): array
    {
        $this->migrator()->setConnection(config('database.default'));

        return $this->migrator()->getMigrationFiles([database_path('migrations')]);
    }

    public function getRanMigrations(): array
    {
        if (!Schema::hasTable('migrations')) {
            return [];
        }

        $this->migrator()->setConnection(config('database.default'));

        return $this->migrator()->getRepository()->getRan();
    }

    public function getPendingMigrations(): array
    {
        $files = $this->getMigrationFiles();
        $ran = $this->getRanMigrations();

        $pending = array_values(array_diff(array_keys($files), $ran));
        sort($pending);

        return array_map(function ($migration) use ($files) {
            return [
                'name' => $migration,
                'file' => $files[$migration],
            ];
        }, $pending);
    }

    public function getMissingTables(): array
    {
        $pending = $this->getPendingMigrations();
        $missing = [];

        foreach ($pending as $migration) {
            $analysis = $this->analyzeMigration($migration['file']);

            if ($analysis['type'] === 'create' && $analysis['table'] && !Schema::hasTable($analysis['table'])) {
                $missing[] = [
                    'table' => $analysis['table'],
                    'migration' => $migration['name'],
                ];
            }
        }

        return $missing;
    }

    public function runPendingMigrations(): array
    {
        $this->ensureMigrationsTable();

        $pendingBefore = $this->getPendingMigrations();

        if (empty($pendingBefore)) {
            return [
                'success' => true,
                'message' => 'Aucune migration en attente. La base de données est à jour.',
                'executed' => [],
                'skipped' => [],
                'failed' => [],
                'remaining' => [],
                'output' => '',
            ];
        }

        $executed = [];
        $skipped = [];
        $failed = [];
        $outputLines = [];

        foreach ($pendingBefore as $migration) {
            $result = $this->runSingleMigration($migration);

            $outputLines[] = $result['line'];

            if ($result['status'] === 'executed') {
                $executed[] = $migration['name'];
            } elseif ($result['status'] === 'skipped') {
                $skipped[] = [
                    'name' => $migration['name'],
                    'reason' => $result['reason'],
                ];
            } else {
                $failed[] = [
                    'name' => $migration['name'],
                    'error' => $result['reason'],
                ];
            }
        }

        $pendingAfter = $this->getPendingMigrations();
        $output = implode("\n", $outputLines);

        $messageParts = [];
        if (count($executed) > 0) {
            $messageParts[] = count($executed) . ' migration(s) exécutée(s)';
        }
        if (count($skipped) > 0) {
            $messageParts[] = count($skipped) . ' migration(s) ignorée(s) (déjà présentes)';
        }
        if (count($failed) > 0) {
            $messageParts[] = count($failed) . ' migration(s) en échec';
        }

        $message = empty($messageParts)
            ? 'Aucune action effectuée.'
            : implode(', ', $messageParts) . '.';

        return [
            'success' => empty($failed) && empty($pendingAfter),
            'message' => $message,
            'executed' => $executed,
            'skipped' => $skipped,
            'failed' => $failed,
            'remaining' => array_column($pendingAfter, 'name'),
            'output' => $output,
        ];
    }

    protected function runSingleMigration(array $migration): array
    {
        $name = $migration['name'];
        $file = $migration['file'];
        $analysis = $this->analyzeMigration($file);

        if ($analysis['action'] === 'skip') {
            $this->recordMigration($name);

            return [
                'status' => 'skipped',
                'reason' => $analysis['reason'],
                'line' => "IGNORÉ: {$name} — {$analysis['reason']}",
            ];
        }

        if ($analysis['type'] === 'alter' && !empty($analysis['missing_columns'])) {
            try {
                $added = $this->applyMissingColumnsFromFile($file, $analysis['table'], $analysis['missing_columns']);
                $this->recordMigration($name);

                $detail = empty($added)
                    ? 'colonnes déjà présentes'
                    : 'colonnes ajoutées: ' . implode(', ', $added);

                return [
                    'status' => 'executed',
                    'reason' => $detail,
                    'line' => "OK: {$name} — {$detail}",
                ];
            } catch (Throwable $e) {
                if ($this->isSkippableError($e)) {
                    $this->recordMigration($name);

                    return [
                        'status' => 'skipped',
                        'reason' => $this->shortError($e),
                        'line' => "IGNORÉ: {$name} — " . $this->shortError($e),
                    ];
                }
            }
        }

        try {
            $relativePath = 'database/migrations/' . basename($file);
            Artisan::call('migrate', [
                '--force' => true,
                '--path' => $relativePath,
            ]);

            $artisanOutput = trim(Artisan::output());

            return [
                'status' => 'executed',
                'reason' => 'migration exécutée',
                'line' => $artisanOutput ?: "OK: {$name}",
            ];
        } catch (Throwable $e) {
            if ($this->isSkippableError($e)) {
                if ($analysis['type'] === 'alter' && $analysis['table']) {
                    try {
                        $missing = $analysis['missing_columns'] ?: $this->getMissingColumns($file, $analysis['table']);
                        $added = $this->applyMissingColumnsFromFile($file, $analysis['table'], $missing);
                        $this->recordMigration($name);

                        $detail = empty($added)
                            ? 'structure déjà présente'
                            : 'colonnes ajoutées: ' . implode(', ', $added);

                        return [
                            'status' => 'skipped',
                            'reason' => $detail,
                            'line' => "IGNORÉ/RÉPARÉ: {$name} — {$detail}",
                        ];
                    } catch (Throwable $inner) {
                        // Continue to record as skipped if still skippable
                        if ($this->isSkippableError($inner)) {
                            $this->recordMigration($name);

                            return [
                                'status' => 'skipped',
                                'reason' => $this->shortError($inner),
                                'line' => "IGNORÉ: {$name} — " . $this->shortError($inner),
                            ];
                        }
                    }
                }

                $this->recordMigration($name);

                return [
                    'status' => 'skipped',
                    'reason' => $this->shortError($e),
                    'line' => "IGNORÉ: {$name} — " . $this->shortError($e),
                ];
            }

            return [
                'status' => 'failed',
                'reason' => $e->getMessage(),
                'line' => "ERREUR: {$name} — " . $e->getMessage(),
            ];
        }
    }

    protected function analyzeMigration(string $filePath): array
    {
        if (!file_exists($filePath)) {
            return ['action' => 'run', 'type' => 'unknown'];
        }

        $content = file_get_contents($filePath);

        if (preg_match("/Schema::create\(\s*['\"]([^'\"]+)['\"]/", $content, $matches)) {
            $table = $matches[1];

            if (Schema::hasTable($table)) {
                return [
                    'action' => 'skip',
                    'type' => 'create',
                    'table' => $table,
                    'reason' => "La table « {$table} » existe déjà.",
                ];
            }

            return ['action' => 'run', 'type' => 'create', 'table' => $table];
        }

        if (preg_match("/Schema::table\(\s*['\"]([^'\"]+)['\"]/", $content, $matches)) {
            $table = $matches[1];
            $columns = $this->extractColumnsFromMigration($content);

            if (!Schema::hasTable($table)) {
                return [
                    'action' => 'run',
                    'type' => 'alter',
                    'table' => $table,
                    'columns' => $columns,
                    'missing_columns' => $columns,
                ];
            }

            $missingColumns = $this->getMissingColumns($content, $table);

            if (empty($columns)) {
                return ['action' => 'run', 'type' => 'alter', 'table' => $table, 'columns' => [], 'missing_columns' => []];
            }

            if (empty($missingColumns)) {
                return [
                    'action' => 'skip',
                    'type' => 'alter',
                    'table' => $table,
                    'columns' => $columns,
                    'missing_columns' => [],
                    'reason' => "Toutes les colonnes de « {$table} » existent déjà.",
                ];
            }

            return [
                'action' => 'run',
                'type' => 'alter',
                'table' => $table,
                'columns' => $columns,
                'missing_columns' => $missingColumns,
            ];
        }

        return ['action' => 'run', 'type' => 'unknown'];
    }

    protected function getMissingColumns($contentOrFile, string $table): array
    {
        $content = is_file($contentOrFile) ? file_get_contents($contentOrFile) : $contentOrFile;
        $columns = $this->extractColumnsFromMigration($content);

        if (!Schema::hasTable($table)) {
            return $columns;
        }

        $existing = Schema::getColumnListing($table);

        return array_values(array_diff($columns, $existing));
    }

    protected function extractColumnsFromMigration(string $content): array
    {
        $columns = [];

        $patterns = [
            '/\$table->foreignId\(\s*[\'"]([^\'"]+)[\'"]\s*\)/',
            '/\$table->(string|text|integer|bigInteger|boolean|date|dateTime|timestamp|double|decimal|unsignedBigInteger|unsignedInteger|float|json|enum)\(\s*[\'"]([^\'"]+)[\'"]\s*\)/',
        ];

        if (preg_match_all($patterns[0], $content, $foreignMatches)) {
            $columns = array_merge($columns, $foreignMatches[1]);
        }

        if (preg_match_all($patterns[1], $content, $typeMatches, PREG_SET_ORDER)) {
            foreach ($typeMatches as $match) {
                $columns[] = $match[2];
            }
        }

        return array_values(array_unique($columns));
    }

    protected function applyMissingColumnsFromFile(string $filePath, string $tableName, array $onlyColumns = []): array
    {
        if (!Schema::hasTable($tableName)) {
            return [];
        }

        $content = file_get_contents($filePath);
        $added = [];

        preg_match_all(
            '/\$table->(foreignId|string|text|integer|bigInteger|boolean|date|dateTime|timestamp|double|decimal|unsignedBigInteger|unsignedInteger|float|json)\(\s*[\'"]([^\'"]+)[\'"]\s*\)([^;]*);/s',
            $content,
            $matches,
            PREG_SET_ORDER
        );

        foreach ($matches as $match) {
            $type = $match[1];
            $column = $match[2];
            $modifiers = $match[3] ?? '';

            if (!empty($onlyColumns) && !in_array($column, $onlyColumns, true)) {
                continue;
            }

            if (Schema::hasColumn($tableName, $column)) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $blueprint) use ($type, $column, $modifiers) {
                $columnBuilder = $blueprint->{$type}($column);

                if (str_contains($modifiers, 'nullable()')) {
                    $columnBuilder->nullable();
                }

                if (preg_match('/->after\(\s*[\'"]([^\'"]+)[\'"]\s*\)/', $modifiers, $afterMatch)) {
                    $columnBuilder->after($afterMatch[1]);
                }
            });

            $added[] = $column;
        }

        return $added;
    }

    protected function ensureMigrationsTable(): void
    {
        $this->migrator()->setConnection(config('database.default'));
        $repository = $this->migrator()->getRepository();

        if (!$repository->repositoryExists()) {
            $repository->createRepository();
        }
    }

    protected function recordMigration(string $name): void
    {
        $this->ensureMigrationsTable();
        $repository = $this->migrator()->getRepository();

        if (in_array($name, $repository->getRan(), true)) {
            return;
        }

        $repository->log($name, $repository->getNextBatchNumber());
    }

    protected function isSkippableError(Throwable $e): bool
    {
        if ($e instanceof QueryException) {
            $errorInfo = $e->errorInfo ?? [];
            $sqlState = $errorInfo[0] ?? '';
            if (in_array($sqlState, ['42S01', '42S21'], true)) {
                return true;
            }
        }

        $message = $e->getMessage();

        return str_contains($message, 'already exists')
            || str_contains($message, 'Duplicate column')
            || str_contains($message, 'Base table or view already exists')
            || str_contains($message, '42S01')
            || str_contains($message, '42S21')
            || str_contains($message, '1060');
    }

    protected function shortError(Throwable $e): string
    {
        $message = $e->getMessage();

        if (preg_match('/SQLSTATE\[([^\]]+)\][^:]*:\s*(\d+)?\s*(.+)$/m', $message, $matches)) {
            return trim($matches[3] ?? $message);
        }

        return \Illuminate\Support\Str::limit($message, 180);
    }

    protected function extractTableNameFromMigration(string $filePath): ?string
    {
        if (!file_exists($filePath)) {
            return null;
        }

        $content = file_get_contents($filePath);

        if (preg_match("/Schema::create\(\s*['\"]([^'\"]+)['\"]/", $content, $matches)) {
            return $matches[1];
        }

        if (preg_match("/Schema::table\(\s*['\"]([^'\"]+)['\"]/", $content, $matches)) {
            return $matches[1];
        }

        return null;
    }
}