<?php

use App\Http\Controllers\ZipArchiveController;
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

//User
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::get('/alluser',[UserController::class,'getAllUser']);
Route::post('/filter/user',[UserController::class,'filter']);
//branch
Route::post('/branch',[TBrancheController::class,'create']);
Route::get('/branch/all',[TBrancheController::class,'getAllBranch']);
Route::post('/filter/branch',[TBrancheController::class,'filter']);
//getAllBranch
Route::post('/directory',[TdirectoryController::class,'store']);
Route::get('/alldirectory',[TdirectoryController::class,'getAllDirectory']);
Route::post('/filter/directory',[TdirectoryController::class,'filter']);
//key
Route::post('/invoicekey',[TinvoicekeyController::class,'store']);
Route::post('/filter/invoice',[TinvoiceController::class,'filterInvoice']);
Route::post('/filter/invoice/general',[TinvoiceController::class,'filterInvoice2']);
Route::post('/filter/invoice/general/{id}',[TinvoiceController::class,'filterInvoiceUser']);
Route::get('/allinvoicekey',[TinvoicekeyController::class,'getAllInvoiceKey']);
Route::post('/filter/key',[TinvoicekeyController::class,'filter']);
//invoice
Route::post('/invoice',[TinvoiceController::class,'store']);
Route::get('/allinvoice',[TinvoiceController::class,'getAllInvoice']);
Route::get('/allinvoice/{id}',[TinvoiceController::class,'getAllInvoice2']);
Route::delete('/invoice/{id}',[TinvoiceController::class,'destroy']);
Route::get('/invoiceshow/{id}',[TinvoiceController::class,'show']);
Route::put('/invoicesput/{id}',[TinvoiceController::class,'edit']);

//picture
Route::post('/picture',[TpictureController::class,'store']);
Route::post('/{id}/picture',[TpictureController::class,'storePicture']);
Route::get('/getAllPicture',[TpictureController::class,'getAllPicture']);
Route::get('/picturebyinvoice/{id}',[TpictureController::class,'getAllPictureByInvoice']);
Route::get('/test',[TpictureController::class,'test']);
//zip file
Route::get('/zip/{data}',[ZipArchiveController::class,'download']);
//
Route::get('/alldirectoryinvoice',[TdirectoryController::class,'getAllDirectoryAndInvoicekey']);
Route::group(['middleware'=>['auth:sanctum']], function () {
//
});