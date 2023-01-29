<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BarangController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/profile', [AuthenticationController::class, 'profile']);
    Route::patch('/profile/{id}', [AuthenticationController::class, 'update'])->middleware('update-profile');
    Route::post('barangs', [BarangController::class,'store']);
    Route::patch('/barangs/{id}',[BarangController::class,'update']);
    Route::delete('/barangs/{id}',[BarangController::class,'destroy']);

});

Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/barangs',[BarangController::class,'index']);
Route::get('/users', [AuthenticationController::class, 'users']);
Route::get('/barangs/{id}',[BarangController::class,'show']);








