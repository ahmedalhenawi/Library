<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

//Route::get('/', function () {
//    return view('dashboard');
//});
//
//
//Route::resource('category', CategoryController::class);
//Route::resource('subCategory', SubCategoryController::class);
//Route::resource('book', BookController::class);
//
//Route::get('Category/fetch_all' , [CategoryController::class , 'fetch_all'])->name('category.fetch_all');
//Route::get('sub/fetch_all' , [SubCategoryController::class , 'fetch_all'])->name('subCategory.fetch_all');
//
//
//
//Route::get("register" , [AdminController::class , 'register'])->name('admin.register');
//Route::get("login" , [AdminController::class , 'login'])->name('admin.login');
//Route::post("register" , [AdminController::class , 'store'])->name('admin.store');
//Route::post("loginAdmin" , [AdminController::class , 'loginAdmin'])->name('loginAdmin');
//Route::get("logout" , [AdminController::class , 'logout'])->name('logout');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


    Route::get('/', function () {
        return view('dashboard');
    });


    Route::resource('category', CategoryController::class);
    Route::resource('subCategory', SubCategoryController::class);
    Route::resource('book', BookController::class);

    Route::get('Category/fetch_all' , [CategoryController::class , 'fetch_all'])->name('category.fetch_all');
    Route::get('sub/fetch_all' , [SubCategoryController::class , 'fetch_all'])->name('subCategory.fetch_all');


    Route::get("register" , [AdminController::class , 'register'])->name('admin.register');
    Route::get("login" , [AdminController::class , 'login'])->name('admin.login');
    Route::post("register" , [AdminController::class , 'store'])->name('admin.store');
    Route::post("loginAdmin" , [AdminController::class , 'loginAdmin'])->name('loginAdmin');
    Route::get("logout" , [AdminController::class , 'logout'])->name('logout');







});
