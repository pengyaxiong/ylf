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

//联系我们
Route::post('/contact', 'ApiController@contact');

//发送邮件
Route::post('/email_code', 'ApiController@email_code');

//切换语言
Route::post('/language', 'ApiController@language');