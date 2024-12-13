<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/**
 * Routes protected by user credentials
 */
$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/users/auth', [
        'as' => 'users.auth',
        'uses' => 'Users\UserController@auth'
    ]);
});

$router->group(['middleware' => 'client.credentials'], function () use ($router) {
    /**
     * Users
     */
    $router->get('/users', [
        'as' => 'users.index',
        'uses' => 'Users\UserController@index'
    ]);

    $router->get('/users/{userId}', [
        'as' => 'users.show',
        'uses' => 'Users\UserController@show'
    ]);

    /**
     * Authors
     */
    $router->get('/authors', [
        'as' => 'authors.index',
        'uses' => 'Authors\AuthorController@index'
    ]);

    $router->get('/authors/{authorId}', [
        'as' => 'authors.show',
        'uses' => 'Authors\AuthorController@show'
    ]);

    /**
     * Books
     */
    $router->get('/books', [
        'as' => 'books.index',
        'uses' => 'Books\BookController@index'
    ]);

    $router->get('/books/{bookId}', [
        'as' => 'books.show',
        'uses' => 'Books\BookController@show'
    ]);
});

/**
 * Laravel passport
 */
$router->post('/oauth-client/{userId}', [
    'as' => 'oauth-client',
    'uses' => 'OAuth\OAuthClientController'
]);

$router->post('/oauth/token', [
    'as' => 'oauth.token',
    'uses' => '\Dusterio\LumenPassport\Http\Controllers\AccessTokenController@issueToken'
]);

$router->get('/', function () use ($router) {
    return $router->app->version();
});
