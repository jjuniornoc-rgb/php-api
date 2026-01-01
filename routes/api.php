<?php

use App\Core\Router;

/**
 * Função para registrar todas as rotas
 * @param Router $router
 */
return function (Router $router) {
    // Rota principal
    $router->get('/', 'HomeController@index');

    // Rotas de usuários
    $router->get('/api/users', 'UserController@index');
    $router->get('/api/users/{id}', 'UserController@show');
    $router->post('/api/users', 'UserController@store');
    $router->put('/api/users/{id}', 'UserController@update');
    $router->delete('/api/users/{id}', 'UserController@destroy');
};

