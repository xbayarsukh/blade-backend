<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Category;
use App\Models\WebSetting;
use App\Http\Controllers\OtherController;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Request $request) {
        $fav_mangas = Manga::select('mangas.id', 'mangas.title', 'mangas.translated_by', 'mangas.image')
        ->leftJoin('favourites', 'mangas.id', '=', 'favourites.manga_id')
        ->selectRaw('COUNT(favourites.id) as fav_count')
        ->groupBy('mangas.id', 'mangas.title', 'mangas.translated_by', 'mangas.image')
        ->orderByDesc('fav_count')
        ->limit(10)
        ->get();
        return view('dashboard', compact('fav_mangas'));
    }

    public function privacy() {
        $web_setting = WebSetting::find(1);
        return view('privacy', compact('web_setting'));
    }
}