<?php

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

Route::get('/{language?}', 'HomeController@index')
    ->where([
        'language' => '^(uk|ru)?$'
    ])
    ->name('home');

Route::get('/product/{slug}/{language?}', 'ProductController@index')
    ->where([
        'slug' => '^[a-z0-9-]+$',
        'language' => '^(uk|ru)?$'
    ]);

/**
 * Category page
 */
Route::group(['prefix' => 'category'], function ()
{
    Route::get('/{slug}/{language?}', 'CategoryController@index')
        ->where([
            'slug' => '^[a-z0-9-]+$',
            'language' => '^(uk|ru)?$'
        ]);

    Route::get('/{slug}/{page}/{language?}', 'CategoryController@indexPagination')
        ->where([
            'slug' => '^[a-z0-9-]+$',
            'page' => '^[2-9]{1}|[1-9]{1}[0-9]+$',
            'language' => '^(uk|ru)?$'
        ]);

//    Route::get('/{slug}/{sort}/{language?}', 'CategoryController@indexSort')
//        ->where([
//            'slug' => '^[a-z0-9-]+$',
//            'sort' => '^(price-asc|price-desc)$',
//            'language' => '^(uk|ru)?$'
//        ]);

//    Route::get('/{slug}/{sort}/{page}/{language?}', 'CategoryController@indexPaginationSort')
//        ->where([
//            'slug' => '^[a-z0-9-]+$',
//            'sort' => '^(price-asc|price-desc)$',
//            'page' => '^[2-9]{1}|[1-9]{1}[0-9]+$',
//            'language' => '^(uk|ru)?$'
//        ]);
    
});

Route::post('/getAjaxProductPreview', 'CategoryController@getAjaxProductPreview')->where([
    'language' => '^(uk|ru)?$'
]);

Route::group(['prefix' => 'cart'], function ()
{
    Route::post('/init-cart', 'CartController@initCart');
    Route::post('/add-to-cart', 'CartController@addToCart');
    Route::post('/update-cart', 'CartController@updateCart');
    Route::post('/delete-from-cart', 'CartController@deleteFromCart');
});

Route::post('/get-user', 'LayoutController@getUser');