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

Route::prefix('item')->namespace('Item')->group(function () {
    Route::post('/search', 'ItemApiController@search');
    Route::get('/get', 'ItemApiController@get');
});

// ログインが必要
//Route::middleware('auth.basic')->group(function () {
    Route::prefix('item')->namespace('Item')->group(function () {
        Route::post('/save', 'ItemApiController@save');
    });
//});

Route::prefix('category')->group(function () {
    Route::get('/get_sub_category', 'Item\ItemApiController@getSubCategory');
    Route::get('/get_category', 'Item\ItemApiController@getCategory');
});


