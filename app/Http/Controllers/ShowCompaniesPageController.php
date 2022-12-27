<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowCompaniesPageController extends Controller
{
    public function __invoke()
    {
        return view("companies.index");
    }
}
