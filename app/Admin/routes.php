<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('goodtype', GoodTypeController::class);//商品分类管理
    $router->resource('good', GoodController::class);//商品管理
    $router->resource('config', ConfigController::class);//商品管理
});
