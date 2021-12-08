<?php

use Illuminate\Support\Facades\Route;

Route::get('/DocumentApproval',[App\Http\Controllers\Admin\DocumentController::class,'GetListDocumentApproval']);
Route::get('/GetListDocumentType',[App\Http\Controllers\LOVController::class, 'GetDocumentTypeList']);
Route::get('/GetApprovalStatus',[App\Http\Controllers\LOVController::class, 'GetApprovalStatus']);
Route::post('/GetListDocumentByFilter',[DocumentController::class, 'GetListDocumentByFilter']);
Route::post('/GetDocumentApprovalDetail',[DocumentController::class, 'GetDocumentApprovalDetail']);
Route::post('/SaveDocumentApproval',[DocumentController::class, 'SaveDocumentApproval']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/usersearching', [App\Http\Controllers\AdminController::class, 'MasterSearching']);
});