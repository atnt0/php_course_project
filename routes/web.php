<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductCategoriesController;
use \App\Http\Controllers\ProductPhotosController;
use \App\Http\Controllers\OrdersController;
use \App\Http\Controllers\CartsController;

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






Route::post('/cart/{product_uuid}/add_to_cart', [CartsController::class, 'addToCart'])->name('cart.addToCart'); // on page Product !
Route::post('/cart/{product_uuid}/remove_from_cart', [CartsController::class, 'removeFromCart'])->name('cart.removeFromCart'); // on page Cart !
Route::post('/cart/{product_uuid}/change_quantity', [CartsController::class, 'changeQuantityProductInCart'])->name('cart.changeQuantityProductInCart'); // on page Cart

Route::post('/cart/checkout/submit', [CartsController::class, 'checkoutSubmit'])->name('cart.checkoutSubmit');


Route::get('/cart', [CartsController::class, 'cart'])->name('cart.index');
Route::get('/cart/checkout', [CartsController::class, 'checkout'])->name('cart.checkout');



/**
 * Section routes: Заказы сформированные
 *
 */
Route::resource('/order', OrdersController::class)
    ->except([ 'create', 'store', 'edit', 'update' ])
    ->names([
        // get-pages
        'index' => 'order.index', // all orders
        'show' => 'order.show',
        //'create' => 'order.create',
        //'edit' => 'order.edit',
        // post-events
//        'store' => 'order.store',
        //'update' => 'order.update',
        'destroy' => 'order.destroy',
    ]);


/**
 * Section routes: Фотографии продуктов
 *
 * ВНИМАНИЕ Фотографии сейчас реализованы в классическом виде - отдельной загрузкой, но
 * в дальнейшем основные действия - загрузка, обновление и удаление будут перенесены на их ajax-версии
 */
Route::get('/product/photo/editListForProduct/{product_uuid}', [ProductPhotosController::class, 'editPositionsForProductByUuid'])
    ->name('product.photo.editListForProduct');
Route::post('/product/photo/editListForProduct/{product_uuid}/set_photosPositions', [ProductPhotosController::class, 'setProductPhotosPositions'])
    ->name('product.photo.editListForProduct.setProductPhotosPositions');
Route::get('/product/photo/createForProduct/{product_uuid}', [ProductPhotosController::class, 'createForProduct'])
    ->name('product.photo.createForProduct');
Route::resource('/product/photo', ProductPhotosController::class)
    // ->only([ 'index', 'show' ])
    //->except([ 'create', 'edit', 'update' ])
    // исключить
    ->except([ 'show', 'create' ])
    ->names([
        // get-pages
        'index' => 'product.photo.index', // all categories
        //'show' => 'product.photo.show',
        //'create' => 'product.photo.create',
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









