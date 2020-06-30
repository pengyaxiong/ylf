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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/team', 'TeamController@index')->name('team');

Route::get('/contact', 'ContactController@index')->name('contact');

Route::get('/content', 'ContentController@index')->name('content');

Route::get('/content_detail/{id}', 'ContentController@content_detail')->name('content_detail');

Route::get('/password', 'HomeController@password')->name('password');
Route::post('/reset_password', 'HomeController@reset_password')->name('reset_password');