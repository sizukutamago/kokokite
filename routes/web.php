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

Route::get('/', 'TopController@showTop');

Route::get('/create_room', 'TopController@showCreateRoom');

Route::post('/create_room', 'TopController@createRoom');

Route::get('/{id}', 'MainController@showMain');

Route::get('/{id}/pusher' , 'MainController@push');

Route::get('/{id}/push', 'MainController@push_latlng');

Route::get('/{id}/done', 'MainController@done');