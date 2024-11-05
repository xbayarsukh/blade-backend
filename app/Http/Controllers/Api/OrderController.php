<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membership;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function memberships() {
        $memberships = Membership::where('type', 'month')->orderBy('title', 'ASC')->get();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $memberships,
        ]); 
    }
}