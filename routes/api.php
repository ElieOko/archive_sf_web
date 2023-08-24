<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TBrancheController;
use App\Http\Controllers\TinvoiceController;
use App\Http\Controllers\TpictureController;
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
Route::post('/invoice',[TinvoiceController::class,'store']);
Route::get('/allinvoice',[TinvoiceController::class,'getAllInvoice']);
Route::delete('/invoice/{id}',[TinvoiceController::class,'destroy']);
Route::get('/invoiceshow/{id}',[TinvoiceController::class,'show']);
Route::put('/invoicesput/{id}',[TinvoiceController::class,'edit']);
Route::get('/alluser',[UserController::class,'getAllUser']);
Route::post('/picture',[TpictureController::class,'store']);
Route::get('/getAllPicture',[TpictureController::class,'getAllPicture']);
Route::get('/picturebyinvoice/{id}',[TpictureController::class,'getAllPictureByInvoice']);
Route::get('/test',[TpictureController::class,'test']);
//
Route::get('/alldirectoryinvoice',[TdirectoryController::class,'getAllDirectoryAndInvoicekey']);
Route::group(['middleware'=>['auth:sanctum']], function () {
   //
});