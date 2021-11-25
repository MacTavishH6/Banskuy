<?php

use Illuminate\Support\Facades\Route;


Route::get('/foundationlogin', function () {
    return view('/auth/foundationLogin');
});

Route::post('/loginfoundation', [App\Http\Controllers\Auth\LoginController::class, 'loginfoundation']);

Route::middleware(['auth:foundations'])->group(function () {
    Route::get('/rafli', function () {
        return view('Transaction.transactionapproval');
    });
    
    Route::get('/foundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'foundationprofile']);

    Route::get('/editfoundationprofile/{id}', [App\Http\Controllers\FoundationProfileController::class, 'editfoundationprofile']);
});
