<?php
  class Author {
    // Database
    private $conn;
    private $table = 'authors';

    // Properties
    public $id;
    public $author;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Authors
    public function read() {
      $query = 'SELECT
                  id,
                  author
                FROM
                  ' . $this->table;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Author
  public function read_single(){
    $query = 'SELECT
                id,
                author
              FROM
                ' . $this->table . '
              WHERE id = ?
              LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set Properties
      if($row && $row['author']){
          $this->id = $row['id'];
          $this->author = $row['author'];
      }
  }

  // Create Author
  public function create() {
    $query = 'INSERT INTO ' .
                $this->table . '
              SET
              author = :author';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->author = htmlspecialchars(strip_tags($this->author));

  // Bind data
  $stmt-> bindParam(':author', $this->author);

  // Execute query
  if($stmt->execute()) {

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $this->conn->lastInsertId();
  }

  // Print Error
  printf("Error: $s.\n", $stmt->error);

  return -1;
  }

  // Update Author
  public function update() {
    $query = 'UPDATE ' .
                $this->table . '
              SET
                author = :author
              WHERE
              id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->author = htmlspecialchars(strip_tags($this->author));
  $this->id = htmlspecialchars(strip_tags($this->id));

  // Bind data
  $stmt-> bindParam(':author', $this->author);
  $stmt-> bindParam(':id', $this->id);

  // Execute query
  if($stmt->execute()) {
    return $stmt->rowCount() > 0;
  }

  // Print Error
  printf("Error: $s.\n", $stmt->error);
  return false;
  }

  // Delete Author
  public function delete() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean Data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    try {
      if($stmt->execute()) {
        return $stmt->rowCount();
      }
    } catch (\Throwable $th) {

    }
    return false;
    }
  }
