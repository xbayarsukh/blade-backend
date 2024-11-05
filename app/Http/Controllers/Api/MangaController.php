<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Chapter;
use App\Models\Slide;
use App\Models\Favourite;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use DB;

class MangaController extends Controller
{
    public function slide() {
        
        $slides = Slide::orderBy('created_at', 'DESC')->limit(3)->get();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $slides,
            
        ]); 
    }
    public function new(Request $request)
    {
        $token = $this->extractToken($request);
        $accessToken = PersonalAccessToken::findToken($token);
    
        $membershipDays = $premiumDays = 0;
        $mangas = $this->initializeMangaQuery($accessToken, $membershipDays, $premiumDays);
    
        $mangaData = $mangas->select(
            \DB::raw('MAX(mangas.id) as id'),
            \DB::raw('MAX(mangas.title) as title'),
            \DB::raw('MAX(mangas.translated_by) as translated_by'),
            \DB::raw('MAX(mangas.description) as description'),
            \DB::raw('MAX(mangas.image) as image'),
            \DB::raw('MAX(mangas.category_id) as category_id'),
            \DB::raw('MAX(mangas.type) as type'),
            \DB::raw('MAX(mangas.created_at) as created_at'),
            \DB::raw('MAX(mangas.updated_at) as updated_at'),
            \DB::raw('MAX(chapters.created_at) as latest_chapter_date'),
            \DB::raw('MAX(CAST(chapters.title as UNSIGNED)) as latest_chapter_count')
        )
        ->groupBy('mangas.id')
        ->orderBy('latest_chapter_date', 'DESC')
        ->limit(6)
        ->get();
    
        return $this->buildResponse($membershipDays, $premiumDays, $mangaData);
    }
    
    private function extractToken(Request $request)
    {
        $token = $request->header('Authorization');
        return $token && strpos($token, 'Bearer ') === 0 ? substr($token, 7) : null;
    }
    
    private function initializeMangaQuery($accessToken, &$membershipDays, &$premiumDays)
    {
        $mangas = Chapter::join('mangas', 'mangas.id', '=', 'chapters.manga_id');
    
        if (!$accessToken) {
            return $mangas->where('mangas.type', '!=', "premium");
        }
    
        $user = $accessToken->tokenable;
        $now = Carbon::now();
        $membershipDays = $now->diffInDays($user->membership ? Carbon::parse($user->membership) : $now->subDays(30));
        $premiumDays = $now->diffInDays($user->premium ? Carbon::parse($user->premium) : $now->subDays(30));
    
        if ($membershipDays > 0 && $premiumDays > 0) {
            return $mangas;
        }
    
        return $mangas->where('mangas.type', '!=', "premium");
    }
    
    private function buildResponse($membershipDays, $premiumDays, $mangaData)
    {
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $mangaData,
        ]);
    }
    public function ongoing() {
        $mangas = Manga::where('type', 'ongoing')->orderBy('created_at', 'DESC')->limit(6)->get();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $mangas
        ]); 
    }

    public function premium() {
        $mangas = Manga::where('type', 'premium')->orderBy('created_at', 'DESC')->get();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $mangas
        ]); 
    }

    public function finish() {
        $mangas = Manga::where('type', 'finished')->orderBy('created_at', 'DESC')->limit(6)->get();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $mangas
        ]); 
    }
    public function manga(Request $request, $id) {
        // Find the manga and eager load its chapters
        $manga = Manga::leftJoin('favourites', 'favourites.manga_id', 'mangas.id');
        $token = $this->extractToken($request);
        $accessToken = PersonalAccessToken::findToken($token);
        if ($accessToken) {
            $user = $accessToken->tokenable;
            $manga = $manga->where('favourites.user_id', $user->id);
        }
        $manga = $manga->with(['chapters' => function($query) {
            $query->orderByRaw('CAST(title as UNSIGNED), title Asc');
        }])->where('mangas.id', $id)->select('mangas.*', DB::raw('CASE WHEN favourites.id IS NOT NULL THEN true ELSE false END as is_favourite'))->first();

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $manga, 
        ]);
    }

    public function chapter(Request $request, $id) {
        $user = $request->user();

        $now = Carbon::now();
        $membershipDays = $now->diffInDays($user->membership ? Carbon::parse($user->membership) : $now->subDays(30));
        if ($membershipDays <= 0) {
            return response()->json([
                'success' => false,
                'status' => 301,
                'message' => 'Эрхээ сунгуулна уу.',
                'data' => [], 
            ]);
        }
        // Find the manga and eager load its chapters
        $chapter = Chapter::with(['images' => function($query) {
            $query->orderByRaw('CAST(count as UNSIGNED), count Asc');
        }])->find($id);
        
        if (isset($request->manga_id)) {
            $manga = Manga::find($request->manga_id);
            $manga->last_chapter_id = $id;
            $manga->save();   
        }

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $chapter, 
        ]);
    }

    public function favourite(Request $request, $id) {
        $status = $request->status;
        if ($status == 1) {
            $favourite = new Favourite;
            $favourite->manga_id = $id;
            $favourite->user_id = $request->user()->id;
            $favourite->save();
        }else{
            $favourite = Favourite::where('manga_id', $id);
            $favourite->delete();
        }
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $status, 
        ]);
    }

    public function favManga(Request $request) {
        $user = $request->user();
        $mangas = Favourite::join('mangas', 'favourites.manga_id', 'mangas.id')->orderBy('favourites.created_at', 'DESC')->select('mangas.*')->get();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => '',
            'data' => $mangas
        ]); 
    }
}