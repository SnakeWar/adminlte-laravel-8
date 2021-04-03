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
Route::get('/postagem/{slug}', [App\Http\Controllers\Pages\PagesController::class, 'post'])->name('post');
Route::post('/comentario', [App\Http\Controllers\Pages\PagesController::class, 'comment'])->name('comment');
Route::post('/resposta', [App\Http\Controllers\Pages\PagesController::class, 'response'])->name('response');

Auth::routes();

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

        Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::resource('slides', App\Http\Controllers\Admin\SlideController::class)->middleware('can:read_slides');
        Route::resource('posts', App\Http\Controllers\Admin\PostController::class)->middleware('can:read_posts');
        Route::post('posts/ativo/{id}', [App\Http\Controllers\Admin\PostController::class, 'ativo'])->name('posts.ativo')->middleware('can:update_posts');
        Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)->middleware('can:read_roles');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->middleware('can:read_users');
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->middleware('can:read_categories');
        Route::resource('modules', App\Http\Controllers\Admin\ModuleController::class)->middleware('can:read_modules');

        Route::post('post_photo/remove', [App\Http\Controllers\Admin\PostPhotosController::class, 'removePhoto'])->name('post_photo_remove')->middleware('can:delete_slides');
        Route::post('slide_photo/remove', [App\Http\Controllers\Admin\SlidePhotosController::class, 'removePhoto'])->name('slide_photo_remove')->middleware('can:delete_posts');
});

Route::middleware('auth')->group(function () {
    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('ckfinder_connector');

    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
        ->name('ckfinder_browser');
});

