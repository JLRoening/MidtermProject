<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  $database = new Database();
  $db = $database->connect();

  $author = new Author($db);
  $result = $author->read();
  $num = $result->rowCount();

  //Checking if there are any authors
  if($num > 0) {
        $author_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) 
        {
          extract($row);
          array_push($author_arr, (object)['id' => $id, 'author' => $author]);
        }
        echo json_encode($author_arr);
  } else {
        echo json_encode(
          array('message' => 'No Authors Found')
        );
  }
