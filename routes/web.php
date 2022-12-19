<?php

use GuzzleHttp\Middleware;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','App\Http\Controllers\Frontend\FrontendController@index');
Route::get('/category','App\Http\Controllers\Frontend\FrontendController@category');
Route::get('/category/{slug}','App\Http\Controllers\Frontend\FrontendController@viewcategory');
Route::get('/category/{cate_slug}/{prod_clug}','App\Http\Controllers\Frontend\FrontendController@productview');
Route::post('/add-to-cart','App\Http\Controllers\Frontend\CartController@addProduct');
Route::post('/delete-cart-item','App\Http\Controllers\Frontend\CartController@deleteProduct');
Route::post('/update-cart','App\Http\Controllers\Frontend\CartController@updatecart');
Route::post('/add-to-wishlist','App\Http\Controllers\Frontend\WishlistController@add');
Route::post('/delete-wishlist-item','App\Http\Controllers\Frontend\WishlistController@delete');
Route::get('/product-list','App\Http\Controllers\Frontend\FrontendController@productlistAjax');
Route::get('/search','App\Http\Controllers\Frontend\FrontendController@search');
Route::post('/search-product','App\Http\Controllers\Frontend\FrontendController@searchProduct');

Route::middleware('auth','verified')->group(function(){
    Route::get('/cart','App\Http\Controllers\Frontend\CartController@viewcart');
    Route::get('/checkout','App\Http\Controllers\Frontend\CheckoutController@index');
    Route::get('/get-district/{id}','App\Http\Controllers\Frontend\CheckoutController@getdistrict');
    Route::get('/get-ward/{id}','App\Http\Controllers\Frontend\CheckoutController@getward');
    Route::post('/place-order','App\Http\Controllers\Frontend\CheckoutController@placeorder');
    Route::get('/my-orders','App\Http\Controllers\Frontend\UserController@index');
    Route::get('/view-order/{id}','App\Http\Controllers\Frontend\UserController@view');
    Route::put('/cancel-order/{id}','App\Http\Controllers\Frontend\UserController@cancel');
    Route::get('/wishlist','App\Http\Controllers\Frontend\WishlistController@index');
    Route::post('/add-rating','App\Http\Controllers\Frontend\RatingController@add');
    Route::get('/add-review/{product_slug}/user-review','App\Http\Controllers\Frontend\ReviewController@add');
    Route::post('/add-review','App\Http\Controllers\Frontend\ReviewController@create');
    Route::get('/edit-review/{product_slug}/user-review','App\Http\Controllers\Frontend\ReviewController@edit');
    Route::put('/update-review','App\Http\Controllers\Frontend\ReviewController@update');
    Route::get('/profile','App\Http\Controllers\Frontend\UserController@profile');
    Route::post('/add-avatar','App\Http\Controllers\Frontend\UserController@avatar');
    Route::post('/update-profile','App\Http\Controllers\Frontend\UserController@update');
    Route::post('/update-password','App\Http\Controllers\Frontend\UserController@updatepassword');
    Route::get('/change-password','App\Http\Controllers\Frontend\UserController@changepassword');
});

Auth::routes(['verify' => true]);
Route::get('/load-cart-data','App\Http\Controllers\Frontend\CartController@cartcount');
Route::get('/load-wishlist-data','App\Http\Controllers\Frontend\WishlistController@wishlistcount');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth','isAdmin','verified')->group(function(){
    //dashboard
    Route::get('/dashboard','App\Http\Controllers\Admin\FrontendController@index');
    //category
    Route::get('/categories','App\Http\Controllers\Admin\CategoryController@index');
    Route::get('/categories/fetch_data', 'App\Http\Controllers\Admin\CategoryController@fetch_data');
    Route::get('/add-category','App\Http\Controllers\Admin\CategoryController@add');
    Route::post('/insert-category','App\Http\Controllers\Admin\CategoryController@insert');
    Route::get('/edit-cate/{id}','App\Http\Controllers\Admin\CategoryController@edit');
    Route::put('/update-category/{slug}','App\Http\Controllers\Admin\CategoryController@update');
    Route::get('/delete-category/{slug}','App\Http\Controllers\Admin\CategoryController@destroy');
    Route::get('/categories-search','App\Http\Controllers\Admin\CategoryController@search');
    Route::post('/categories-search','App\Http\Controllers\Admin\CategoryController@catesearch');
    //product
    Route::get('/products','App\Http\Controllers\Admin\ProductController@index');
    Route::get('/products/fetch_data', 'App\Http\Controllers\Admin\ProductController@fetch_data');
    Route::get('/add-product','App\Http\Controllers\Admin\ProductController@add');
    Route::post('/insert-product','App\Http\Controllers\Admin\ProductController@insert');
    Route::get('/edit-product/{slug}','App\Http\Controllers\Admin\ProductController@edit');
    Route::put('/update-product/{slug}','App\Http\Controllers\Admin\ProductController@update');
    Route::get('/delete-product/{slug}','App\Http\Controllers\Admin\ProductController@destroy');
    Route::get('/products-search','App\Http\Controllers\Admin\ProductController@search');
    Route::post('/products-search','App\Http\Controllers\Admin\ProductController@prodsearch');
    //User
    
    Route::get('/users','App\Http\Controllers\Admin\DashboardController@users');
    Route::get('/users/fetch_data', 'App\Http\Controllers\Admin\DashboardController@fetch_data');
    Route::get('/view-user/{id}','App\Http\Controllers\Admin\DashboardController@viewuser');
    Route::get('/user-search','App\Http\Controllers\Admin\DashboardController@search');
    Route::post('/users-search','App\Http\Controllers\Admin\DashboardController@usersearch');
    Route::get('/users-search','App\Http\Controllers\Admin\DashboardController@search');
    Route::post('/users-search','App\Http\Controllers\Admin\DashboardController@usersearch');
    //Order
    Route::get('/orders','App\Http\Controllers\Admin\OrderController@index');
    Route::get('/orders/fetch_data', 'App\Http\Controllers\Admin\OrderController@fetch_data');
    Route::get('/admin/view-order/{id}','App\Http\Controllers\Admin\OrderController@view');
    Route::get('/order-history','App\Http\Controllers\Admin\OrderController@orderhistory');
    Route::put('/update-order/{id}','App\Http\Controllers\Admin\OrderController@updateorder');
    Route::get('/orders-search','App\Http\Controllers\Admin\OrderController@search');
    Route::post('/orders-search','App\Http\Controllers\Admin\OrderController@ordersearch');
});