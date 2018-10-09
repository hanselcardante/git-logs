<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require './config.php';

$app = new \Slim\App(['settings' => $config]);
$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer('../templates/');


$app->get('/easy-logs', function (Request $request, Response $response, array $args) {
    // $response->getBody()->write("Hello, $name");
    $logs = new Logs;
    $logs->getResult();

    $data = ['the', 'quick', 'brown', 'fox'];

    $response = $this->view->render($response, 'app.phtml', ['logs' => $data]);

    return $response;
});

$app->get('/logs', function (Request $request, Response $response, array $args) {
        $data = $request->getQueryParams();

        //print_r($data); exit;
        $test = [
          [
           “ticketNum” => 'spk-100',
           “commitMgs” => 'hello world',
           “author” => 'john',
           “hours” => '3h 20m',
         ],
         [
           “ticketNum” => 'spk-200',
           “commitMgs” => 'meessage',
           “author” => 'aldrin',
           “hours” => '4h 40m',
         ]
        ];
        return json_encode($test);
    // $logs = new Logs;
    // $logs->getResult();

    // $data = ['the', 'quick', 'brown', 'fox'];

    // $response = $this->view->render($response, 'app.phtml', ['logs' => $data]);

    // return $response;
});

$app->run();
