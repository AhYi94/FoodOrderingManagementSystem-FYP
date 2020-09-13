<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::group(['middleware' => ['admin']], function () {
        //Admin Order Route
        Route::get('/admin/orders', 'OrderController@indexAdmin')->name('admin.orders.index');
        Route::get('/admin/orders/{user_id}', 'OrderController@showScheduleAdmin')->name('admin.orders.showSchedule');
        Route::get('/admin/orders/{user_id}/{date}', 'OrderController@showOrderAdmin')->name('admin.orders.showOrder');
        Route::post('/admin/orders/{user_id}/{date}', 'OrderController@storeAdmin')->name('admin.orders.store');

        //Food Menu Route
        Route::resource('/food-menus', 'FoodMenuController');
        Route::get('/food-menus/{food-menu}', 'FoodMenuController@destroy')->name('food-menus.destroy');

        //Schedule Route
        Route::resource('/schedules', 'ScheduleController');

        //Top-Up Route
        Route::resource('/top-ups', 'TopUpController')->except('store');

        //View Order route
        Route::get('/view-orders', 'ViewOrderController@index')->name('view-orders.index');
        Route::get('/view-orders/{date}', 'ViewOrderController@show')->name('view-orders.show');
    });

    //User Route
    Route::get('/users', 'UserController@index')->name('users.index')->middleware('admin');
    Route::resource('/users', 'UserController')->except('index');

    //Order Route
    Route::resource('/orders', 'OrderController')->except('store');
    Route::post('/orders/{order}', 'OrderController@store')->name('orders.store');

    //View Order route
    Route::get('/user/view-orders', 'ViewOrderController@userShow')->name('user-view-orders.index');
    
});
