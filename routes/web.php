<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->middleware('auth');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::prefix('admin')->name('admin.')->group(function (){

        Route::resource('posts', App\Http\Controllers\Admin\PostController::class);
        Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('modules', App\Http\Controllers\Admin\ModuleController::class);
    });
});

