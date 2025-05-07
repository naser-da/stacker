<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'company_settings'],
            [
                'key' => 'company_settings',
                'value' => json_encode([
                    'name' => 'Your Company Name',
                    'phone' => '',
                    'address' => '',
                    'logo' => '',
                    'invoice_prefix' => 'INV-',
                    'invoice_notes' => 'Thank you for your business!'
                ]),
                'type' => 'json',
                'group' => 'company',
                'label' => 'Company Settings',
                'description' => 'Company information and settings'
            ]
        );
    }
} 