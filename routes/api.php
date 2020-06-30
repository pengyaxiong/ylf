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

Route::group(['namespace' => 'Wechat', 'prefix' => 'wechat', 'as' => 'wechat.'], function () {
    //授权
    Route::post('/auth', 'IndexController@auth');
    //系统信息
    Route::get('/configs', 'IndexController@configs');
    //首页
    Route::get('/home', 'IndexController@home');
    //团队
    Route::get('/team', 'IndexController@team');
    //联系我们
    Route::post('/contact', 'IndexController@contact');
    //文章
    Route::get('/content', 'IndexController@content');
    Route::get('/content_detail/{id}', 'IndexController@content_detail');
    //用户信息
    Route::get('/user', 'IndexController@user');

    //发送邮件验证码
    Route::post('/email_code', 'IndexController@email_code');
    //登录
    Route::post('/login', 'IndexController@login');
    //注册
    Route::post('/register', 'IndexController@register');
    //修改密码
    Route::post('/password', 'IndexController@password');
});