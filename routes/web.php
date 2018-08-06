<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('send-emails','EmailController@send');
