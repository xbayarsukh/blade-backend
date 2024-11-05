<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Membership;
use App\Models\User;
use App\Models\AppNotification;
use App\Http\Controllers\OtherController;
use Illuminate\Support\Facades\Redirect;
use App\CustomClass\FireBasePushNotification;
use Carbon\Carbon;

class OrderController extends Controller
{
    private $fcmService;

    public function __construct()
    {
        $this->fcmService = new FireBasePushNotification();
    }

    public function index(Request $request) {
        $orders = Order::orderBy('id', 'DESC')->paginate(10);
        return view('order.list', compact('orders'));
    }

    public function create() {
        $memberships = Membership::orderBy('id', 'DESC')->get();
        $users = User::orderBy('id', 'DESC')->get();
        return view('order.add', compact('memberships', 'users'));
    }

    public function store(Request $request) {
        $order = new Order;
        $bill_no = date('Ymd-his');
        $membership = Membership::find($request->membership_id);
        $order->order_no = $bill_no;
        $order->current_price = $membership->price;
        $order->type = $membership->type;
        $order->user_id = $request->user_id;
        $order->month = $membership->month;
        $order->save();
        return Redirect::route('order-list')->with('message', 'Амжилттай нэмэгдлээ.');
    }

    public function edit($id) {
        $order = Order::find($id);
        return view('order.show', compact('order'));
    }

    public function update_status(Request $request) {
        $order = Order::find($request->id);
        $order->payment_status = $request->status;
        if ($request->status == "paid") {
            $order->callback_verified = 1;
            $now = Carbon::now();
            if ($order->type == "premium") {
                $order->user->premium = $now->addMonths($order->month);
                $title = "Эрх сунгалт Premium";
                $body = $order->month . " сараар сунгагдлаа.";
                $response = $this->fcmService->to($order->user->device_id, $body, $title);
            }else{
                $order->user->membership = $now->addMonths($order->month);
                $title = "Эрх сунгалт";
                $body = $order->month . " сараар сунгагдлаа.";
                $response = $this->fcmService->to($order->user->device_id, $body, $title);
            }
            $checknotification = AppNotification::where('order_id', $order->id)->where('user_id', $order->user_id)->first();
            if ($checknotification) {
                $checknotification->is_active = 1;
                $checknotification->save();
            }else{
                $notification = new AppNotification;
                $notification->title = $title;
                $notification->description = $body;
                $notification->user_id = $order->user_id;
                $notification->order_id = $order->id;
                $notification->save();
            }
        }else{
            if ($order->type == "premium") {
                $date = Carbon::parse($order->user->premium);
                $order->user->premium = $date->subMonths($order->month);
            }else{
                $date = Carbon::parse($order->user->membership);
                $order->user->membership = $date->subMonths($order->month);
            }
            $notification = AppNotification::where('order_id', $order->id)->first();
            $notification->is_active = 0;
            $notification->save();
        }
        $order->user->save();
        $order->save();
        return $order->payment_status;
    }
}