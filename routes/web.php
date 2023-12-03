<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\author\AuthorController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\error\ErrorController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('isLogin')->group(function () {
    Route::controller(DashboardController::class)->group(function (){
       Route::get('/','index')->name('index');
    });

    Route::controller(AuthorController::class)->prefix('/author')->group(function (){
        Route::get('/list','getAllAuthor')->name('getAllAuthor');
        Route::get('/get/{id}','getAuthorById')->name('getAuthorById');
        Route::post('/update','updateAuthor')->name('updateAuthor');
        Route::post('/create','createAuthor')->name('createAuthor');
        Route::post('/change-status','changeStatusAuthor')->name('changeStatusAuthor');
        Route::post('/delete','deleteAuthor')->name('deleteAuthor');
    });

    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::middleware('isLogout')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginPost')->name('loginPost');
    });
});



Route::get('error-404',[ErrorController::class,'error404'])->name('error404');
Route::get('error-500',[ErrorController::class,'error500'])->name('error500');
Route::fallback(function (){
    return redirect()->route('error404');
});
