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
// Route::get('/', [App\Http\Controllers\Pages\PagesController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\Pages\PagesController::class, 'index']);
Route::get('/paginas/{slug}', [App\Http\Controllers\Pages\PagesController::class, 'page'])->name('page');
Route::get('/produtos', [App\Http\Controllers\Pages\PagesController::class, 'products'])->name('products');
Route::get('/quem-somos', [App\Http\Controllers\Pages\PagesController::class, 'quem_somos'])->name('quem_somos');
Route::any('/postagens/{slug?}', [App\Http\Controllers\Pages\PagesController::class, 'posts'])->name('posts');
Route::get('/postagem/{slug}', [App\Http\Controllers\Pages\PagesController::class, 'post'])->name('post');
Route::get('/produto/{slug}', [App\Http\Controllers\Pages\PagesController::class, 'product'])->name('product');
Route::get('/categoria/{id}', [App\Http\Controllers\Pages\PagesController::class, 'category'])->name('category');
Route::get('/fale-conosco', [App\Http\Controllers\Pages\PagesController::class, 'fale_conosco'])->name('fale_conosco');
Route::get('/trabalhe-conosco', [App\Http\Controllers\Pages\PagesController::class, 'trabalhe_conosco'])->name('trabalhe_conosco');
Route::post('/enviar-fale-conosco', [App\Http\Controllers\Pages\PagesController::class, 'enviar_fale_conosco'])->name('enviar_fale_conosco');
Route::post('/enviar-trabalhe-conosco', [App\Http\Controllers\Pages\PagesController::class, 'enviar_trabalhe_conosco'])->name('enviar_trabalhe_conosco');
Route::post('/comentario', [App\Http\Controllers\Pages\PagesController::class, 'comment'])->name('comment');
Route::post('/resposta', [App\Http\Controllers\Pages\PagesController::class, 'response'])->name('response');

Auth::routes();

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);
    Route::resource('slides', App\Http\Controllers\Admin\SlideController::class)->middleware('can:read_slides');

    Route::resource('posts', App\Http\Controllers\Admin\PostController::class)->middleware('can:read_posts');
    Route::post('posts/ativo/{id}', [App\Http\Controllers\Admin\PostController::class, 'ativo'])->name('posts.ativo')->middleware('can:update_posts');
    Route::post('image-cropper/upload',[App\Http\Controllers\Admin\PostController::class, 'upload']);

    Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->middleware('can:read_products');
    Route::post('products/ativo/{id}', [App\Http\Controllers\Admin\ProductController::class, 'ativo'])->name('products.ativo')->middleware('can:update_products');

    Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class)->middleware('can:read_contacts');

    Route::resource('workwithus', App\Http\Controllers\Admin\WorkwithusController::class)->middleware('can:read_workwithus');

    Route::resource('pages', App\Http\Controllers\Admin\PageController::class)->middleware('can:read_pages');
    Route::post('pages/ativo/{id}', [App\Http\Controllers\Admin\PageController::class, 'ativo'])->name('pages.ativo')->middleware('can:update_pages');

    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)->middleware('can:read_roles');

    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->middleware('can:read_users');

    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->middleware('can:read_categories');
    //Route::post('categories/ativo/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'ativo'])->name('categories.ativo')->middleware('can:update_categories');

    Route::resource('modules', App\Http\Controllers\Admin\ModuleController::class)->middleware('can:read_modules');

    Route::post('post_photo/remove', [App\Http\Controllers\Admin\PostPhotosController::class, 'removePhoto'])->name('post_photo_remove')->middleware('can:delete_slides');
    Route::post('slide_photo/remove', [App\Http\Controllers\Admin\SlidePhotosController::class, 'removePhoto'])->name('slide_photo_remove')->middleware('can:delete_posts');

    Route::resource('categories_products', App\Http\Controllers\Admin\CategoriesProductController::class)->middleware('can:read_categories_products');
});

Route::middleware('auth')->group(function () {
    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('ckfinder_connector');

    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
        ->name('ckfinder_browser');

    // Route::post('image-cropper/upload', [App\Http\Controllers\Admin\ImageCropperController::class, 'upload']);
});
