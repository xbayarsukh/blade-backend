<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Membership;
use App\Http\Controllers\OtherController;
use Illuminate\Support\Facades\Redirect;

class MembershipController extends Controller
{
    public function index(Request $request) {
        $memberships = Membership::orderBy('id', 'DESC')->paginate(10);
        return view('membership.list', compact('memberships'));
    }

    public function create() {
        return view('membership.add_edit');
    }

    public function store(Request $request) {
        $membership = new Membership;
        $membership->title = $request->title;
        $membership->month = $request->month;
        $membership->description = $request->description;
        $membership->price = $request->price;
        $membership->type = $request->type;
        $membership->save();
        return Redirect::route('membership-list')->with('message', 'Амжилттай нэмэгдлээ.');
    }

    public function edit($id) {
        $membership = Membership::find($id);
        return view('membership.add_edit', compact('membership'));
    }

    public function update(Request $request, $id) {
        $membership = Membership::find($id);
        $membership->title = $request->title;
        $membership->month = $request->month;
        $membership->description = $request->description;
        $membership->price = $request->price;
        $membership->type = $request->type;
        $membership->save();
        return Redirect::route('membership-list')->with('message', 'Амжилттай засагдлаа.');
    }

    public function destroy($id) {
        $membership = Membership::find($id);
        $membership->delete();
        return Redirect::route('membership-list')->with('message', 'Амжилттай устгагдлаа.');
    }
}