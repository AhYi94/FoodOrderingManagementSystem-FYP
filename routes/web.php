<?php


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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    //User Route
    Route::resource('/users', 'UserController')->except('destroy');
    Route::get('/users/{user}', 'UserController@destroy')->name('users.destroy');

    //Food Menu Route
    Route::resource('/food-menus', 'FoodMenuController')->except('destroy');
    Route::get('/food-menus/{food-menu}', 'FoodMenuController@destroy')->name('food-menus.destroy');

    //Schedule Route
    Route::resource('/schedules', 'ScheduleController');

    //Order Route
    Route::resource('/orders', 'OrderController');
});