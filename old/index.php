<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$view = $app->view();
$view->setTemplatesDirectory('./views');

$app->view->setData('prefix', '/old');

$app->get('/', function () use ($app) {
    $app->render('index.php');
});

$app->get('/contacts', function() use ($app){
    $app->render('index.php', ['path'=>'contacts']);
});

$app->get('/about', function() use ($app){
    $app->render('index.php', ['path'=>'about']);
});

$app->get('/interesting', function() use ($app){
    $data = json_decode(file_get_contents("../api/interesting.json"));
    $app->render('index.php', ['path' => 'interesting', 'data' => $data, 'current' => $data[0]]);
});

$app->get('/interesting/:id', function($id) use ($app){
    $data = json_decode(file_get_contents("../api/interesting.json"));
    $current = [];
    foreach($data as $now) {
        if ($now->url == $id) {
            $current = $now;
            break;
        }
    }

    $app->render('index.php', ['path' => 'interesting', 'data' => $data, 'current' => $current]);
});

function filter($input, $cat) {
    $output = [];
    foreach($input as $now) {
        if ($now->category == $cat) {
            $output[] = $now;
        }
    }

    return $output;
}

$app->get('/products', function() use ($app) {
    $data = json_decode(file_get_contents("../api/products.json"));

    $data = filter($data, 'kuhnenski-rolki');
    $app->render('index.php', ['path'=>'products', 'cat'=>$data]);
});

$app->get('/products/cat/:id', function($id) use ($app) {
    $data = json_decode(file_get_contents("../api/products.json"));

    $data = filter($data, $id);
    $app->render('index.php', ['path'=>'products', 'cat'=>$data]);
});

$app->get('/products/:id', function($id) use ($app) {
    $data = json_decode(file_get_contents("../api/products.json"));
    $current = [];
    foreach($data as $now) {
        if ($now->url == $id) {
            $current = $now;
        }
    }

    $app->render('index.php', ['path'=>'products', 'current'=>$current]);
});

$app->run();
