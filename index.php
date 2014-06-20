<?php
session_start();
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$view = $app->view();
$view->setTemplatesDirectory('./app/views');

$app->view->setData('prefix', '');
$app->view->setData('lng', 'bg');

function _link($data){
    $app = \Slim\Slim::getInstance();
    return 'href="' . $app->view->getData('prefix') . '/' . $app->view->getData('lng') . $data . '"';
}

$app->hook('slim.before', function() use ($app){
    $env = $app->environment();

    if( preg_match("/^\/(bg|en)/", $env['PATH_INFO'], $out) ) {
        $app->view->setData('lng', $out[1]);
        $env['PATH_INFO'] = str_replace($out[0], '', $env['PATH_INFO']);
    }

    require('./app/lang/' . $app->view->getData('lng') . '.php');
    $app->view->setData('label', $lang);
});

$app->get('/', function () use ($app) {
    $data = json_decode(file_get_contents("./app/api/products.json"));
    shuffle($data);
    $data = array_slice($data, 0, 6);
    $app->render('index.php', ['path' => 'home', 'title' => 'Начало', 'data' => $data]);
});

$app->get('/contacts', function() use ($app) {
	$data = json_decode(file_get_contents("./app/api/cities.json"));
    $app->render('index.php', ['path'=>'contacts', 'title' => 'Контакти', 'data' => $data]);
});

$app->post('/contacts', function() use ($app) {
    require 'Slim/Validator.php';

    $validation = new Validation();
    try {
        $validation->add($app->request->post('email'))->isEmail("Невалиден e-mail адрес.");
        $validation->add($app->request->post('name'))->min(4, "Името трябва да е минимум 4 символа.");
        $validation->add($app->request->post('message'))->min(15, "Текста трябва е минимум 15 символа.");
        $app->flash('success', true);

        $message = wordwrap($app->request->post('email'), 70);
        $email = $app->request->post('email');
        $name = $app->request->post('name');

       // mail("fobosr@gmail.com", "Сайт форма - От $name", $message, "From: $email\n");
    } catch(ValidationException $e) {
        $app->flash('error', $e->getMessage());
    } 
    $app->redirect('/contacts', 301);
});

$app->get('/contacts/:id', function($id) use ($app){
	$data = json_decode(file_get_contents("./app/api/cities.json"));
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
    $data = json_decode(file_get_contents("./app/api/interesting.json"));
    $app->render('index.php', ['path' => 'interesting', 'data' => $data, 'current' => $data[0], 'title' => 'Интерестно']);
});

$app->get('/interesting/:id', function($id) use ($app){
    $data = json_decode(file_get_contents("./app/api/interesting.json"));
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

class linkGenerator {
    public $prefix, $currentSub, $currentCat;

    public function __construct($currentCat, $currentSub) {
        $this->currentCat = $currentCat;
        $this->currentSub = $currentSub;
        $this->prefix = \Slim\Slim::getInstance();
    }

    public function gen($cat, $sub = false) {
        $link = $this->prefix->view->getData('prefix') . "/" . $this->prefix->view->getData('lng') . "/products/cat/$cat" . ($sub ? '/' . $sub : '');
        $active = $cat == $this->currentCat && ((!$sub && !$this->currentSub) || $this->currentSub == $sub);
        return 'href="' . $link . '"' . ($active ? ' class="active"' : '');
    }
}

$app->get('/products', function() use ($app) {
    $data = json_decode(file_get_contents("./app/api/products.json"));

    $data = filter($data, 'kuhnenski-rolki');
    $app->render('index.php', ['path'=>'products', 'cat'=>$data, 'title' => 'Продукти', 'id' => 'kuhnenski-rolki']);
});

$app->get('/products/cat/:id', function($id) use ($app) {
    $data = json_decode(file_get_contents("./app/api/products.json"));

    $data = filter($data, $id);
    $app->render('index.php', ['path'=>'products', 'cat'=>$data, 'title' => 'Продукти', 'id' => $id]);
});

$app->get('/products/cat/:id/:sub', function($id, $sub) use ($app) {
    $data = json_decode(file_get_contents("./app/api/products.json"));

    $output = [];
    foreach($data as $now) {
        if ($now->category == $id && $now->sub == $sub) {
            $output[] = $now;
        }
    }


    $app->render('index.php', ['path'=>'products', 'cat'=>$output, 'title' => 'Продукти', 'id' => $id, 'sub'=>$sub]);
});

$app->get('/products/:id', function($id) use ($app) {
    $data = json_decode(file_get_contents("./app/api/products.json"));
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
