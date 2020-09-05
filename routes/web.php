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



//前台
Route::get('/', 'FrontController@index');
Route::get('/woman', 'FrontController@woman');
Route::get('/man', 'FrontController@man');
Route::get('/kid', 'FrontController@kid');
Route::get('/accessories', 'FrontController@accessories');
Route::get('/media', 'FrontController@media');
Route::get('/product_detail/{id}', 'FrontController@product_detail');

//會員資料
Route::get('/user_info/orders', 'UserInfoController@orders');
// Route::get('/user_info/order_detail/{order_id}', 'UserInfoController@order_detail');
Route::get('/user_info/user_information', 'UserInfoController@information');
//cart
Route::post('/add_product_to_cart', 'CartController@add_product_to_cart');
Route::get('/cart', 'CartController@cart')->middleware('auth');
Route::post('/ajex_delete_item_in_cart', 'CartController@ajex_delete_item_in_cart');
Route::post('/ajex_new_quantity', 'CartController@ajex_new_quantity');
Route::get('/cart_check_out', 'CartController@cart_check_out');
Route::post('/send_check_out', 'CartController@send_check_out');
Route::get('/cart_success/{MerchantTradeNo}', 'CartController@cart_success');
//綠界
Route::prefix('cart_ecpay')->group(function () {

    //當消費者付款完成後，綠界會將付款結果參數以幕後(Server POST)回傳到該網址。
    Route::post('notify', 'CartController@notifyUrl')->name('notify');

    //付款完成後，綠界會將付款結果參數以幕前(Client POST)回傳到該網址
    Route::post('return', 'CartController@returnUrl')->name('return');
});


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Route::get('/home', 'HomeController@index')->name('home');


//後台
Route::group(['prefix' => 'admin', 'middleware' => ['auth',"admin"]], function () {
    Route::get('/', 'AdminController@index');

    Route::group(['prefix' => 'product_types'], function () {
        Route::get('/', 'ProductTypesController@index');
        // Route::get('/create', 'ProductTypesController@create');
        Route::post('/store', 'ProductTypesController@store')->name('type.store');
        Route::get('/edit/{id}', 'ProductTypesController@edit');
        Route::post('/update/{id}', 'ProductTypesController@update');
        Route::post('/destroy/{id}', 'ProductTypesController@destroy');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductsController@index');
        Route::get('/create', 'ProductsController@create');
        Route::post('/store', 'ProductsController@store');
        Route::post('/store_images', 'ProductsController@store_images');
        Route::get('/edit/{id}', 'ProductsController@edit');
        Route::post('/update/{id}', 'ProductsController@update');
        Route::post('/destroy/{id}', 'ProductsController@destroy');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', 'OrderController@index'); //訂單總覽
        Route::get('/content/{order_id}', 'OrderController@content'); //訂單詳細
        Route::post('/changeStatus/{order_id}', 'OrderController@changeStatus'); //更改訂單狀態

        Route::get('/select/{status}', 'OrderController@select'); //篩選訂單
        Route::post('/destroy/{order_id}', 'OrderController@destroy'); //刪除訂單
    });

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth',"super_admin"]], function () {
    Route::group(['prefix' => 'accounts'], function () {
        Route::get('/', 'AccountsController@index');
        Route::get('/create', 'AccountsController@create');
        Route::post('/store', 'AccountsController@store');
        Route::post('/destroy/{id}', 'AccountsController@destroy');

    });
});


Route::group(['prefix' => 'user'], function(){
    //使用者驗證
    Route::group(['prefix' => 'auth'], function(){
        //Facebook登入
        Route::get('/facebook-sign-in', 'UserAuthController@facebookSignInProcess');
        //Facebook登入重新導向授權資料處理
        Route::get('/facebook-sign-in-callback', 'UserAuthController@facebookSignInCallbackProcess');
    });
});

Route::get('/test', 'TestController@test');
Route::apiResource('/sample', 'SampleControler@store');

?>
