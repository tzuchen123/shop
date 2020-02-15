<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;

class AdminController extends Controller
{
    public function index()
    {

        return view("admin.index");
    }

}
