<?php 
  class Database {
    private $hostname;
    private $database;
    private $username;
    private $password;
    private $conn;

    public function connect() {
      $url = getenv('JAWSDB_URL');
      $dbparts = parse_url($url);
  
      $hostname = $dbparts['host'];
      $username = $dbparts['user'];
      $password = $dbparts['pass'];
      $database = ltrim($dbparts['path'],'/');

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