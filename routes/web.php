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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'Item\ItemController@index');
Route::get('/detail', 'Item\ItemController@detail');

// ユーザー画面
Route::get('/create', 'Item\ItemController@create');
Route::get('/edit', 'Item\ItemController@edit');





// prefix namespace group
//Route::prefix('user')->namespace('User')->group(function (){
//});


//Route::prefix('admin')->group(function () {
//    Route::get('users', function () {
//        // Matches The "/admin/users" URL
//    });
//});
//
//Route::prefix('/')->namespace('Article')
//    ->group(function () {
//      // do something
//  });


// Router.php
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
