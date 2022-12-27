<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Application;
use App\Services\ApplicationService;
use Illuminate\Http\Request;

class ShowApplicationController extends Controller
{
    public function __invoke()
    {
        return view("main.show-application");
    }
}
// [
    // "application" => ApplicationService::applyAllAboutApplication($application)
    // ]
