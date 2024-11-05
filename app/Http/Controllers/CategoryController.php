<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\OtherController;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('category.list', compact('categories'));
    }

    public function create() {
        return view('category.add_edit');
    }

    public function store(Request $request) {
        $category = new Category;
        $category->title = $request->title;
        if ($request->file('image')) {
            $other = new OtherController;
            $category->image = $other->getBase64Image($request->file('image'));
        }
        $category->save();
        return Redirect::route('category-list')->with('message', 'Амжилттай нэмэгдлээ.');
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('category.add_edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);
        $category->title = $request->title;
        if ($request->file('image')) {
            $other = new OtherController;
            $category->image = $other->getBase64Image($request->file('image'));
        }
        $category->save();
        return Redirect::route('category-list')->with('message', 'Амжилттай засагдлаа.');
    }

    public function destroy($id) {
        $category = Category::find($id);
        $category->delete();
        return Redirect::route('category-list')->with('message', 'Амжилттай устгагдлаа.');
    }
}