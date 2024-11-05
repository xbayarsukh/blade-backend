<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Category;
use App\Http\Controllers\OtherController;
use Illuminate\Support\Facades\Redirect;
use App\CustomClass\FireBasePushNotification;

class MangaController extends Controller
{
    private $fcmService;

    public function __construct()
    {
        $this->fcmService = new FireBasePushNotification();
    }

    public function index(Request $request) {
        $mangas = Manga::orderBy('id', 'DESC')->paginate(10);
        return view('manga.list', compact('mangas'));
    }

    public function create() {
        $categories = Category::all();
        return view('manga.add_edit', compact('categories'));
    }

    public function store(Request $request) {
        $manga = new Manga;
        $manga->title = $request->title;
        $manga->translated_by = $request->translated_by;
        $manga->description = $request->description;
        $manga->category_id = $request->category;
        $manga->type = $request->type;
        if ($request->file('image')) {
            $other = new OtherController;
            $manga->image = $other->getBase64Image($request->file('image'));
        }
        if($manga->save()){
            if($manga->type != "premium"){
                $title = "Манга нэмэгдлээ";
                $body = $manga->title . " манга шинээр нэмэгдлээ";
                $response = $this->fcmService->toTopic("all", $body, $title);
            }
        }
        return Redirect::route('manga-list')->with('message', 'Амжилттай нэмэгдлээ.');
    }

    public function edit($id) {
        $categories = Category::all();
        $manga = Manga::find($id);
        return view('manga.add_edit', compact('categories', 'manga'));
    }

    public function update(Request $request, $id) {
        $manga = Manga::find($id);
        $manga->title = $request->title;
        $manga->translated_by = $request->translated_by;
        $manga->description = $request->description;
        $manga->category_id = $request->category;
        $manga->type = $request->type;
        if ($request->file('image')) {
            $other = new OtherController;
            $manga->image = $other->getBase64Image($request->file('image'));
        }
        $manga->save();
        return Redirect::route('manga-list')->with('message', 'Амжилттай засагдлаа.');
    }

    public function destroy($id) {
        $manga = Manga::find($id);
        $manga->delete();
        return Redirect::route('manga-list')->with('message', 'Амжилттай устгагдлаа.');
    }
}