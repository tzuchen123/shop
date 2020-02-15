<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function orders()
    {
        $user_id = auth()->user()->id;
        $orders = Order::with("orderItems")->with("user")->where("user_id","=", $user_id )->get();
        return view('front.user_info.index', compact("orders"));
    }

    // public function order_detail($order_id)
    // {
    //     $order = Order::with("orderItems")->with("user")->get();
    //     return view('admin.user_info.index', compact("order"));
    // }

    public function information()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id)->first();
        return view('front.user_info.information', compact("user"));
    }
}
