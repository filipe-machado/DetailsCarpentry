<?php

require_once("vendor/autoload.php");

// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false
]];
$app = new \Slim\App($config);

// Define app routes
$app->get('/', function () {    
    $page = new \Details\Page();
    $page->setTpl("index");
});

$app->get('/admin', function () {    
    $page = new \Details\PageAdmin();
    $page->setTpl("index");
});

// Run app
$app->run();
