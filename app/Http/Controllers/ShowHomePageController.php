<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowHomePageController extends Controller
{
    public function __invoke()
    {
        return view("main.home");
    }
}