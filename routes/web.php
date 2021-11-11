<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();


Route::get('/landingpage', [App\Http\Controllers\LandingPageController::class, 'index']);

Route::get('/', function () {
    return redirect('/landingpage');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'profile']);
    Route::get('/editprofile/{id}', [App\Http\Controllers\ProfileController::class, 'editprofile']);
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::view('/Forum','Forum/Forum');

// Route::view('/ViewForum','Forum/ViewForum');

// Route::view('/ViewThread','Forum/ViewThread');

// Route::view('/Profile','Profile/profile');
