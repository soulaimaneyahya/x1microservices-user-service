<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/users', 'UserController@index');
$router->get('/users/{userId}', 'UserController@show');

$router->get('/', function () use ($router) {
    return $router->app->version();
});
