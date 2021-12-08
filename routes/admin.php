<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view("Admin.auth.login");
})->middleware('web');

Route::post('/adminlogin', [App\Http\Controllers\Admin\AdminController::class, 'login']);

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/usersearching', [App\Http\Controllers\Admin\AdminController::class, 'MasterSearching']);

    Route::get('/DocumentApproval', [App\Http\Controllers\Admin\DocumentController::class, 'GetListDocumentApproval']);
    Route::get('/GetListDocumentType', [App\Http\Controllers\LOVController::class, 'GetDocumentTypeList']);
    Route::get('/GetApprovalStatus', [App\Http\Controllers\LOVController::class, 'GetApprovalStatus']);
    Route::post('/GetListDocumentByFilter', [DocumentController::class, 'GetListDocumentByFilter']);
    Route::post('/GetDocumentApprovalDetail', [DocumentController::class, 'GetDocumentApprovalDetail']);
    Route::post('/SaveDocumentApproval', [DocumentController::class, 'SaveDocumentApproval']);
});
