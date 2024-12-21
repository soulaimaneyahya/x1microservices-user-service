<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/**
 * Routes protected by user credentials
 * Laravel passport
 */
$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/users/auth', [
        'as' => 'users.auth',
        'uses' => 'Users\UserController@auth'
    ]);
});

/**
 * Lumen passport
 * client.credentials
 */
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

    $router->post('/authors',  [
        'as' => 'authors.store',
        'uses' => 'Authors\AuthorController@store'
    ]);

    $router->get('/authors/{authorId}', [
        'as' => 'authors.show',
        'uses' => 'Authors\AuthorController@show'
    ]);

    $router->post('/authors/{authorId}',  [
        'as' => 'authors.store',
        'uses' => 'Authors\AuthorController@update'
    ]);

    $router->put('/authors/{authorId}',  [
        'as' => 'authors.update',
        'uses' => 'Authors\AuthorController@update'
    ]);

    $router->delete('/authors/{authorId}',  [
        'as' => 'authors.destroy',
        'uses' => 'Authors\AuthorController@destroy'
    ]);

    /**
     * Books
     */
    $router->get('/books', [
        'as' => 'books.index',
        'uses' => 'Books\BookController@index'
    ]);

    $router->post('/books',  [
        'as' => 'books.store',
        'uses' => 'Books\BookController@store'
    ]);

    $router->get('/books/{bookId}', [
        'as' => 'books.show',
        'uses' => 'Books\BookController@show'
    ]);

    $router->put('/books/{bookId}',  [
        'as' => 'books.update',
        'uses' => 'Books\BookController@update'
    ]);

    $router->delete('/books/{bookId}',  [
        'as' => 'books.destroy',
        'uses' => 'Books\BookController@destroy'
    ]);
});

/**
 * Lumen passport
 * OAuth
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
