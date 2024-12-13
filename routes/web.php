<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/**
 * Routes protected by user credentials
 */
$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/users/auth', [
        'as' => 'users.auth',
        'uses' => 'UserController@auth'
    ]);
});

$router->group([], function () use ($router) {
    /**
     * Users
     */
    $router->get('/users', [
        'as' => 'users.index',
        'uses' => 'UserController@index'
    ]);
    $router->get('/users/{userId}', [
        'as' => 'users.show',
        'uses' => 'UserController@show'
    ]);

    /**
     * Authors
     */
    $router->get('/authors', [
        'as' => 'authors.index',
        'uses' => 'AuthorController@index'
    ]);
    $router->get('/authors/{authorId}', [
        'as' => 'authors.show',
        'uses' => 'AuthorController@show'
    ]);

    /**
     * Books
     */
    $router->get('/books', [
        'as' => 'books.index',
        'uses' => 'BookController@index'
    ]);
    $router->get('/books/{bookId}', [
        'as' => 'books.show',
        'uses' => 'BookController@show'
    ]);
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
