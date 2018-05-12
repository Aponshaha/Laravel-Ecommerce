<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/product/details/{id}','HomeController@productDetails');
Route::get('/category/{category_slug}','HomeController@categoryWiseProducts');
Route::get('/search/{$name}/{$category_row_id}','HomeController@search');

Route::get('/add-to-cart/{product_id}', 'CartController@addToCart');
Route::post('/post-add-to-cart','CartController@postAddToCart');

Route::post('/add-to-cart','CartController@addToCart');

Route::get('/mycart', 'CartController@mycart');

Route::post('/update-cart', 'CartController@updateCart');
Route::post('/cartItemDelete', 'CartController@cartItemDelete');
Route::any('/cartItemDeleteAll', 'CartController@cartItemDeleteAll');

//order process
Route::any('/processPayment', 'OrderController@processPayment');    
Route::post('/confirmOrder/{id}', 'OrderController@confirmOrder');

//checkout

Route::get('/checkoutPage', 'CartController@checkout1');
Route::post('/confirm-order','CartController@confirmOrder');
Route::post('/checkout', 'CartController@checkout');
Route::post('/checkoutWithregistration', 'CartController@checkoutWithregistration');


//Register....
Route::get('/user-registration', 'Auth\CommonController@showRegistrationForm')->name('user.registration');
Route::post('/user-registration', 'Auth\CommonController@register')->name('user.registration.submit');
//log in 
Route::post('/log-in', 'Auth\CommonController@login')->name('gaust.login');
Route::get('users/logout','Auth\LoginController@userlogout')->name('user.logout');



Route::get('/about-us', function () {	
    return view('about_us');
});
Route::get('/contact-us', function () {	
    return view('contact_us');
});

    Auth::routes();
    Route::get('/home', 'HomeController@index');


    Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {           
    Route::get('/admin', 'LoginController@login');
    Route::post('/postAdminLogin', 'LoginController@postAdminLogin'); 
    Route::get('/admin/logout', 'LoginController@logout');        
    Route::get('/admin/dashboard', 'DashboardController@index');
    

	Route::get('/admin/products', 'ProductController@index');	
	Route::get('/admin/product/create', 'ProductController@create');
    Route::post('/admin/product/store', 'ProductController@store');    
    Route::get('/admin/product/edit/{id}', 'ProductController@edit');
    Route::post('/admin/product/update', 'ProductController@update');
    Route::get('/admin/product/show/{id}', 'ProductController@show');
    Route::get('/admin/product/deleteRecord/{id}', 'ProductController@deleteRecord');
    Route::get('/admin/product/deleteImageOnly/{id}/{image_name}', 'ProductController@deleteImageOnly');
    Route::get('/admin/downloadExcel/{type}', 'ProductController@export');
    Route::post('/admin/importExcel', 'ProductController@importExcel');
	
	Route::get('/admin/categories', 'CategoryController@index');
	Route::get('/admin/category/create', 'CategoryController@create');
	Route::post('/admin/category/store', 'CategoryController@store');	
	Route::get('/admin/category/edit/{id}', 'CategoryController@edit');
	Route::post('/admin/category/update', 'CategoryController@update');
	Route::get('/admin/category/show/{id}', 'CategoryController@show');
    Route::get('/admin/category/deleteRecord/{id}', 'CategoryController@deleteRecord');
    



    
	
    //order list and details
    Route::get('/admin/orders', 'OrderController@index');
    Route::get('/admin/orders/details/{tracking_number}', 'OrderController@orderDetails');
    Route::post('/admin/send-sms','OrderController@sendSms')->name('send.sms');
    Route::get('/admin/download/{order_id}','OrderController@downloadPdf')->name('download.pdf');
    Route::resource('/admin/coupons', 'CouponController@index');

    
    
    Route::get('/admin/menus', 'MenuController@index');    
    Route::get('/admin/menus/create', 'MenuController@create');
    Route::post('/admin/menus/store', 'MenuController@store');    
    Route::get('/admin/menus/edit/{id}', 'MenuController@edit');
    Route::post('/admin/menus/update', 'MenuController@update');    
    Route::get('/admin/menus/deleteRecord/{id}', 'MenuController@deleteRecord');

    
    Route::get('/thankyou', function () { 
    return view('thankyou');
});

	

});
 Route::get('/test', 'TempController@test');
 Route::get('/thankyou', 'CartController@thankyou');

//--------------user profile------------------
Route::get('/my-account','ProfileController@myAccount')->name('my.account');
Route::get('/my-orders','ProfileController@myOrders')->name('my.orders');
Route::get('/my-pending-order','ProfileController@myPendingOrders')->name('my.pending.order');
Route::get('/update-profile','ProfileController@showUpdateProfileForm')->name('update.profile');
Route::post('/update-profile','ProfileController@updateProfile')->name('update.profile.submit');
Route::get('/reset-password','ProfileController@showResetPasswordForm')->name('passwords.reset');
Route::post('/reset-password', 'ProfileController@resetPassword')->name('passwords.reset.submit');
Route::get('/my-wishlist','ProfileController@myWishList')->name('my.wishlist');
Route::get('/add-to-wishlist/{product_id}','ProfileController@addToWishList');
Route::get('/give-rating/{product_id}/{rating}','ProfileController@giveRating');
Route::post('/email-to-friend','ProfileController@emailProductToFriend')->name('send.to.friend');

//------------Social Login-----------
 Route::get('auth/github', 'Auth\RegisterController@redirectToGithub');
 Route::get('auth/github/callback', 'Auth\RegisterController@handleGithubCallback');
Route::get('auth/google', 'Auth\RegisterController@redirectToProvider');
 Route::get('auth/google/callback', 'Auth\RegisterController@handleProviderCallback');
  Route::get('auth/twitter', 'Auth\RegisterController@redirectToTwitter');
 Route::get('auth/twitter/callback', 'Auth\RegisterController@handleTwitterCallback');
  Route::get('auth/facebook', 'Auth\RegisterController@redirectToFacebook');
 Route::get('auth/facebook/callback', 'Auth\RegisterController@handleFacebookCallback');

