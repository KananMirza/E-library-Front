<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\author\AuthorController;
use App\Http\Controllers\book\BookController;
use App\Http\Controllers\category\CategoryController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\error\ErrorController;
use App\Http\Controllers\leaseStatus\LeaseStatusController;
use App\Http\Controllers\penaltyType\PenaltyTypeController;
use App\Http\Controllers\publisher\PublisherController;
use App\Http\Controllers\shelf\ShelfController;
use App\Http\Controllers\user\UserController;
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

    Route::controller(CategoryController::class)->prefix('/category')->group(function (){
        Route::get('/list','getAllCategory')->name('getAllCategory');
        Route::get('/get/{id}','getCategoryById')->name('getCategoryById');
        Route::post('/update','updateCategory')->name('updateCategory');
        Route::post('/create','createCategory')->name('createCategory');
        Route::post('/change-status','changeStatusCategory')->name('changeStatusCategory');
        Route::post('/delete','deleteCategory')->name('deleteCategory');
    });

    Route::controller(PublisherController::class)->prefix('/publisher')->group(function (){
        Route::get('/list','getAllPublisher')->name('getAllPublisher');
        Route::get('/get/{id}','getPublisherById')->name('getPublisherById');
        Route::post('/update','updatePublisher')->name('updatePublisher');
        Route::post('/create','createPublisher')->name('createPublisher');
        Route::post('/change-status','changeStatusPublisher')->name('changeStatusPublisher');
        Route::post('/delete','deletePublisher')->name('deletePublisher');
    });

    Route::controller(ShelfController::class)->prefix('/shelf')->group(function (){
        Route::get('/list','getAllShelf')->name('getAllShelf');
        Route::get('/get/{id}','getShelfById')->name('getShelfById');
        Route::post('/update','updateShelf')->name('updateShelf');
        Route::post('/create','createShelf')->name('createShelf');
        Route::post('/change-status','changeStatusShelf')->name('changeStatusShelf');
        Route::post('/delete','deleteShelf')->name('deleteShelf');
    });

    Route::controller(LeaseStatusController::class)->prefix('/lease-status')->group(function (){
        Route::get('/list','getAllLeaseStatus')->name('getAllLeaseStatus');
        Route::get('/get/{id}','getLeaseStatusById')->name('getLeaseStatusById');
        Route::post('/update','updateLeaseStatus')->name('updateLeaseStatus');
        Route::post('/create','createLeaseStatus')->name('createLeaseStatus');
        Route::post('/delete','deleteLeaseStatus')->name('deleteLeaseStatus');
    });

    Route::controller(PenaltyTypeController::class)->prefix('/penalty-type')->group(function (){
        Route::get('/list','getAllPenaltyType')->name('getAllPenaltyType');
        Route::get('/get/{id}','getPenaltyTypeById')->name('getPenaltyTypeById');
        Route::post('/update','updatePenaltyType')->name('updatePenaltyType');
        Route::post('/create','createPenaltyType')->name('createPenaltyType');
        Route::post('/delete','deletePenaltyType')->name('deletePenaltyType');
    });

    Route::controller(UserController::class)->prefix('/user')->group(function (){
        Route::get('/list','getAllUser')->name('getAllUser');
        Route::get('/get/{id}','getUserById')->name('getUserById');
        Route::post('/change-status','changeStatusUser')->name('changeStatusUser');
    });

    Route::controller(BookController::class)->prefix('/book')->group(function (){
        Route::get('/list','getAllBook')->name('getAllBook');
        Route::get('/create','createBookPage')->name('createBookPage');
        Route::post('/create','createBook')->name('createBook');
        Route::get('/get/{id}','getBookById')->name('getBookById');
        Route::post('/update','updateBook')->name('updateBook');
        Route::post('/change-status','changeStatusBook')->name('changeStatusBook');
        Route::post('/delete','deleteBook')->name('deleteBook');
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
