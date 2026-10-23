<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SystemModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'description',
        'icon',
        'category',
        'is_enabled',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public static function isEnabled(string $key): bool
    {
        return Cache::remember("module_enabled_{$key}", 3600, function () use ($key) {
            $module = static::where('key', $key)->first();
            return $module ? (bool) $module->is_enabled : true;
        });
    }

    public static function setModuleState(string $key, bool $enabled): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['is_enabled' => $enabled]
        );
        Cache::forget("module_enabled_{$key}");
    }
}
