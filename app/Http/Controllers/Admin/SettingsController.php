<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index() {
        return view('admin.settings.index');
    }

    public function edit() {
        $settings = Storage::get('settings.json');
        return view('admin.settings.form', ['settings' => json_decode($settings)]);
    }

    public function update(Request $request) {
        Storage::put('settings.json', json_encode($request->all()));
        return response()->json(['settings' => json_encode($request->all())]);
    }
}
