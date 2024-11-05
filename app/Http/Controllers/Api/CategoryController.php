<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Category;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function categories() {
        $categories = Category::orderBy('title', 'ASC')->get();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $categories
        ]); 
    }

    public function category_manga(Request $request, $id)
    {
        $token = $this->extractToken($request);
        $accessToken = PersonalAccessToken::findToken($token);

        $membershipDays = $premiumDays = 0;
        $categoryQuery = $this->initializeCategoryQuery($accessToken, $membershipDays, $premiumDays, $id);

        $categoryData = $categoryQuery->select('mangas.*')->get();

        return $this->buildResponse($categoryData);
    }

    private function extractToken(Request $request)
    {
        $token = $request->header('Authorization');
        return $token && strpos($token, 'Bearer ') === 0 ? substr($token, 7) : null;
    }

    private function initializeCategoryQuery($accessToken, &$membershipDays, &$premiumDays, $categoryId)
    {
        $categoryQuery = Category::join('mangas', 'mangas.category_id', '=', 'categories.id')
            ->where('categories.id', $categoryId)
            ->select('mangas.*');

        if (!$accessToken) {
            return $categoryQuery->where('mangas.type', '!=', 'premium');
        }

        $user = $accessToken->tokenable;
        $now = Carbon::now();
        $membershipDays = $now->diffInDays($user->membership ? Carbon::parse($user->membership) : $now->subDays(30));
        $premiumDays = $now->diffInDays($user->premium ? Carbon::parse($user->premium) : $now->subDays(30));

        if ($membershipDays > 0 && $premiumDays > 0) {
            return $categoryQuery;
        }

        return $categoryQuery->where('mangas.type', '!=', 'premium');
    }

    private function buildResponse($categoryData)
    {
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $categoryData,
        ]);
    }

}