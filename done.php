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
<html>
<head>
  <meta charset="utf-8">
  <meta name="author" content="Shana">
  <title>Mcdonald's Borne</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
 
 
 <div id="background">
 </div>

<div style="margin-left:25%;padding:1px 16px;height:1000px;">
  
  <div class="header">
  <h1>✅ Validé</h1>
  </div>
  
  <h3>Vous avez validé votre panier :</h3>

  <p>Merci pour votre commande ! Nous vous préparons vos plats au plus vite pour une meilleure dégustation 🍔😋🍟</p>

  <p> Allez à la caisse et payez : 
    <span class="important"> <?php
       echo $order->get_cart()->get_total();
    ?>€</span>
  </p>

  <p> Votre numéro de commande est le : 
    <span class="important"> <?php
      echo $order->get_id();
    ?></span>
  </p>
  <p> 👋 A très bientôt !</p>

  <a class="buttonPlus" href="index.php?reset">Passer une nouvelle commande</a>

</div>

</body>

</html>
