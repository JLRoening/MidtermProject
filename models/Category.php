<?php
  class Category {
    // Database
    private $conn;
    private $table = 'categories';

    // Properties
    public $id;
    public $category;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Categories
    public function read() {
      $query = 'SELECT
                  id,
                  category
                FROM
                  ' . $this->table;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Category
  public function read_single(){
    $query = 'SELECT
                id,
                category
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
      if($row && $row['category']){
          $this->id = $row['id'];
          $this->category = $row['category'];
      }
  }

  // Create Category
  public function create() {
    $query = 'INSERT INTO ' .
                $this->table . '
              SET
                category = :category';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->category = htmlspecialchars(strip_tags($this->category));

  // Bind data
  $stmt-> bindParam(':category', $this->category);

  // Execute query
  if($stmt->execute()) {

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $this->conn->lastInsertId();;
  }

  // Print Error
  printf("Error: $s.\n", $stmt->error);

  return -1;
  }

  // Update Category
  public function update() {
    $query = 'UPDATE ' .
                $this->table . '
              SET
                category = :category
              WHERE
              id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->category = htmlspecialchars(strip_tags($this->category));
  $this->id = htmlspecialchars(strip_tags($this->id));

  // Bind data
  $stmt-> bindParam(':category', $this->category);
  $stmt-> bindParam(':id', $this->id);

  // Execute query
  if($stmt->execute()) {
    return $stmt->rowCount() > 0;
  }

  // Print Error
  printf("Error: $s.\n", $stmt->error);
  return false;
  }

  // Delete Category
  public function delete() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
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
