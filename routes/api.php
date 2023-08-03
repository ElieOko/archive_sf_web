<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TBrancheController;
use App\Http\Controllers\TdirectoryController;

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

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::post('/branch',[TBrancheController::class,'create']);
Route::post('/directory',[TdirectoryController::class,'store']);
Route::group(['middleware'=>['auth:sanctum']], function () {
   //
   
});