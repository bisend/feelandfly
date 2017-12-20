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
    /**
     * Category
     */
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

    Route::get('/{slug}/{sort}/{language?}', 'CategoryController@indexSort')
        ->where([
            'slug' => '^[a-z0-9-]+$',
            'sort' => '^(popularity|new|price-asc|price-desc)$',
            'language' => '^(uk|ru)?$'
        ]);

    Route::get('/{slug}/{sort}/{page}/{language?}', 'CategoryController@indexPaginationSort')
        ->where([
            'slug' => '^[a-z0-9-]+$',
            'sort' => '^(popularity|new|price-asc|price-desc)$',
            'page' => '^[2-9]{1}|[1-9]{1}[0-9]+$',
            'language' => '^(uk|ru)?$'
        ]);

    /**
     * Category Filters
     */
    Route::get('/{slug}/{filters}/{language?}', 'CategoryFiltersController@index')
        ->where([
            'slug' => '^[a-z0-9-]+$',
            'filters' => '^[a-z0-9=,;-]+$',
            'language' => '^(uk|ru)?$'
        ]);

    Route::get('/{slug}/{filters}/{page}/{language?}', 'CategoryFiltersController@indexPagination')
        ->where([
            'slug' => '^[a-z0-9-]+$',
            'filters' => '^[a-z0-9=,;-]+$',
            'page' => '^[2-9]{1}|[1-9]{1}[0-9]+$',
            'language' => '^(uk|ru)?$'
        ]);

    Route::get('/{slug}/{filters}/{sort}/{language?}', 'CategoryFiltersController@indexSort')
        ->where([
            'slug' => '^[a-z0-9-]+$',
            'filters' => '^[a-z0-9=,;-]+$',
            'sort' => '^(popularity|new|price-asc|price-desc)$',
            'language' => '^(uk|ru)?$'
        ]);

    Route::get('/{slug}/{filters}/{sort}/{page}/{language?}', 'CategoryFiltersController@indexPaginationSort')
        ->where([
            'slug' => '^[a-z0-9-]+$',
            'filters' => '^[a-z0-9=,;-]+$',
            'sort' => '^(popularity|new|price-asc|price-desc)$',
            'page' => '^[2-9]{1}|[1-9]{1}[0-9]+$',
            'language' => '^(uk|ru)?$'
        ]);
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

Route::group(['prefix' => 'search'], function () {

    Route::get('{series}/{language?}', 'SearchController@index')
        ->where([
            'language' => '^(uk|ru)?$'
        ]);
    
    /**
     * Search results page sorted
     */
    Route::get('/{series}/{sort}/{language?}', 'SearchController@indexSort')
        ->where([
            'sort' => '^(popularity|new|price-asc|price-desc)$',
            'language' => '^(uk|ru)?$'
        ]);

    /**
     * Search results page pagination
     */
    Route::get('/{series}/{page}/{language?}', 'SearchController@indexPagination')
        ->where([
            'page' => '^[2-9]{1}|[1-9]{1}[0-9]+$',
            'language' => '^(uk|ru)?$'
        ]);

    /**
     * Search results page sorted pagination
     */
    Route::get('/{series}/{sort}/{page}/{language?}', 'SearchController@indexPaginationSort')
        ->where([
            'sort' => '^(popularity|new|price-asc|price-desc)$',
            'page' => '^[2-9]{1}|[1-9]{1}[0-9]+$',
            'language' => '^(uk|ru)?$'
        ]);

    /**
     * Ajax search results handler
     */
    Route::get('/async/{series}/{language?}', 'SearchController@indexAjax')
        ->where([
            'language' => '^(uk|ru)?$'
        ]);
});

Route::group(['prefix' => 'user'], function () {
    Route::post('register', 'User\RegisterController@register');

    Route::get('login', 'User\LoginController@login');

    Route::get('logout', 'User\LoginController@logout');
    
    Route::get('login/facebook/{language?}', 'User\FacebookLoginController@redirectToProvider')
        ->where([
            'language' => '^(uk|ru)?$'
        ]);
    
    Route::get('login/facebook/callback', 'User\FacebookLoginController@handleProviderCallback');

    Route::post('social-email', 'User\FacebookLoginController@socialEmailHandler');

    Route::get('login/google/{language?}', 'User\GoogleLoginController@redirectToProvider')
        ->where([
            'language' => '^(uk|ru)?$'
        ]);
    
    Route::get('login/google/callback', 'User\GoogleLoginController@handleProviderCallback');

    Route::post('restore-password', 'User\RestorePasswordController@restore');
});

Route::get('/confirm/{confirmationToken}/{language?}', 'User\ConfirmationEmailController@confirm')
    ->where([
        'language' => '^(ru|uk)?$'
    ]);

/**
 * Confirmation new email method handler
 */
Route::get('/confirm-new-email/{confirmationToken}/{language?}', 'Profile\PersonalInfoController@confirmNewEmail')
    ->where([
        'language' => '^(uk|ru)?$'
    ]);

Route::get('/confirm-social-email/{confirmationToken}/{language?}', 'User\FacebookLoginController@confirmSocialEmail')
    ->where([
        'language' => '^(uk|ru)?$'
    ]);

Route::group(['prefix' => 'order'], function () {
    
    Route::get('confirm/{language?}', 'OrderController@index')
        ->where([
            'language' => '^(uk|ru)?$'
        ]);

    Route::post('create', 'OrderController@create');

});

Route::group(['prefix' => 'profile'], function () {
    
    Route::get('personal-info/{language?}', 'Profile\PersonalInfoController@index')
        ->where([
            'language' => '^(uk|ru)?$'
        ]);
    
    Route::get('payment-delivery/{language?}', 'Profile\PaymentDeliveryController@index')
        ->where([
            'language' => '^(uk|ru)?$'
        ]);

    Route::get('wish-list/{language?}', 'Profile\WishListController@index')
        ->where([
            'language' => '^(uk|ru)?$'
        ]);

    Route::get('my-orders/{language?}', 'Profile\MyOrdersController@index')
        ->where([
            'language' => '^(uk|ru)?$'
        ]);

    Route::post('save-personal-info', 'Profile\PersonalInfoController@savePersonalInfo');

    Route::post('change-password', 'Profile\ChangePasswordController@changePassword');

    Route::post('save-payment-delivery', 'Profile\PaymentDeliveryController@savePaymentDelivery');
    
    Route::post('add-to-wish-list', 'Profile\WishListController@addToWishList');

    Route::post('delete-from-wish-list', 'Profile\WishListController@deleteFromWishList');

    Route::post('my-orders', 'Profile\MyOrdersController@indexPagination');
});

/**
 * Errors handler
 */
Route::group(['prefix' => 'errors'], function ()
{
    /**
     * Error page
     */
    Route::get('/{error}/{language?}', 'ErrorController@index')
        ->where([
            'error' => '^(400|401|403|404|500)$',
            'language' => '^(uk|ru)?$'
        ]);
});