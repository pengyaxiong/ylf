<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('banners', 'BannerController');

    $router->resource('teams', 'TeamController');

    $router->resource('principles', 'PrincipleController');

    $router->resource('missions', 'MissionController');

    $router->resource('businesses', 'BusinessController');

    $router->resource('contacts', 'ContactController');

    $router->resource('configs', 'ConfigController');

    $router->resource('articles', 'ArticleController');

    $router->resource('categories', 'CategoryController');

    $router->resource('users', 'UserController');
});
