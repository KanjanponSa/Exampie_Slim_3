<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';

$app = new \Slim\App;
$app->get('/', function (Request $request, Response $response, array $args) {

  $response->getBody()->write(json_encode("Come Di"));

  return $response;
});

$app->post('/login', \App\Controller\Member::class . ":login");


$app->run();
