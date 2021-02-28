<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductCategoriesController;
use \App\Http\Controllers\ProductPhotosController;

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

/**
 * Section routes: Начальная страница
 */
Route::get('/', function () {
    return view('welcome');
});



/**
 * Section routes: Авторизация
 */
Route::get('/register/captcha-refresh', [RegisterController::class, 'refreshCaptcha'])->name('refreshCaptcha');
Auth::routes();



/**
 * Section routes: Фотографии продуктов
 *
 * ВНИМАНИЕ Фотографии сейчас реализованы в классическом виде - отдельной загрузкой, но
 * в дальнейшем основные действия - загрузка, обновление и удаление будут перенесены на их ajax-версии
 */
Route::resource('/product/photo', ProductPhotosController::class)
    // ->only([ 'index', 'show' ])
    //->except([ 'create', 'edit', 'update' ])
    // исключить
    ->except([ 'show' ])
    ->names([
        // get-pages
        'index' => 'product.photo.index', // all categories
        //'show' => 'product.photo.show',
        'create' => 'product.photo.create',
        'edit' => 'product.photo.edit',
        // post-events
        'store' => 'product.photo.store',
        'update' => 'product.photo.update',
        'destroy' => 'product.photo.destroy',

        // ajax
    ]);


/**
 * Section routes: Категории продуктов
 */
Route::resource('/product/category', ProductCategoriesController::class)
    ->names([
        // get-pages
        'index' => 'product.category.index', // all categories
        'show' => 'product.category.show',
        'create' => 'product.category.create',
        'edit' => 'product.category.edit',
        // post-events
        'store' => 'product.category.store',
        'update' => 'product.category.update',
        'destroy' => 'product.category.destroy',
    ]);


/**
 * Section routes: Продукты
 */
//Route::get('/product', [ProductsController::class, 'index' ])->name('products');

Route::post('/product/search_ajax', [ProductsController::class, 'searchAjax'])
    ->name('product.search.ajax');

Route::resource('/product', ProductsController::class)
    ->names([
        // get-pages
        'index' => 'product.index', // all products
        'show' => 'product.show',
        'create' => 'product.create',
        'edit' => 'product.edit',
        // post-events
        'store' => 'product.store',
        'update' => 'product.update',
        'destroy' => 'product.destroy',
    ]);









