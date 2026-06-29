<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::latest()->paginate(10);

        return view('admin.setting.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'route' => 'required|string|unique:settings,route',
            'title' => 'required|string|max:255',
        ]);

        Setting::create([
            'route' => '/'.ltrim($data['route'], '/'),
            'title' => $data['title'],
            'active' => true,
        ]);

        return back()->with('success', 'ثبت شد.');
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'active' => 'required|boolean',
        ]);

        $setting->update([
            'active' => $request->boolean('active'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'وضعیت با موفقیت تغییر یافت',
        ]);
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();

        return back();
    }
}
