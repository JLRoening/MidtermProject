<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  $database = new Database();
  $db = $database->connect();

  $category = new Category($db);
  $category->id = isset($_GET['id']) ? $_GET['id'] : die();

  if($category->read_single()){
    $category_arr = array(
      'id' => $category->id,
      'category' => $category->category
    );
    json_encode($category_arr);
  }else{
    json_encode(
      array('message' => 'Category Not Found')
    );
  }