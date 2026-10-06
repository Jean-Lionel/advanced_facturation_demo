<?php

namespace App\Http\Controllers;

use App\Models\EnvSetting;
use App\Services\DatabaseMigrationService;
use Illuminate\Http\Request;

class EnvSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        EnvSetting::init();

        $query = EnvSetting::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('key', 'like', "%{$search}%")
                  ->orWhere('value', 'like', "%{$search}%");
        }

        $settings = $query->paginate(10);

        $migrationService = app(DatabaseMigrationService::class);
        $pendingMigrations = $migrationService->getPendingMigrations();
        $missingTables = $migrationService->getMissingTables();
        $ranMigrationsCount = count($migrationService->getRanMigrations());
        $totalMigrationsCount = count($migrationService->getMigrationFiles());

        return view('env_settings.index', compact(
            'settings',
            'pendingMigrations',
            'missingTables',
            'ranMigrationsCount',
            'totalMigrationsCount'
        ));
    }

    public function runMigrations(DatabaseMigrationService $migrationService)
    {
        $result = $migrationService->runPendingMigrations();

        $flashType = empty($result['failed']) ? 'success' : 'error';

        return redirect()
            ->route('env_settings.index')
            ->with($flashType, $result['message'])
            ->with('migration_output', $result['output'])
            ->with('migration_executed', $result['executed'] ?? [])
            ->with('migration_skipped', $result['skipped'] ?? [])
            ->with('migration_failed', $result['failed'] ?? [])
            ->with('migration_remaining', $result['remaining'] ?? []);
    }

    public function create()
    {
        return view('env_settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:env_settings,key',
            'value' => 'nullable',
        ]);

        $setting = EnvSetting::create($request->all());
        $this->updateEnvFile($setting->key, $setting->value);

        return redirect()->route('env_settings.index')->with('success', 'Setting created successfully.');
    }

    public function edit(EnvSetting $envSetting)
    {
        return view('env_settings.edit', compact('envSetting'));
    }

    public function update(Request $request, EnvSetting $envSetting)
    {
        $request->validate([
            'value' => 'nullable',
        ]);

        $envSetting->update($request->only('value'));
        $this->updateEnvFile($envSetting->key, $envSetting->value);

        return redirect()->route('env_settings.index')->with('success', 'Setting updated successfully.');
    }

    public function destroy(EnvSetting $envSetting)
    {
        $key = $envSetting->key;
        $envSetting->delete();
        $this->removeEnvKey($key);

        return redirect()->route('env_settings.index')->with('success', 'Setting deleted successfully.');
    }

    protected function updateEnvFile($key, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $content = file_get_contents($path);
            $value = '"' . addslashes($value) . '"';

            if (strpos($content, "{$key}=") !== false) {
                $pattern = "/^{$key}=.*/m";
                $replacement = "{$key}={$value}";
                $content = preg_replace($pattern, $replacement, $content);
            } else {
                $content .= "\n{$key}={$value}";
            }

            file_put_contents($path, $content);
        }
    }

    protected function removeEnvKey($key)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $content = file_get_contents($path);
            $pattern = "/^{$key}=.*\n?/m";
            $content = preg_replace($pattern, '', $content);
            file_put_contents($path, $content);
        }
    }
}
