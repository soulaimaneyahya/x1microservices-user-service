<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['middleware' => 'client.credentials'], function () use ($router) {
    $router->get('/users', [
        'as' => 'users.index',
        'uses' => 'UserController@index'
    ]);
    $router->get('/users/{userId}', [
        'as' => 'users.show',
        'uses' => 'UserController@show'
    ]);
});

/**
 * Routes protected by user credentials
 */
$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/users/auth', [
        'as' => 'users.auth',
        'uses' => 'UserController@auth'
    ]);
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
