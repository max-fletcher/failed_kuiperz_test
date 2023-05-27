<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/index', [\App\Http\Controllers\TestController::class, 'index']);
Route::post('/generate_report', [\App\Http\Controllers\TestController::class, 'generate_report']);
Route::post('/download_pdf', [\App\Http\Controllers\TestController::class, 'download_pdf']);

Route::group(['prefix'=>'accounts'], function(){
    Route::get('/index', [\App\Http\Controllers\AccountController::class, 'index']);
    Route::post('/store', [\App\Http\Controllers\AccountController::class, 'store']);
    Route::post('/update', [\App\Http\Controllers\AccountController::class, 'update']);
    Route::post('/delete', [\App\Http\Controllers\AccountController::class, 'delete']);
});

Route::group(['prefix'=>'account_types'], function(){
    Route::get('/index', [\App\Http\Controllers\AccountTypeController::class, 'index']);
    // Route::post('/store', [\App\Http\Controllers\AccountTypeController::class, 'store']);
    // Route::post('/update', [\App\Http\Controllers\AccountTypeController::class, 'update']);
    // Route::post('/delete', [\App\Http\Controllers\AccountTypeController::class, 'delete']);
});

Route::group(['prefix'=>'branches'], function(){
    Route::get('/index', [\App\Http\Controllers\BranchController::class, 'index']);
    // Route::post('/store', [\App\Http\Controllers\AccountTypeController::class, 'store']);
    // Route::post('/update', [\App\Http\Controllers\AccountTypeController::class, 'update']);
    // Route::post('/delete', [\App\Http\Controllers\AccountTypeController::class, 'delete']);
});