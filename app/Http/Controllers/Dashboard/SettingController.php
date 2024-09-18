<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    
    public function index()
    {
        // Fetch the current setting from the database
        $settings = Setting::first();

        // Check if the user has permission to view the setting
        $this->authorize('view', $settings);

        // Show the setting page with the current settings
        return view('dashboard.settings', compact('settings'));
    }
    public function update(Request $request, Setting $setting) {
        $date = [
            'logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:2048'],
            'facebook' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
        ];
        
        foreach (config('app.languages') as $key) {
            $date[$key.'*.title'] = ['nullable', 'string'];
            $date[$key.'*.content'] = ['nullable', 'string'];
            $date[$key.'*.address'] = ['nullable', 'string'];
        }

        $validateDate = $request->validate($date);
        
        $setting->update($request->except('_token', 'favicon', 'logo'));

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $file_name = Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('dashboardImg'), $file_name);
            $path = 'dashboardImg/'.$file_name;
            $setting->update(['logo' => $path]);
        }
        if ($request->file('favicon')) {
            $file = $request->file('favicon');
            $file_name = Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('dashboardImg'), $file_name);
            $path = 'dashboardImg/'.$file_name;
            $setting->update(['favicon' => $path]);
        }
        return redirect()->route('dashboard.settings');
    }
}
