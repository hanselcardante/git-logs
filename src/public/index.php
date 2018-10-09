<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require './config.php';

$app = new \Slim\App(['settings' => $config]);
$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer('../templates/');

function percentegatorize($arrayOfWork) {
    $arrayOfPercentages = [];
    $totalPercentage = 0;
    $totalWork = array_reduce($arrayOfWork, function($total, $workValue) {
        return $total + $workValue;
    });

    foreach ($arrayOfWork as $key => $value) {
        $p = round($value / $totalWork, 2);
        $totalPercentage += $p;
        if ($p > .01) {
            $arrayOfPercentages[$key] = $p;
        }
    };

    if ($totalPercentage < 1) {
        $minKey = null;
        foreach ($arrayOfPercentages as $pKey => $pValue) {
            if (!$minKey) {
                $minKey = $pKey;
            } else {
                $minKey = $arrayOfPercentages[$minKey] < $pValue ? $minKey : $pKey;
            }
        }

        $arrayOfPercentages[$minKey] = $arrayOfPercentages[$minKey] + 1 - $totalPercentage;
    }

    return $arrayOfPercentages;
};

function getTotalTicketHour($ticketCommits) {
    $total = [];
    foreach ($ticketCommits as $each) {
        $total[$each->getTicketNum()] = $each->getInsertions() + $each->getDeletions() + $each->getChanges();
    }
    return $total;
}

$app->get('/easy-logs', function (Request $request, Response $response, array $args) {    

    $groupCommits = new GroupCommits();
    $var = $groupCommits->groupCommit();
echo "kfsdf";
exit;
    $grouped = array_map(function($each) {
        return new TicketCommit(
            $each['ticketNum'],
            $each['message'],
            $each['author'],
            [],
            $each['insertions'],
            $each['deletions'],
            $each['changed'],
            8
        );
    }, $var);

    $results = getTotalTicketHour($grouped);
    $percent = percentegatorize($results);

    foreach ($grouped as $each) {
        $each->setPercentage($percent[$each->getTicketNum()]);
    };

    //    var_dump($results);
    var_dump($percent);
    var_dump(array_map(function($each) {return $each->getDataAsArray();}, $grouped));
    print_r('test');
    exit;
    $response = $this->view->render($response, 'app.phtml', ['logs' => 'dafsf']);

    return $response;
});

$app->get('/logs', function (Request $request, Response $response, array $args) {    
        $data = $request->getQueryParams();

        print_r($data); exit;
        $test = ['hello', 'hi'];


        return json_encode($test);
    // $logs = new Logs;
    // $logs->getResult();

    // $data = ['the', 'quick', 'brown', 'fox'];

    // $response = $this->view->render($response, 'app.phtml', ['logs' => $data]);

    // return $response;
});

$app->run();
