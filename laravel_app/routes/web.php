<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\EditDeviceController;
use App\Http\Controllers\DeleteDeviceController;

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

Route::get('/', [PostController::class, 'index']);
Route::get('/devices', [DeviceController::class, 'list']);
Route::post('/devices', [DeviceController::class, 'store']);
Route::get('/editDevice', [EditDeviceController::class, 'editForm']);
Route::post('/editDevice', [EditDeviceController::class, 'editDevice']);
Route::get('/deteleDevice', [DeleteDeviceController::class, 'deleteDevice']);
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/posts/{post:id}', [PostController::class, 'show']);
Route::get('/categories/{category:slug}', [CategoryController::class, 'list']);
Route::get('/authors/{user:username}', [AuthorController::class, 'show']);

