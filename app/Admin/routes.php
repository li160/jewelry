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
    $router->resource('images', ImageController::class);//图片管理
    $router->resource('hometype', HomeTypeController::class);//首页类型管理
    $router->resource('homegood', HomeGoodController::class);//首页商品管理
    $router->resource('diamond', DiamondController::class);//钻石管理
    $router->resource('appointment', AppointmentController::class);//预约管理
});
