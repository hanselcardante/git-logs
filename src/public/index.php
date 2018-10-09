<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require './config.php';

$app = new \Slim\App(['settings' => $config]);

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    $logs = new Logs;
    $logs->test();
    return $response;
});

$app->get('/yo/{hoy}', function (Request $request, Response $response, array $args) {
    $name = $args['hoy'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->run();
