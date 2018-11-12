<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \src\Model\Commit;
use \src\Model\Project;
use \src\Classes\LogManager;
use \src\Classes\LogFactory;

require '../vendor/autoload.php';
require './config.php';

$app = new \Slim\App(['settings' => $config]);
$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer('../templates/');
$container['logManager'] = new LogManager(new LogFactory);

$app->get('/easy-logs', function (Request $request, Response $response, array $args) {
    $response = $this->view->render($response, 'app.phtml', ['logs' => 'dafsf']);
    return $response;
});

$app->get('/logs', function (Request $request, Response $response, array $args) {
    $data = $request->getQueryParams();
    // sample data 
    $data['dir'] = '/Users/hanselcardante/Sites/Chromedia/spokehealth';
    $data['date'] = '2018-10-04';
    $data['author'] = '';
    //  end sample data

    $project = new Project($data['date'], $data['author'], $data['dir']);
    $result = $this->logManager->process($project);
    echo '<pre>';
    print_r($result);
});

$app->run();
