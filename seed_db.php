<?php
include_once("db.php");

/**
 * Create the main database, 'mcdo'.
 */
$sql = "CREATE DATABASE mcdo";
if ($conn->query($sql) === TRUE)
{
  echo "Database created successfully";
}
else
{
  echo "Error creating database: " . $conn->error;
}
$conn->select_db("mcdo");

/**
 * Create the 'Orders' database.
 */
$sql = "CREATE TABLE Orders (
    id VARCHAR(3) PRIMARY KEY,
    order_status VARCHAR(30) NOT NULL,
    cart VARCHAR(1024),
    update_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )"; 
if ($conn->query($sql) === TRUE)
{
    echo "Table created successfully";
}
else
{
    echo "Error creating table: " . $conn->error;
}

/**
 * Create the 'Products' table.
 */
$sql = "CREATE TABLE Products (
  id INT(5) UNSIGNED PRIMARY KEY,
  category VARCHAR(50),
  item VARCHAR(50),
  item_description VARCHAR(200),
  price FLOAT(4) NOT NULL,
  image_url VARCHAR(1000),
  update_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )"; 
if ($conn->query($sql) === TRUE)
{
  echo "Table created successfully";
}
else
{
  echo "Error creating table: " . $conn->error;
}

/**
 * Import the products into the 'Products' table.
 */
$csv = fopen("./products.csv", "r");
while (($row = fgetcsv($csv)) !== FALSE)
{
  $row[4] = floatval(str_replace(",", ".", $row[4]));
  $sql = "INSERT INTO `Products` (`id`, `category`, `item`, `item_description`, `price`, `image_url`) values ($row[0], \"$row[1]\", \"$row[2]\", \"$row[3]\", $row[4], \"$row[5]\")";
  if ($conn->query($sql) !== TRUE)
  {
    echo "Cannot insert line. SQL: $sql<br />Error: $conn->error<br />";
  }
}

$conn->close();

?>