<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $woman_products = Product::where("type_id","=","1")->orderBy('id', 'asc')->take(4)->get();
        $man_products = Product::where("type_id", "=", "2")->orderBy('id', 'asc')->take(4)->get();
        $kid_products = Product::where("type_id", "=", "3")->orderBy('id', 'asc')->take(4)->get();
        $accessories_products = Product::where("type_id", "=", "4")->orderBy('id', 'asc')->take(4)->get();
        return view('front.index', compact("woman_products","man_products","kid_products","accessories_products"));
    }

    public function woman()
    {
        $products = Product::where("type_id","=","1")->orderBy('id', 'asc')->get();

        return view('front.woman', compact("products"));
    }

    public function man()
    {

        $products = Product::where("type_id", "=", "2")->orderBy('id', 'asc')->get();

        return view('front.man', compact("products"));
    }

    public function kid()
    {

        $products = Product::where("type_id", "=", "3")->orderBy('id', 'asc')->get();

        return view('front.kid', compact("products"));
    }

    public function accessories()
    {
        $products = Product::where("type_id", "=", "4")->orderBy('id', 'asc')->get();
        return view('front.accessories', compact("products"));
    }
    public function media()
    {

        return view('front.media');
    }

     public function product_detail($id)
    {
        $product = Product::with("product_images")->find($id);
        return view('front.product_detail', compact("product"));
    }

}
