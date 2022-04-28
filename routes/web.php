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

Route::group(['middleware' => ['CustomAuth']], function () {
    Route::get('/','CustomersController@listCustomer');
    Route::get('/list','CustomersController@listCustomer');

    Route::view('/add','add');
    Route::post('add','CustomersController@add');

    Route::get('/delete/{id}','CustomersController@delete');

    Route::get('/edit/{id}','CustomersController@edit');
    Route::post('edit','CustomersController@update');

    Route::view('register','register');
    Route::post('register','CustomersController@register');

    Route::view('login','login');
    Route::post('login','CustomersController@login');

    Route::get('/orders/{id}','OrdersController@listOrder');
    Route::get('/addOrder/{id}','OrdersController@makeOrder')
    ->name('makeOrder');
    Route::post('/addOrder/add','OrdersAdd@addOrder');


    Route::get('/logout','CustomersController@logout');

});

