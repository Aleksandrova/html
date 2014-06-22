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
	$app->view->setData('currentPath', $env['PATH_INFO']);
});

$app->get('/', function () use ($app) {
    $data = json_decode(file_get_contents("./app/api/products.json"));
    shuffle($data);
    $data = array_slice($data, 0, 6);
    $app->render('index.php', ['path' => 'home', 'title' => $app->view->getData('label')['titles']['home'], 'data' => $data]);
});

$app->get('/contacts', function() use ($app) {
	$data = json_decode(file_get_contents("./app/api/cities.json"));
    $app->render('index.php', ['path'=>'contacts', 'title' => $app->view->getData('label')['titles']['contacts'], 'data' => $data]);
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

    $app->render('index.php', ['path'=>'contact-city', 'title' => $app->view->getData('label')['titles']['contacts'], 'data' => $current]);
});

$app->get('/about', function() use ($app){
    $app->render('index.php', ['path'=>'about', 'title' => $app->view->getData('label')['titles']['about']]);
});

$app->get('/interesting', function() use ($app){
    $data = json_decode(file_get_contents("./app/api/interesting.json"));
    $app->render('index.php', ['path' => 'interesting', 'data' => $data, 'current' => $data[0], 'title' => $app->view->getData('label')['titles']['interesting']]);
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
    $app->render('index.php', ['path' => 'interesting', 'data' => $data, 'current' => $current, 'title'=>$title->{$app->view->getData('lng')}]);
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
    $app->render('index.php', ['path'=>'products', 'cat'=>$data, 'title' => $app->view->getData('label')['titles']['products'], 'id' => 'kuhnenski-rolki']);
});

$app->get('/products/cat/:id', function($id) use ($app) {
    $data = json_decode(file_get_contents("./app/api/products.json"));

    $data = filter($data, $id);
    $app->render('index.php', ['path'=>'products', 'cat'=>$data, 'title' => $app->view->getData('label')['titles']['products'], 'id' => $id]);
});

$app->get('/products/cat/:id/:sub', function($id, $sub) use ($app) {
    $data = json_decode(file_get_contents("./app/api/products.json"));

    $output = [];
    foreach($data as $now) {
        if ($now->category == $id && $now->sub == $sub) {
            $output[] = $now;
        }
    }


    $app->render('index.php', ['path'=>'products', 'cat'=>$output, 'title' => $app->view->getData('label')['titles']['products'], 'id' => $id, 'sub'=>$sub]);
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

$app->map('/_manager', function() use ($app){
    $logged = false;
    if (isset($_SESSION['logged'])) {
        $logged = true;
        $input = $app->request()->post('content');
        $status = "";
        if ($input) {
            if (json_decode($input) != NULL) {
                $status = "Успешно редактирано!";
                file_put_contents("./app/api/products.json", $input);
            } else {
                $status = "Имахте допусната синтактична грешка и промените ви не бяха запазени.";
            }
        }

        $content = file_get_contents("./app/api/products.json");
        $app->render('index.php', ['path'=>'admin', 'content' => $content, 'title'=>'Страницата не бе намерена.', 'msg'=>$status, 'logged'=>true]);
        return;
    } else {
        if ($app->request()->post('psw') == 'fobos123') {
            $_SESSION['logged'] = 1;
            $app->redirect('/manager');
        }
    }

    $app->render('index.php', ['path'=>'admin', 'logged'=>false]);
})->via('GET', 'POST');

$app->notFound(function () use ($app) {
    $app->render('index.php', ['path'=>'404', 'title'=>'Страницата не бе намерена.']);
});

$app->run();
