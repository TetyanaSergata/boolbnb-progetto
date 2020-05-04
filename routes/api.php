<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->namespace('Api')->group(function () {
    Route::get('map', 'MapController@index')->name('map.index');
    Route::get('map/create', 'MapController@create')->name('map.create');
    Route::get('search', 'SearchController@index')->name('search.index');
    Route::get('search/advanced', 'SearchController@advanced')->name('search.advanced');
    Route::get('/stats', 'StatController@index')->name('stat.index');
    Route::get('/stats/messages', 'StatController@message')->name('stat.message');
    Route::get('/promo/store', 'PaymentController@store')->name('promo.store');
 });
 