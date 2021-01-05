<?php

use App\Http\Controllers\Pages\PagesController;
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

Route::view('/', 'pages.welcome', ['title' => 'Loja Virtual'])->name('home');
Route::get('/post/{slug}', [App\Http\Controllers\Pages\PagesController::class, 'post'])->name('post');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function (){
        Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::resource('posts', App\Http\Controllers\Admin\PostController::class);
        Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('modules', App\Http\Controllers\Admin\ModuleController::class);

        Route::post('post_photo/remove', [App\Http\Controllers\Admin\PostPhotosController::class, 'removePhoto'])->name('post_photo_remove');
    });
});
