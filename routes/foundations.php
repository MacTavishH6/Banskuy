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
    Route::get('/rafli', function () {
        return view('Transaction.transactionapproval');
    });

    Route::get('/foundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'foundationprofile']);

    Route::get('/editfoundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'editfoundationprofile']);
    Route::get('/foundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'foundationprofile']);
    Route::get('/editfoundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'editfoundationprofile']);
    Route::get('/getfoundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'getfoundationprofile']);

    Route::put('/changepassword', [App\Http\Controllers\FoundationProfileController::class, 'ChangePassword']);

    Route::put('/updatefoundationprofile', [App\Http\Controllers\FoundationProfileController::class, 'put']);
    Route::put('/updatefoundationbio', [App\Http\Controllers\FoundationProfileController::class, 'updatebio']);

    Route::Post('/UpdateFoundationProfilePicture', [App\Http\Controllers\FoundationProfileController::class, 'UpdateProfilePicture']);
    Route::delete('/deleteprofilephoto', [App\Http\Controllers\FoundationProfileController::class, 'DeleteProfilePhoto']);
});
