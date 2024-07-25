<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PO\POController;
use App\Http\Controllers\DPO\DPOController;
use App\Http\Controllers\BDO\BDOController;
use App\Http\Controllers\BDO\RDController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['web','preventCache'])->group(function()
{
    Route::prefix('admin')->middleware(['auth','web','admincheck'])->group(function()
{
    Route::get('/',[AdminController::class,'addUser']);
    Route::get('add-user',[AdminController::class,'addUser']);
    Route::post('create-user',[AdminController::class,'createUser']);
    Route::get('viewUser',[AdminController::class,'viewUser']);
    Route::get('user-edit/{id}',[AdminController::class,'edit']);
    Route::put('user-edit/{id}',[AdminController::class,'update']);
    Route::get('viewRD',[AdminController::class,'viewRD']);
    Route::get('viewPR',[AdminController::class,'viewPR']);
    Route::get('dashboard',[AdminController::class,'dashboard']);

});

Route::prefix('po')->middleware(['auth','web','pocheck'])->group(function()
{
    Route::get('/',[POController::class,'addAsset']);
    Route::get('add-asset',[POController::class,'addAsset']);
    Route::post('add-asset',[POController::class,'createAsset']);
    Route::get('view-asset',[POController::class,'viewAsset']);
    Route::get('asset-edit/{id}',[POController::class,'editAsset']);
    Route::put('edit-asset/{id}',[POController::class,'change']);
    Route::post('delete-asset',[POController::class,'delete']);
});

Route::prefix('dpo')->middleware(['auth','web','dpocheck'])->group(function()
{
    Route::get('/',[DPOController::class,'addAasset']);
    Route::get('add-asset',[DPOController::class,'addAasset']);
    Route::post('add-asset',[DPOController::class,'createAsset']);
    Route::get('view-asset',[DPOController::class,'viewAsset']);
    Route::get('asset-edit/{id}',[DPOController::class,'editAsset']);
    Route::put('edit-asset/{id}',[DPOController::class,'change']);
    Route::post('delete-asset',[DPOController::class,'delete']);
});

Route::prefix('bdo')->middleware(['auth','web','bdocheck'])->group(function()
{
    Route::get('/',[BDOController::class,'addAsset']);
    Route::get('add-assetpr',[BDOController::class,'addAsset']);
    Route::post('add-assetpr',[BDOController::class,'createAsset']);
    Route::get('view-assetpr',[BDOController::class,'viewAsset']);
    Route::get('asset-editpr/{id}',[BDOController::class,'editAsset']);
    Route::put('edit-assetpr/{id}',[BDOController::class,'change']);
    // Rural Development Assets
    Route::get('add-assetrd',[RDController::class,'addAssetRd']);
    Route::post('add-assetrd',[RDController::class,'createAssetPr']);
    Route::get('view-assetrd',[RDController::class,'viewAsset']);
    Route::get('asset-editrd/{id}',[RDController::class,'editAsset']);
    Route::put('edit-assetrd/{id}',[RDController::class,'change']);
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


