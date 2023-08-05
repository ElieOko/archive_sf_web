<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TBrancheController;
use App\Http\Controllers\TdirectoryController;
use App\Http\Controllers\TinvoicekeyController;

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
Route::get('/alldirectory',[TdirectoryController::class,'getAllDirectory']);
Route::post('/invoicekey',[TinvoicekeyController::class,'store']);
Route::get('/allinvoicekey',[TinvoicekeyController::class,'getAllInvoiceKey']);
//
Route::get('/alldirectoryinvoice',[TdirectoryController::class,'getAllDirectoryAndInvoicekey']);
Route::group(['middleware'=>['auth:sanctum']], function () {
   //
   
});