<?php

use App\Http\Controllers\ShowHomePageController;
use App\Http\Livewire\User\CompleteRegistration;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(["auth", "completed"])->group(function () {

    Route::get('/', ShowHomePageController::class)->name('home');

    Route::middleware('not_completed')->get("/register/complete", CompleteRegistration::class)->name("complete-registration");
});

require __DIR__ . '/auth.php';
