<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\FilledProfile;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact');
Route::post('/contact/send', 'App\Http\Controllers\ContactController@send')->name('contact.send');

Route::group(
    [
        'prefix' => 'my',
        'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified'],
    ],
    function () {
        Route::get('/', 'App\Http\Controllers\My\HomeController@index')->name('my');

        Route::get('/profile', 'App\Http\Controllers\My\ProfileController@index')->name('my.profile.index');
        Route::get('/profile/fill', 'App\Http\Controllers\My\ProfileController@fillForm')->name('my.profile.fillForm');
        Route::post('/profile/fill', 'App\Http\Controllers\My\ProfileController@fill')->name('my.profile.fill');

        Route::get('/orders', 'App\Http\Controllers\My\OrdersController@index')->name('orders.index');
        Route::get('/orders/{order}', 'App\Http\Controllers\My\OrdersController@show')->name('orders.show');
        Route::post('/order/{order}/cancel', 'App\Http\Controllers\My\OrdersController@cancel')->name('orders.cancel');
        Route::post('/order/{order}/pay', 'App\Http\Controllers\My\OrdersController@pay')->name('orders.pay');

        Route::get('/wishlist', 'App\Http\Controllers\My\WishlistController@index')->name('wishlist.index');
        Route::post('/wishlist/item/create', 'App\Http\Controllers\My\WishlistController@create')->name('wishlist.create');
        Route::post('/wishlist/item/remove', 'App\Http\Controllers\My\WishlistController@remove')->name('wishlist.remove');

        Route::get('/comparison', 'App\Http\Controllers\My\ComparisonController@index')->name('comparison.index');
        Route::post('/comparison/item/add', 'App\Http\Controllers\My\ComparisonController@add')->name('comparison.create');
        Route::post('/comparison/item/remove', 'App\Http\Controllers\My\ComparisonController@remove')->name('comparison.remove');
    }
);

Route::group(
    [
        'prefix' => 'blog',
        'as' => 'blog.',
    ],
    function () {
        Route::get('/all', 'App\Http\Controllers\Blog\PostsController@all')->name('posts.all');
        Route::get('/category/{slug}', 'App\Http\Controllers\Blog\PostsController@category')->name('posts.category');
        Route::get('/{id}/{slug}', 'App\Http\Controllers\Blog\PostsController@single')->name('posts.single');
        Route::get('/search', 'App\Http\Controllers\Blog\PostsController@search')->name('posts.search');
        Route::post('/like', 'App\Http\Controllers\Blog\PostsController@like')->name('posts.like');
        Route::post('/{post}/comment/create', 'App\Http\Controllers\Blog\PostsController@comment')->name('posts.comment');
    }
);

Route::group(
    [
        'prefix' => 'shop',
        'as' => 'shop.',
    ],
    function () {
        Route::get('/products', 'App\Http\Controllers\Shop\ProductsController@index')->name('products.index');
        Route::get('/product/{id}/{slug}', 'App\Http\Controllers\Shop\ProductsController@single')->name('products.single');

        Route::get('/products/category/{slug}', 'App\Http\Controllers\Shop\ProductsController@category')->name('products.category');
        Route::get('/products/brand/{slug}', 'App\Http\Controllers\Shop\ProductsController@brand')->name('products.brand');

        Route::post('/product/{product}/comment/create', 'App\Http\Controllers\Shop\ProductsController@comment')->name('products.comment');
        Route::post('/product/{product}/review/create', 'App\Http\Controllers\Shop\ProductsController@review')->name('products.review');

        Route::get('/products/search', 'App\Http\Controllers\Shop\SearchController@search')->name('products.search');

        Route::get('/cart', 'App\Http\Controllers\Shop\CartController@index')->name('cart.index');
        Route::post('/cart/add', 'App\Http\Controllers\Shop\CartController@store')->name('cart.store');
        Route::post('/cart/remove/{cartItem}', 'App\Http\Controllers\Shop\CartController@destroy')->name('cart.destroy');
        Route::post('/cart/remove-all', 'App\Http\Controllers\Shop\CartController@destroyAll')->name('cart.destroyAll');

        Route::group(
        [
            'prefix' => 'order',
            'as' => 'orders.',
            'middleware' => FilledProfile::class
        ], function () {
            Route::get('/checkout', 'App\Http\Controllers\Shop\OrdersController@checkout')->name('checkout');
            Route::post('/region', 'App\Http\Controllers\Shop\OrdersController@region')->name('region');
            Route::post('/checkout-form', 'App\Http\Controllers\Shop\OrdersController@checkoutForm')->name('checkoutForm');
        });
    }
);