<?php
session_start();
ini_set("display_errors", 1);

require_once("db.php");
include_once("Order.php");
$order = Order::get_instance();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body></body>
</html>