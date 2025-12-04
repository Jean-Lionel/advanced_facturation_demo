<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvSetting extends Model
{
    use HasFactory;

    protected $table = 'env_settings';

    protected $fillable = ['key', 'value','description'];



    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $value;
    }

    public static function init()
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('env_settings')) {
            \Illuminate\Support\Facades\Schema::create('env_settings', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->text('value')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        $envFile = base_path('.env');
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                $parts = explode('=', $line, 2);
                if (count($parts) === 2) {
                    $key = trim($parts[0]);
                    $value = trim($parts[1]);
                    $value = trim($value, '"\'');

                    self::firstOrCreate(
                        ['key' => $key],
                        ['value' => $value]
                    );
                }
            }
        }
    }
}
