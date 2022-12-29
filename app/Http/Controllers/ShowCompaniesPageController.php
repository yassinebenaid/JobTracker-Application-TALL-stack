<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Http\Request;

class ShowCompaniesPageController extends Controller
{
    public function __invoke()
    {
        return view("companies.index");
    }
}
