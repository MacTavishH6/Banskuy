<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::middleware(['auth:web'])->group(function () {
    //Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'profile']);
    Route::get('/editprofile/{id}', [App\Http\Controllers\ProfileController::class, 'editprofile']);
    Route::get('/getprofile/{id}', [App\Http\Controllers\ProfileController::class, 'GetProfile']);

    Route::get('/makerequest/{id}', [App\Http\Controllers\TransactionController::class, 'MakeTransaction']);
    Route::get('/makerequestwithpost/{id}', [App\Http\Controllers\TransactionController::class, 'MakeTransactionWithPost']);
    Route::post('/getfoundationsearch', [App\Http\Controllers\TransactionController::class, 'GetFoundationSearch']);
    Route::post('/getfoundationbyid', [App\Http\Controllers\TransactionController::class, 'GetFoundationByID']);
    Route::post('/requesttransaction', [App\Http\Controllers\TransactionController::class, 'RequestTransaction']);
    Route::get('/donationhistory', [App\Http\Controllers\TransactionController::class, 'DonationHistory']);
    Route::post(
        '/getdonationhistory',
        [App\Http\Controllers\TransactionController::class, 'GetDonationHistory']
    );
    Route::post('/gettransactiondetail', [App\Http\Controllers\TransactionController::class, 'GetDonationHistoryDetail']);

    Route::Post('/UpdateProfilePicture', [App\Http\Controllers\ProfileController::class, 'UpdateProfilePicture']);

    Route::put('/updateprofile', [App\Http\Controllers\ProfileController::class, 'put']);
    Route::put('/updatebio', [App\Http\Controllers\ProfileController::class, 'updatebio']);

    Route::put('/changepassword', [App\Http\Controllers\ProfileController::class, 'ChangePassword']);

    Route::delete('/deleteprofilephoto', [App\Http\Controllers\ProfileController::class, 'DeleteProfilePhoto']);

    Route::get('/nextlevel/{id}', [App\Http\Controllers\LevelController::class, 'GetNextLevelInfo']);

    Route::post('/pdf_download', [App\Http\Controllers\GeneratePdfController::class, 'pdfDownload']);

    Route::delete('/Transaction/Delete', [App\Http\Controllers\TransactionController::class, 'DeleteTransaction']);

    // Route::get('/getprovince', [App\Http\Controllers\LOVController::class, 'Province']);
    // Route::get('/getcity/{id}', [App\Http\Controllers\LOVController::class, 'City']);
    // Route::get('/getdonationtype', [App\Http\Controllers\LOVController::class, 'DonationType']);
    // Route::get('/getdonationstatus', [App\Http\Controllers\LOVController::class, 'DonationStatus']);
    // Route::post('/getpostlist', [App\Http\Controllers\LOVController::class, 'PostList']);
});
