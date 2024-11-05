<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\WebSetting;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function index(Request $request) {
        $web_setting = WebSetting::find(1);
        return view('setting.index', compact('web_setting'));
    }

    public function update(Request $request) {
        $web_setting = WebSetting::find(1);
        $web_setting->site_name = $request->name;
        $web_setting->site_privacy = $request->privacy;
        $web_setting->site_about = $request->about;
        $web_setting->save();
        return Redirect::route('settings')->with('message', 'Амжилттай Засагдлаа.');
    }
}