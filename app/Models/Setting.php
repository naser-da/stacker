<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description'
    ];

    protected $casts = [
        'value' => 'json'
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', 'company_settings')->first();
        if (!$setting) {
            return $default;
        }

        return $setting->value[$key] ?? $default;
    }

    public static function set($key, $value)
    {
        $setting = static::where('key', 'company_settings')->first();
        if (!$setting) {
            return null;
        }

        $settings = $setting->value;
        $settings[$key] = $value;
        $setting->value = $settings;
        $setting->save();

        return $setting;
    }
} 