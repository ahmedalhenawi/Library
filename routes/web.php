<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('dashboard');
});


//Route::resource('category', \App\Http\Controllers\CategoryController::class);
//Route::resource('book' , \App\Http\Controllers\BookController::class);

Route::resources([
    'category' => CategoryController::class,
    'book' => BookController::class,
]);

Route::get("category/delete/{id}" , [CategoryController::class , 'delete']);
Route::get("book/delete/{id}" , [BookController::class , 'delete']);
