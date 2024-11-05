<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Http\Controllers\OtherController;
use Illuminate\Support\Facades\Redirect;

class ChapterController extends Controller
{
    public function index($manga_id) {
        $chapters = Chapter::leftjoin('chapter_images', 'chapter_images.chapter_id', 'chapters.id')
    ->where('manga_id', $manga_id)
    ->orderBy('chapters.created_at', 'DESC')
    ->groupBy('chapters.id', 'chapters.title', 'chapters.image', 'chapters.manga_id', 'chapters.created_at', 'chapters.updated_at')
    ->selectRaw('chapters.id, chapters.title, chapters.image, chapters.manga_id, chapters.created_at, chapters.updated_at, COUNT(chapter_images.id) as ccc')
    ->get();
        return view('chapter.list', compact('chapters', 'manga_id'));
    }

    public function create($manga_id) {
        return view('chapter.add_edit', compact('manga_id'));
    }

    public function store(Request $request, $manga_id) {
        $chapter = new Chapter;
        $chapter->title = $request->title;
        $chapter->manga_id = $manga_id;
        if ($request->file('image')) {
            $other = new OtherController;
            $chapter->image = $other->getBase64Image($request->file('image'));
        }
        $chapter->save();
        return Redirect::route('chapter-list', $manga_id)->with('message', 'Амжилттай нэмэгдлээ.');
    }

    public function edit($manga_id, $id) {
        $chapter = Chapter::where('manga_id', $manga_id)->where('id', $id)->first();
        return view('chapter.add_edit', compact('chapter', 'manga_id'));
    }

    public function update(Request $request, $manga_id, $id) {
        $chapter = Chapter::where('manga_id', $manga_id)->where('id', $id)->first();
        $chapter->title = $request->title;
        $chapter->manga_id = $manga_id;
        if ($request->file('image')) {
            $other = new OtherController;
            $chapter->image = $other->getBase64Image($request->file('image'));
        }
        $chapter->save();
        return Redirect::route('chapter-list', $manga_id)->with('message', 'Амжилттай засагдлаа.');
    }

    public function destroy($manga_id, $id) {
        $chapter = Chapter::find($id);
        $chapter->delete();
        return Redirect::route('chapter-list', $manga_id)->with('message', 'Амжилттай устгагдлаа.');
    }
}