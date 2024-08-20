<?php


use App\Http\Controllers\api\v1\DocumentController;
use App\Http\Controllers\api\v1\ForgotPasswordController;
use App\Http\Controllers\api\v1\HistoryController;
use App\Http\Controllers\api\v1\ProjectController;
use App\Http\Controllers\api\v1\UserController;
use Illuminate\Support\Facades\Route;


//document API routes
Route::post('/document/create', [DocumentController::class, 'store'])->middleware('auth');
Route::get('/document/list', [DocumentController::class, 'index']);
Route::get('/document/list/archive', [DocumentController::class, 'listArchive'])->middleware('auth');
Route::get('/document/{document_id}/show', [DocumentController::class, 'show'])->where(
    [
        'document_id' => '[0-9]+'
    ]
);
Route::put('/document/{document_id}/edit', [DocumentController::class, 'update'])->where(
    [
        'document_id' => '[0-9]+'
    ]
)->middleware('auth');
Route::delete('/document/archive', [DocumentController::class, 'archive'])->middleware('auth');
Route::delete('/document/unarchive', [DocumentController::class, 'unArchive'])->middleware('auth');
Route::delete('/document/delete', [DocumentController::class, 'destroy'])->middleware('auth');




//project API routes
Route::post('/project/create', [ProjectController::class, 'create'])->middleware('auth');
Route::get('/project/list', [ProjectController::class, 'index']);
Route::get('/project/{project_id}/show', [ProjectController::class, 'show'])->where(
    [
        'project_id' => '[0-9]+'
    ]
);
Route::put('/project/{project_id}/edit', [ProjectController::class, 'update'])->where(
    [
        'project_id' => '[0-9]+'
    ]
)->middleware('auth');
Route::patch('/project/archive', [ProjectController::class, 'archive'])->middleware('auth');
Route::patch('/project/unarchive', [ProjectController::class, 'unArchive'])->middleware('auth');
Route::delete('/project/delete', [ProjectController::class, 'destroy'])->middleware('auth');




//user API routes
Route::get('/user/list', [UserController::class, 'index']);
Route::post('/user/create', [UserController::class, 'store']);
Route::post('/user/login', [UserController::class, 'doLogin']);
Route::delete('/user/logout', [UserController::class, 'logout']);
Route::patch('/user/activate', [UserController::class, 'activate']);
Route::patch('/user/deactivate', [UserController::class, 'deactivate']);



//forgot password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm']);
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm']);
Route::post('password/reset', [ForgotPasswordController::class, 'reset']);





//history API routes
Route::get('/history/{document_id}/document', [HistoryController::class, 'getDocumentHistory'])->where([
    'document_id' => '[0-9]+'
]);
Route::get('/history/{user_id}/user', [HistoryController::class, 'getUserHistory'])->where([
    'user_id' => '[0-9]+'
]);
Route::get('/history/list', [HistoryController::class, 'getHistories']);
Route::delete('/history/delete', [HistoryController::class, 'removeHistory'])->middleware('auth');
