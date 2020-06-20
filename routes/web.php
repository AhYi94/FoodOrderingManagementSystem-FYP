<?php

use Illuminate\Support\Facades\Auth;
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



Route::group(['namespace' => 'Admin','prefix' => 'admin', 'as' => 'admin'], function () {
    Route::get('login', 'LoginController@index')->name('.login');
    Route::post('check', 'LoginController@auth')->name('.check');
    Route::get('logout', 'LoginController@logout')->name('.logout');

    Route::group(['middleware' => 'checkIsAdmin'], function () {
        Route::get('home', function () {
            return view('welcome');
        })->name('.home');
    });
});
