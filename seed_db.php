<?php
include_once("db.php");

// Create database
$sql = "CREATE DATABASE mcdo";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->select_db("mcdo");

// sql to create table
$sql = "CREATE TABLE Orders (
    id VARCHAR(3) PRIMARY KEY,
    order_status VARCHAR(30) NOT NULL,
    cart VARCHAR(1024),
    update_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    die("Error creating table: " . $conn->error);
}  

$conn->close();

?>