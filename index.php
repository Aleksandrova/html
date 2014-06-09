<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$view = $app->view();
$view->setTemplatesDirectory('./views');

$app->view->setData('prefix', '');

$app->get('/', function () use ($app) {
    $data = json_decode(file_get_contents("./api/products.json"));
    shuffle($data);
    $data = array_slice($data, 0, 3);
    $app->render('index.php', ['path' => 'home', 'title' => 'Начало', 'data' => $data]);
});

$app->get('/contacts', function() use ($app){
    $app->render('index.php', ['path'=>'contacts', 'title' => 'Контакти']);
});

$app->get('/about', function() use ($app){
    $app->render('index.php', ['path'=>'about', 'title' => 'За нас']);
});

$app->get('/interesting', function() use ($app){
    $data = json_decode(file_get_contents("./api/interesting.json"));
    $app->render('index.php', ['path' => 'interesting', 'data' => $data, 'current' => $data[0], 'title' => 'Интерестно']);
});

$app->get('/interesting/:id', function($id) use ($app){
    $data = json_decode(file_get_contents("./api/interesting.json"));
    $current = [];
    foreach($data as $now) {
        if ($now->url == $id) {
            $current = $now;
            break;
        }
    }
    $title = isset($current->url) ? $current->title : 'Интерестно';
    $app->render('index.php', ['path' => 'interesting', 'data' => $data, 'current' => $current, 'title'=>$title]);
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
    $data = json_decode(file_get_contents("./api/products.json"));

    $data = filter($data, 'kuhnenski-rolki');
    $app->render('index.php', ['path'=>'products', 'cat'=>$data, 'title' => 'Продукти']);
});

$app->get('/products/cat/:id', function($id) use ($app) {
    $data = json_decode(file_get_contents("./api/products.json"));

    $data = filter($data, $id);
    $app->render('index.php', ['path'=>'products', 'cat'=>$data, 'title' => 'Продукти']);
});

$app->get('/products/:id', function($id) use ($app) {
    $data = json_decode(file_get_contents("./api/products.json"));
    $current = [];
    foreach($data as $now) {
        if ($now->url == $id) {
            $current = $now;
        }
    }
    $title = isset($current->url) ? $current->title : 'Продукти';
    $app->render('index.php', ['path'=>'products', 'current'=>$current, 'title'=>$title]);
});

$app->notFound(function () use ($app) {
    $app->render('index.php', ['path'=>'404', 'title'=>'Страницата не бе намерена.']);
});

$app->run();
