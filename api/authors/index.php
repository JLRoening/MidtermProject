<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    }


    require_once '../../config/Database.php';
    require_once '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) 
    {
    case 'GET':
        if(isset($_GET['id'])) {
            require 'read_single.php';
        }
        else {
            require 'read.php';
        }
        break;
    case 'PUT':
        require 'update.php';  
        break;
    case 'POST':
        require 'create.php'; 
        break;
    case 'DELETE':
        require 'delete.php'; 
        break;
    default: 
        echo 'ERROR';
        break;
    }