<?php

header("Content-Type: application/json");

use Alvaro\TodoPhp\config\Connection;
use Alvaro\TodoPhp\config\Router;
use Dotenv\Dotenv;


require_once 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
Connection::connect();

$httpMethod = $_SERVER['REQUEST_METHOD'];
$controller = filter_input(INPUT_GET, 'controller', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$data = $_POST;

if (empty($controller)) {
    http_response_code(200);
    echo json_encode(
        [
            'status' => 'success',
            'data' => 'Não há nada a obter nessa rota'
        ]
    );
    die;
}

$router = new Router;
$routes = [
    'user',
    'todo',
];

foreach ($routes as $route) $router->addRoute($route);

$router->dispatch($controller, $httpMethod, $id, $data);