<?php 
  class Database {
    private $hostname;
    private $database;
    private $username;
    private $password;
    private $conn;

    public function connect() {
      $hostname = 'uzb4o9e2oe257glt.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
      $username = 'casmgdvg9k7ur9e8';
      $password = 'j91vj1e2lmbdjlaa';
      $database = 'r73mbtgc4mub348o';

      try {
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
      }
      catch(PDOException $e)
      {
        echo "Connection failed: " . $e->getMessage();
      }
    }
  }