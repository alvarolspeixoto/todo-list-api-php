<?php

var_dump($_GET);
die;

header("Content-Type: application/json");

use Alvaro\TodoPhp\config\database\Connection;
use Dotenv\Dotenv;

require_once 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$connection = Connection::connect();
$query = $connection->prepare('SELECT * FROM user');
$query->execute();
$users = $query->fetchAll();

echo json_encode($users);