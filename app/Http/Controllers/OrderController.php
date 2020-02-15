<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }


    public function content($order_id)
    {
        $order_items =  OrderItem::with("product")->with("order")->find($order_id)->get();
        $receiver_info = OrderItem::with("product")->with("order")->find($order_id)->first();

        return view('admin.orders.content', compact('order_items', "receiver_info"));
    }


    public function changeStatus($order_id)
    {
        //不能用get，因為get傳回collection(集合)，即使id只有一個
        //collection不能用save，

        $order = Order::find($order_id)->first();
        $order->status = "ship_done";
        $order->save();

        return redirect()->back();
    }


    public function select($status)
    {
        $orders = Order::where('status',$status)->get();
        return view('admin.orders.index',compact('orders'));
    }


    public function destroy(Request $request,$order_id)
    {


        $order = Order::find($order_id)->first();

        $order_items = OrderItem::where('order_id',"=",$order_id)->get();
        foreach($order_items as $item){
            $item->delete();
        }

        $order->delete();

        return redirect()->back();
    }

}
