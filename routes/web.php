<?php

use App\Http\Controllers\FoundationProfileController;
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

Route::get('/', function () {
    return redirect('/landingpage');
});

Route::get('/logout',function () {Auth::logout();});

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/landingpage', [App\Http\Controllers\LandingPageController::class, 'index']);


Route::middleware(['auth:web'])->group(function () {
    Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'profile']);
    Route::get('/editprofile/{id}', [App\Http\Controllers\ProfileController::class, 'editprofile']);
    Route::get('/getprofile/{id}', [App\Http\Controllers\ProfileController::class, 'GetProfile']);

    Route::get('/makerequest/{id}', [App\Http\Controllers\TransactionController::class, 'MakeTransaction']);
    Route::post('/getfoundationsearch', [App\Http\Controllers\TransactionController::class, 'GetFoundationSearch']);
    Route::post('/getfoundationbyid', [App\Http\Controllers\TransactionController::class, 'GetFoundationByID']);
    Route::post('/requesttransaction', [App\Http\Controllers\TransactionController::class, 'RequestTransaction']);
    Route::get('/donationhistory', [App\Http\Controllers\TransactionController::class, 'DonationHistory']);
    Route::post('/getdonationhistory',
    [App\Http\Controllers\TransactionController::class, 'GetDonationHistory']);
    Route::post('/gettransactiondetail', [App\Http\Controllers\TransactionController::class, 'GetDonationHistoryDetail']);

    Route::Post('/UpdateProfilePicture', [App\Http\Controllers\ProfileController::class, 'UpdateProfilePicture']);

    Route::put('/updateprofile', [App\Http\Controllers\ProfileController::class, 'put']);
    Route::put('/updatebio', [App\Http\Controllers\ProfileController::class, 'updatebio']);

    Route::put('/changepassword', [App\Http\Controllers\ProfileController::class, 'ChangePassword']);

    Route::delete('/deleteprofilephoto', [App\Http\Controllers\ProfileController::class, 'DeleteProfilePhoto']);

    Route::get('/nextlevel/{id}', [App\Http\Controllers\LevelController::class, 'GetNextLevelInfo']);

    Route::get('/getprovince', [App\Http\Controllers\LOVController::class, 'Province']);
    Route::get('/getcity/{id}', [App\Http\Controllers\LOVController::class, 'City']);
    Route::get('/getdonationtype', [App\Http\Controllers\LOVController::class, 'DonationType']);
    Route::get('/getdonationstatus', [App\Http\Controllers\LOVController::class, 'DonationStatus']);
    Route::post('/getpostlist', [App\Http\Controllers\LOVController::class, 'PostList']);
});

// untuk get

Route::get('/rafli', function () {
    return view('Transaction.transactionapproval');
    
});

// ROUTE BUAT FOUNDATION PROFILE LOGIN DLL
Route::get('/foundationlogin', function(){
    return view('/auth/foundationLogin');
});

Route::post('/loginfoundation', [App\Http\Controllers\Auth\LoginController::class, 'loginfoundation']);

Route::get('/foundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'foundationprofile']);
Route::get('/editfoundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'editfoundationprofile']);
Route::get('/getfoundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'getfoundationprofile']);

Route::get('/getprovince', [App\Http\Controllers\LOVController::class, 'Province']);
Route::get('/getcity/{id}', [App\Http\Controllers\LOVController::class, 'City']);
Route::put('/changepassword', [App\Http\Controllers\FoundationProfileController::class, 'ChangePassword']);

Route::put('/updatefoundationprofile', [App\Http\Controllers\FoundationProfileController::class, 'put']);
Route::put('/updatefoundationbio', [App\Http\Controllers\FoundationProfileController::class, 'updatebio']);

Route::Post('/UpdateFoundationProfilePicture', [App\Http\Controllers\FoundationProfileController::class, 'UpdateProfilePicture']);
Route::delete('/deleteprofilephoto', [App\Http\Controllers\FoundationProfileController::class, 'DeleteProfilePhoto']);


Route::get('/editfoundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'editfoundationprofile']);
//BATAS ROUTE PROFILE FOUNDATION


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::view('/Forum','Forum/Forum');

// Route::view('/ViewForum','Forum/ViewForum');

// Route::view('/ViewThread','Forum/ViewThread');

// Route::view('/Profile','Profile/profile');
