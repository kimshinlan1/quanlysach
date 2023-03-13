<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', 'AuthController@showLoginForm')->name('login');

// Handle login form submission
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout');

Route::middleware('auth')->group(function(){
    Route::get('/', function(){
    return redirect()->route('home');
    });
    Route::get('home', function(){
    return view('home');
    })->name('home');
    
    Route::get('/search', 'HomeController@search')->name('search');

    Route::post('/book/storeAjax',"BookController@storeByAjax");
    Route::delete('/delete/{id}', 'BookController@deleteByAjax');

    Route::resource('book', BookController::class);
    Route::resource('category', CategoryController::class);
});