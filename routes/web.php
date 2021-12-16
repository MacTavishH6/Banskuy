<?php

use App\Http\Controllers\FoundationProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ForumController;
use App\Http\Controllers\ReportController;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LOVController;

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

Route::get('/', function () {
    return redirect('/landingpage');
});

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/landingpage', [App\Http\Controllers\LandingPageController::class, 'index']);
Route::get('/Forum', [ForumController::class, 'Index']);
Route::get('/Forum/{DonationTypeID}', [ForumController::class, 'ForumWithCategory']);
Route::get('/ViewPost/{id}', [ForumController::class, 'PostDetail']);
Route::get('/VerifikasiEmail/{id}',[App\Http\Controllers\Auth\RegisterController::class, 'VerifikasiEmailUser']);
Route::get('/VerifikasiEmailFoundation/{id}',[App\Http\Controllers\Auth\RegisterController::class, 'VerifikasiEmailFoundation']);
Route::get('/verifyEmailSent',function(){
    return view('/Verification/verifyEmailSent');
});
Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'profile']);
Route::get('/foundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'foundationprofile']);


// Route::get('/email', function () {
//     Mail::to('fikrifadillah231@gmail.com')->send(new VerificationMail());
// });

// Route::get('/email', function () {
//     Mail::to('fikrifadillah231@gmail.com')->send(new VerificationMail());
// });

use App\Events\Message;
// Route::post('/sendMessage',function(Request $request){
//     event(new Message($request->input('username'),$request->input('message')));
// });

// Route::post('/sendMessage',[MessageController::class,'SendMessages']);

// Route::get('/chat',[MessageController::class,'Chat']);
// Route::post('/chatTo',[MessageController::class,'ChatTo']);
// Route::post('/getMessage',[MessageController::class,'GetMessage']);
// Route::post('/GetListUserMessage',[MessageController::class,'GetListUserMessage']);


Route::middleware(['auth:web,foundations'])->group(function () {


    Route::get('/getprovince', [App\Http\Controllers\LOVController::class, 'Province']);
    Route::get('/getcity/{id}', [App\Http\Controllers\LOVController::class, 'City']);
    Route::get('/getdonationtype', [App\Http\Controllers\LOVController::class, 'DonationType']);
    Route::get('/getdonationstatus', [App\Http\Controllers\LOVController::class, 'DonationStatus']);
    Route::post('/getpostlist', [App\Http\Controllers\LOVController::class, 'PostList']);


    Route::get('/GetDonationCategoryDetail/{DonationTypeID}', [ForumController::class, 'GetDonationCategoryDetail']);
    Route::post('/CreatePost', [ForumController::class, 'CreatePost']);

    
    Route::post('/PostComment/{id}', [ForumController::class, 'PostComment']);
    Route::post('/PostCommentFromForum/{id}', [ForumController::class, 'PostCommentFromForum']);
    Route::post('/PostReply/{Postid}/{id}', [ForumController::class, 'PostReply']);
    Route::get('/sendlike/{id}', [ForumController::class, 'SendLike']);
    Route::get('/Delete', [ForumController::class, 'TestDelete']);

    Route::get('/GetReportCategory', [ReportController::class, 'GetReportCategory']);
    Route::post('/MakeReport/{id}', [ReportController::class, 'MakeReport']);
    Route::post('/MakeReportUser', [ReportController::class, 'MakeReportUser']);



    Route::post('/sendMessage',[MessageController::class,'SendMessages']);

    Route::get('/SendNotification',[ForumController::class,'SendNotification']);
    Route::get('/GetListNotificationPost',[LOVController::class,'GetListNotificationPost']);
    Route::get('/GetUnReadNotificationPost',[LOVController::class,'GetUnReadNotificationPost']);
    Route::get('/chat',[MessageController::class,'Chat']);
    Route::post('/chatTo',[MessageController::class,'ChatTo']);
    Route::post('/getMessage',[MessageController::class,'GetMessage']);
    Route::post('/GetListUserMessage',[MessageController::class,'GetListUserMessage']);
});
