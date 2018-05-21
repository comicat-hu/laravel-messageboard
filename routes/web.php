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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return redirect('/messages');
});

Route::auth();

Route::get('/messages', 'MessageController@index');

Route::post('/message', 'MessageController@store');

Route::delete('/message/{message}', 'MessageController@destroy');