<?php

use App\Http\Controllers\FoundationProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ForumController;
use App\Http\Controllers\ReportController;

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

Route::get('/', function () {
    return redirect('/landingpage');
});

Route::get('/logout', function () {
    Auth::logout();
});

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/landingpage', [App\Http\Controllers\LandingPageController::class, 'index']);


Route::middleware(['auth:web,foundations'])->group(function () {

    Route::get('/getprovince', [App\Http\Controllers\LOVController::class, 'Province']);
    Route::get('/getcity/{id}', [App\Http\Controllers\LOVController::class, 'City']);
    Route::get('/getdonationtype', [App\Http\Controllers\LOVController::class, 'DonationType']);
    Route::get('/getdonationstatus', [App\Http\Controllers\LOVController::class, 'DonationStatus']);
    Route::post('/getpostlist', [App\Http\Controllers\LOVController::class, 'PostList']);

    Route::get('/Forum', [ForumController::class, 'Index']);
    Route::get('/Forum/{DonationTypeID}', [ForumController::class, 'ForumWithCategory']);
    Route::get('/GetDonationCategoryDetail/{DonationTypeID}', [ForumController::class, 'GetDonationCategoryDetail']);
    Route::post('/CreatePost', [ForumController::class, 'CreatePost']);

    Route::get('/ViewPost/{id}', [ForumController::class, 'PostDetail']);
    Route::post('/PostComment/{id}', [ForumController::class, 'PostComment']);
    Route::post('/PostReply/{Postid}/{id}', [ForumController::class, 'PostReply']);
    Route::get('/sendlike/{id}', [ForumController::class, 'SendLike']);
    Route::get('/Delete', [ForumController::class, 'TestDelete']);

    Route::get('/GetReportCategory', [ReportController::class, 'GetReportCategory']);
    Route::post('/MakeReport/{id}', [ReportController::class, 'MakeReport']);
});
