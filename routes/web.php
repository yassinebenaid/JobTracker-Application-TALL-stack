<?php

use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/edcuation', [ProfileController::class, 'updateEducation'])->name('profile.education.update');
    Route::patch('/profile/job', [ProfileController::class, 'updateJob'])->name('profile.job.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('resume/preview', [ProfileController::class, "showResume"])->name('resume.preview');
    Route::get('resume/download', [ProfileController::class, "downloadResume"])->name('resume.download');
});
require __DIR__ . '/auth.php';
