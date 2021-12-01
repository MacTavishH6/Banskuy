<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/login', function () {
    return redirect('/foundationlogin');
});

Route::get('/register', function () {
    return redirect('/foundationregister');
});

Route::post('/registerfoundation', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.foundation');

Route::get('/foundationlogin', function () {
    return view('/auth/foundationLogin');
});

Route::get('/foundationregister', function () {
    return view('/auth/foundationRegister');
});

Route::post('/loginfoundation', [App\Http\Controllers\Auth\LoginController::class, 'loginfoundation']);

Route::middleware(['auth:foundations'])->group(function () {

    // Route::get('/foundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'foundationprofile']);

    Route::get('/editfoundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'editfoundationprofile']);
    //Route::get('/foundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'foundationprofile']);
    Route::get('/getfoundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'getfoundationprofile']);

    Route::put('/changepassword', [App\Http\Controllers\FoundationProfileController::class, 'ChangePassword']);

    Route::put('/updatefoundationprofile', [App\Http\Controllers\FoundationProfileController::class, 'put']);
    Route::put('/updatefoundationbio', [App\Http\Controllers\FoundationProfileController::class, 'updatebio']);

    Route::Post('/UpdateFoundationProfilePicture', [App\Http\Controllers\FoundationProfileController::class, 'UpdateProfilePicture']);
    Route::delete('/deleteprofilephoto', [App\Http\Controllers\FoundationProfileController::class, 'DeleteProfilePhoto']);

    
    Route::get('/donationapproval/{id}', [App\Http\Controllers\TransactionController::class, 'DonationApproval']);
    Route::post(
        '/getdonationapproval',
        [App\Http\Controllers\TransactionController::class, 'GetDonationApproval']
    );
    Route::post('/getdonationapprovaldetail', [App\Http\Controllers\TransactionController::class, 'GetDonationApprovalDetail']);
    Route::post('/updateapprovalstatus', [App\Http\Controllers\TransactionController::class, 'AcceptRejectDonationTransaction']);
    

    Route::post('/UpdateDocument',[App\Http\Controllers\FoundationProfileController::class, 'UploadDocument']); 
    Route::post('/ReUploadDocument',[App\Http\Controllers\FoundationProfileController::class, 'ReUploadDocument']); 
    Route::post('/GetListDocument',[App\Http\Controllers\FoundationProfileController::class, 'GetListDocument']); 
    Route::post('/GetDocumentDetail',[App\Http\Controllers\FoundationProfileController::class, 'GetDocumentDetail']); 

});
