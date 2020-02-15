<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testCarbon()
    {
        $date = Carbon::now();
        DD($date);
        return $date->format('yyyy-MM-dd HH:mm');
    }
}
