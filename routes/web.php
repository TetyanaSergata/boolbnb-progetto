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

Route::get('/','FlatController@index')->name('my-home');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::post('/search', 'SearchController@index')->name('search');
Route::get('/flats', 'FlatController@index')->name('flats');
Route::get('/flats/{slug}', 'FlatController@show')->name('show.flat');
Route::post('/flats/show/store', 'MessageController@store')->name('message.store');

Route::name('account.')->namespace('Account')->middleware('auth')->prefix('account')->group(function () {
    Route::resource('flats','FlatController');
    Route::resource('user', 'UserController');
    Route::get('/', 'FlatController@index')->name('index');
    Route::get('/messages', 'MessageController@index')->name('message.index');
    Route::get('/stats/{slug}', 'StatController@show')->name('stat.show');
});

// mostra pagina pagamento
Route::post('/payment/make', 'PaymentsController@index')->name('payment.index');
// effettua il pagamento
Route::get('/payment/make/{price}', 'PaymentsController@make')->name('payment.make');
