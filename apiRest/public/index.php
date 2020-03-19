<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//use Slim\Factory\AppFactory;

require '../vendor/autoload.php';
require '../src/config/db.php';
$app = new \Slim\App;

//routes Products
require '../src/routes/products.php';

$app->run();