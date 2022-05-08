<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('/', function () use ($router) {

});


$router->get('users', 'UserController@index');

$router->post('users', 'UserController@store');

$router->get('user/{id}', 'UserController@show');

$router->post('/login', 'UserController@authenticate');


$router->group(['prefix' => 'api/'], function ($app) {
    $app->post('item','ItemController@store');
    $app->get('item', 'ItemController@index');
    $app->get('item/{id}/', 'ItemController@show');
    $app->put('item/{id}/', 'ItemController@update');
    $app->delete('item/{id}/', 'ItemController@destroy');
});


$router->group(['prefix' => 'api/'], function ($app) {
    $app->post('category','CategoryController@store');
    $app->get('category', 'CategoryController@index');
    $app->get('category/{id}/', 'CategoryController@show');
    $app->put('category/{id}/', 'CategoryController@update');
    $app->delete('category/{id}/', 'CategoryController@destroy');
});

$router->group(['prefix' => 'api/'], function ($app) {
    $app->post('location','LocationController@store');
    $app->get('location', 'LocationController@index');
    $app->get('location/{id}/', 'LocationController@show');
    $app->put('location/{id}/', 'LocationController@update');
    $app->delete('location/{id}/', 'LocationController@destroy');
});

$router->group(['prefix' => 'api/'], function ($app) {
    $app->post('sale','SaleController@store');
    $app->get('sale', 'SaleController@index');
    $app->get('sale/{id}/', 'SaleController@show');
    $app->put('sale/{id}/', 'SaleController@update');
    $app->delete('sale/{id}/', 'SaleController@destroy');
});

$router->group(['prefix' => 'api/'], function ($app) {
    $app->post('receive','ReceiveController@store');
    $app->get('receive', 'ReceiveController@index');
    $app->get('receive/{id}/', 'ReceiveController@show');
    $app->put('receive/{id}/', 'ReceiveController@update');
    $app->delete('receive/{id}/', 'ReceiveController@destroy');
});