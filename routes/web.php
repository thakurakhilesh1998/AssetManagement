<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PO\POController;

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

Route::prefix('admin')->middleware(['auth','web','admincheck'])->group(function()
{
    Route::get('add-user',[AdminController::class,'addUser']);
    Route::post('create-user',[AdminController::class,'createUser']);
    Route::get('viewUser',[AdminController::class,'viewUser']);
    Route::get('user-edit/{id}',[AdminController::class,'edit']);
    Route::put('user-edit/{id}',[AdminController::class,'update']);

});

Route::prefix('po')->middleware(['auth','web','pocheck'])->group(function()
{
    Route::get('add-asset',[POController::class,'addAsset']);
    Route::post('add-asset',[POController::class,'createAsset']);
    Route::get('view-asset',[POController::class,'viewAsset']);
    Route::get('asset-edit/{id}',[POController::class,'editAsset']);
    Route::put('edit-asset/{id}',[POController::class,'change']);
    Route::post('delete-asset',[POController::class,'delete']);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
