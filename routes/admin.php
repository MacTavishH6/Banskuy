<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view("Admin.auth.login");
})->middleware('web');

Route::post('/adminlogin', [App\Http\Controllers\Admin\AdminController::class, 'login']);

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/usersearching/{UserType?}', [App\Http\Controllers\Admin\MasterSearchingController::class, 'MasterSearching']);

    Route::get('/postsearching/{PostType?}', [App\Http\Controllers\Admin\MasterSearchingController::class, 'PostSearching']);

    Route::get('/usersearching/detail/{id}', [App\Http\Controllers\Admin\MasterSearchingController::class, 'MasterSearchingDetail']);

    Route::post('/usersearching/ban', [App\Http\Controllers\Admin\MasterSearchingController::class, 'BanUser']);

    Route::get('/DocumentApproval', [App\Http\Controllers\Admin\DocumentController::class, 'GetListDocumentApproval']);
    Route::get('/GetListDocumentType', [App\Http\Controllers\LOVController::class, 'GetDocumentTypeList']);
    Route::get('/GetApprovalStatus', [App\Http\Controllers\LOVController::class, 'GetApprovalStatus']);
    Route::post('/GetListDocumentByFilter', [App\Http\Controllers\Admin\DocumentController::class, 'GetListDocumentByFilter']);
    Route::post('/GetDocumentApprovalDetail', [App\Http\Controllers\Admin\DocumentController::class, 'GetDocumentApprovalDetail']);
    Route::post('/SaveDocumentApproval', [App\Http\Controllers\Admin\DocumentController::class, 'SaveDocumentApproval']);
});
