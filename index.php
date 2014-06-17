<?php
session_start();
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$view = $app->view();
$view->setTemplatesDirectory('./views');

$app->view->setData('prefix', '');

$app->get('/', function () use ($app) {
    $data = json_decode(file_get_contents("./api/products.json"));
    shuffle($data);
    $data = array_slice($data, 0, 6);
    $app->render('index.php', ['path' => 'home', 'title' => 'Начало', 'data' => $data]);
});

$app->get('/contacts', function() use ($app) {
	$data = json_decode(file_get_contents("./api/cities.json"));
    $app->render('index.php', ['path'=>'contacts', 'title' => 'Контакти', 'data' => $data]);
});

$app->post('/contacts', function() use ($app) {
    require 'Slim/Validator.php';

    $validation = new Validation();
    try {
        $validation->add($app->request->post('email'))->isEmail("Невалиден e-mail.");
        $validation->add($app->request->post('name'))->min(4, "Името трябва да е минимално 4 символа.");
        $validation->add($app->request->post('message'))->min(15, "Текста трябва е инимално 15 символа.");
        $app->flash('success', true);
    } catch(ValidationException $e) {
        $app->flash('error', $e->getMessage());
    } 
    $app->redirect('/contacts', 301);
});

$app->get('/contacts/:id', function($id) use ($app){
	$data = json_decode(file_get_contents("./api/cities.json"));
    $current = null;
    foreach($data as $now) {
        if ($now->url == $id) {
            $current = $now;
            break;
        }
    }

    if($current == null) {
    	$app->redirect('/404');
    	exit;
    }

    $app->render('index.php', ['path'=>'contact-city', 'title' => 'Контакти', 'data' => $current]);
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
    $app->render('index.php', ['path'=>'products', 'cat'=>$data, 'title' => 'Продукти', 'id' => 'kuhnenski-rolki']);
});

$app->get('/products/cat/:id', function($id) use ($app) {
    $data = json_decode(file_get_contents("./api/products.json"));

    $data = filter($data, $id);
    $app->render('index.php', ['path'=>'products', 'cat'=>$data, 'title' => 'Продукти', 'id' => $id]);
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
    $cat = isset($current->category) ? $current->category : '';
    $app->render('index.php', ['path'=>'products', 'current'=>$current, 'title'=>$title, 'id' => $cat]);
});

$app->notFound(function () use ($app) {
    $app->render('index.php', ['path'=>'404', 'title'=>'Страницата не бе намерена.']);
});

$app->run();
