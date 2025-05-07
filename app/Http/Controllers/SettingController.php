<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function show()
    {
        $setting = Setting::where('key', 'company_settings')->first();
        $settings = $setting ? json_decode($setting->value, true) : [];
        
        if (!is_array($settings)) {
            $settings = [];
        }
        
        return view('settings.show', compact('settings'));
    }

    public function edit()
    {
        $setting = Setting::where('key', 'company_settings')->first();
        $settings = $setting ? json_decode($setting->value, true) : [];
        
        if (!is_array($settings)) {
            $settings = [];
        }
        
        return view('settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $setting = Setting::where('key', 'company_settings')->first();
        if (!$setting) {
            return redirect()->back()->with('error', 'Settings not found');
        }

        $settings = json_decode($setting->value, true) ?: [];

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if (!empty($settings['logo'])) {
                Storage::delete(str_replace('/storage/', 'public/', $settings['logo']));
            }

            $path = $request->file('logo')->store('public/company');
            $settings['logo'] = Storage::url($path);
        }

        // Update other settings
        $settings['name'] = $request->input('name', $settings['name'] ?? '');
        $settings['phone'] = $request->input('phone', $settings['phone'] ?? '');
        $settings['address'] = $request->input('address', $settings['address'] ?? '');
        $settings['invoice_prefix'] = $request->input('invoice_prefix', $settings['invoice_prefix'] ?? 'INV-');
        $settings['invoice_notes'] = $request->input('invoice_notes', $settings['invoice_notes'] ?? '');

        $setting->value = json_encode($settings);
        $setting->save();

        return redirect()->route('settings.show')->with('success', 'Settings updated successfully');
    }
} 