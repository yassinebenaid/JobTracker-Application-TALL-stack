<?php

namespace App\Http\Controllers;

use App\Services\JobService;
use Illuminate\Http\Request;

class ShowWishlistPageController extends Controller
{
    public function __invoke()
    {
        return view("wishlist.index")->with([
            "jobs" => JobService::wishlist()
        ]);
    }
}
