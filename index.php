<?php
session_start();
ini_set("display_errors", 1);

require_once("db.php");
include_once("Order.php");
include_once("Product.php");
$order = Order::get_instance();
$products = Product::get_all_products();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    foreach ($products as $product)
        echo "<div class=\"item\">
            <img src=\"{$product->get_image_url()}\" />
            <span>{$product->get_item()}</span>
            <span>{$product->get_item_description()}</span>
            <span>{$product->get_price()}€</span>
            <a href=\"?cart_update={$product->get_id()}+\">+</a>
            <a href=\"?cart_update={$product->get_id()}-\">-</a>
        </div>";
    ?>

</body>
</html>