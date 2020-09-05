<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\ProductType;
use Illuminate\Http\Request;


class TestController extends Controller
{
    public function testCarbon()
    {
        $date = Carbon::now();
        DD($date);
        return $date->format('yyyy-MM-dd HH:mm');
    }

    
    public function test()
    {
        $this->info('123');
        $type= ProductType::find(1);
        $activrType = ProductType::Active()->get();
        return view('test',compact('type','activrType'));
        // return view('test');
    }
}
