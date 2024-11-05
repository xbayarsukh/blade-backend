<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppNotification;
use App\Models\WebSetting;

class AboutController extends Controller
{
    public function index() {
        $about = WebSetting::find(1);
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $about->site_about
        ]); 
    }

    public function notifications(Request $request) {
        $notifications = AppNotification::where('user_id', $request->user()->id)->orderBy('created_at', 'DESC')->get();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $notifications
        ]); 
    }
}