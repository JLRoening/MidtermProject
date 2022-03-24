<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  $database = new Database();
  $db = $database->connect();

  $author = new Author($db);
  $data = json_decode(file_get_contents("php://input"));

  if (missingParams($author->id, $author->author) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    return;
  }

  $author->id = $data->id;
  $author->author = $data->author;

  if($author->update()) {
    echo json_encode(
      array('id' => $author->id, 'author' => $author->author)
    );
  }