<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/usersearching', [App\Http\Controllers\AdminController::class, 'MasterSearching']);
});