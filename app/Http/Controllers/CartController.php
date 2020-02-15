<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderItem;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use TsaiYiHua\ECPay\Checkout;
use Illuminate\Support\Facades\Auth;
use TsaiYiHua\ECPay\Services\StringService;
use TsaiYiHua\ECPay\Collections\CheckoutResponseCollection;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function __construct(Checkout $checkout, CheckoutResponseCollection $checkoutResponse)
    {
        $this->checkout = $checkout;
        $this->checkoutResponse = $checkoutResponse;
    }

    //加入購物車
    public function add_product_to_cart(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        \Cart::add(array( 
            'id' => $product_id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array()
        ));

        if (Auth::check()) {
            $userId = auth()->user()->id; // or any string represents user identifier
            \Cart::session($userId)->add($product_id, $product->name, $product->price, 1, array());
        }

        $cartTotalQuantity = \Cart::getTotalQuantity();
        return  $cartTotalQuantity;
    }

    //購物車清單頁
    public function cart()
    {
        $cartCollection_old = \Cart::getContent();
        $userId = auth()->user()->id;

        foreach ($cartCollection_old as $item) {
            $product_id = $item->id;
            $prduct_name = $item->name;
            $prduct_price = $item->price;
            $prduct_quantity = $item->quantity;
            \Cart::remove($product_id);
            \Cart::session($userId)->add($product_id, $prduct_name, $prduct_price,  $prduct_quantity, array());
        }

        $content = \Cart::session($userId)->getContent()->sort();
        $total = \Cart::session($userId)->getTotal();

        return view('front.cart.index', compact("total", "content"));
    }

    //更改購物車產品數量
    public function ajex_new_quantity(Request $request)
    {
        $product_id = $request->product_id;
        $product_quantity = $request->new_quantity;

        $userId = auth()->user()->id; // or any string represents user identifier
        \Cart::session($userId)->update($product_id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $product_quantity
            ),
        ));

        return "Success";
    }
    //刪除購物車物品
    public function ajex_delete_item_in_cart(Request $request)
    {
        $product_id = $request->product_id;

        $userId = auth()->user()->id; // or any string represents user identifier
        \Cart::session($userId)->remove($product_id);

        return "Success";
    }

    //確認結帳/填寫資料頁
    public function cart_check_out()
    {


        $userId = auth()->user()->id;
        $content = \Cart::session($userId)->getContent()->sort();
        $total = \Cart::session($userId)->getTotal();

        return view("front.cart.check_out", compact('content', 'total'));
    }

    //結帳
    public function send_check_out(Request $request)
    {
        //驗證資料
        $input = $request->all();
        $rules = [
            'receive_mobile' => "required|min:9|max:11",
        ];
        $messages = [
            'receive_mobile.min' => '手機號碼錯誤',
            'receive_mobile.max' => '手機號碼錯誤',
        ];

        $result = Validator::make($input, $rules, $messages);

        if ($result->fails()) {
            return redirect("/cart_check_out")
                ->withErrors($result);
        }


        //建立訂單(orders)
        //抓顧客填的資料要存到table order
        //但order_no/total_price/user_id，要自己填
        $request_data = $request->all();

        $userId = auth()->user()->id;
        $total = \Cart::session($userId)->getTotal();

        $request_data["order_no"] = 'shop' . Carbon::now()->format('YmdHis');
        $request_data["total_price"] = $total;
        $request_data["user_id"] = $userId;
        $new_order = Order::create($request_data);

        $order_id = $new_order->id;

        //建立訂單清單(order_items)
        //把購物車資料存到table order_items
        $cart_contents = \Cart::session($userId)->getContent()->sort();

        $items = [];
        foreach ($cart_contents as $item) {
            //在table order_items插入一行
            $order_item = new OrderItem();
            $order_item->order_id = $order_id;
            $order_item->product_id = $item->id;
            $order_item->quantity = $item->quantity;
            $order_item->save();
            $product = Product::find($item->id);
            $product_name = $product->name;
            $new_ary = [
                'name' => $product_name,
                'qty' => $item->quantity,
                'price' => $item->price,
                'unit' => '個'
            ];

            array_push($items, $new_ary);
        }

        //第三方支付
        $formData = [
            'UserId' => 1, // 用戶ID , Optional
            'ItemDescription' => '產品簡介',
            'Items' => $items,
            'OrderId' => 'shop' . Carbon::now()->format('YmdHis'),
            'PaymentMethod' => 'Credit', // ALL, Credit, ATM, WebATM
        ];

        //清空購物車
        \Cart::session($userId)->clear();

        //送訂單給綠界
        return $this->checkout->setNotifyUrl(route('notify'))->setReturnUrl(route('return'))->setPostData($formData)->send();
    }


    public function notifyUrl(Request $request)
    {
        //當消費者付款完成後，綠界會將付款結果參數以幕後(Server POST)回傳到該網址。
        //判斷檢查碼是否相符
        $serverPost = $request->post();
        $checkMacValue = $request->post('CheckMacValue');
        unset($serverPost['CheckMacValue']);
        $checkCode = StringService::checkMacValueGenerator($serverPost);
        if ($checkMacValue == $checkCode) {
            //檢查碼相符後，回應 1|OK
            return '1|OK';
        } else {
            return '0|FAIL';
        }
    }

    public function returnUrl(Request $request)
    {
        //付款完成後，綠界會將付款結果參數以幕前(Client POST)回傳到該網址
        //判斷檢查碼是否相符
        $serverPost = $request->post();
        $checkMacValue = $request->post('CheckMacValue');
        unset($serverPost['CheckMacValue']);
        $checkCode = StringService::checkMacValueGenerator($serverPost);
        if ($checkMacValue == $checkCode) {
            if (!empty($request->input('redirect'))) {
                return redirect($request->input('redirect'));
            } else {
                //收到顧客付款完成，把訂單狀態改為已付款
                $MerchantTradeNo = $serverPost['MerchantTradeNo'];
                $order = Order::where('order_no', $MerchantTradeNo)->first();
                $order->status = 'payment_done';
                $order->save();

                //導回我們自己的網頁
                return redirect("/cart_success/{$MerchantTradeNo}");
            }
        }
    }

    public function cart_success($MerchantTradeNo)
    {
        //付款結果顯示頁
        $order = Order::where('order_no', $MerchantTradeNo)->first();
        return view("front.cart.succes", compact('order'));
    }
}
