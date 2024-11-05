<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Manga;
use App\Http\Controllers\OtherController;
use Illuminate\Support\Facades\Redirect;

class SlideController extends Controller
{
    public function index(Request $request) {
        $slides = Slide::orderBy('id', 'DESC')->paginate(10);
        return view('slide.list', compact('slides'));
    }

    public function create() {
        $mangas = Manga::orderBy('title', 'ASC')->get();
        return view('slide.add_edit', compact('mangas'));
    }

    public function store(Request $request) {
        $slide = new Slide;
        $slide->manga_id = $request->manga_id;
        if ($request->file('image')) {
            $other = new OtherController;
            $slide->image = $other->getBase64Image($request->file('image'));
        }
        $slide->save();
        return Redirect::route('slide-list')->with('message', 'Амжилттай нэмэгдлээ.');
    }

    public function edit($id) {
        $slide = Slide::find($id);
        $mangas = Manga::orderBy('title', 'ASC')->get();
        return view('slide.add_edit', compact('slide', 'mangas'));
    }

    public function update(Request $request, $id) {
        $slide = Slide::find($id);
        $slide->manga_id = $request->manga_id;
        if ($request->file('image')) {
            $other = new OtherController;
            $slide->image = $other->getBase64Image($request->file('image'));
        }
        $slide->save();
        return Redirect::route('slide-list')->with('message', 'Амжилттай засагдлаа.');
    }

    public function destroy($id) {
        $slide = Slide::find($id);
        $slide->delete();
        return Redirect::route('slide-list')->with('message', 'Амжилттай устгагдлаа.');
    }
}