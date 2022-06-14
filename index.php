<?php
session_start();
ini_set("display_errors", 1);

require_once("db.php");
include_once("Order.php");
include_once("Product.php");
$order = Order::get_instance();
$products = Product::get_all_products();

if (ISSET($_GET["cart_update"]))
{
    $id = strval(intval($_GET["cart_update"]));
    $add = strpos($_GET["cart_update"], "-") === False;
    if ($add)
    {
        $order->get_cart()->get_item($id)->increment();
    }
    else
    {
        $order->get_cart()->get_item($id)->decrement();
    }
    $order->save();
}

if (ISSET($_GET["reset"]))
{
    session_destroy();
    header('Location: /');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
<ul>
 <li><a class='active' href='/'>🍟 Produits</a></li>
  <li><a href='done.php'>✅ Valider</a></li>
 </ul>
 
 <div id='background'>
 </div>

<div style='margin-left:25%;padding:1px 16px;height:1000px;'>
  
  <div class='header'>
  <h1>🍟 Nos Produits</h1>
  </div>
  
  <h3>Veuillez sélectionner nos produits</h3>

  <p>Une fois satisfait.e de votre panier, vous pouvez <b>valider</b> votre commande 🙂.</p>

<?php
  echo "<p>Total Price is: {$order->get_cart()->get_total()}€</p>"
?>

  <div class='container'>
  <?php
  foreach ($products as $product) {
  echo "
  <div class='card'>
   <img src=\"{$product->get_image_url()}\" style='width:180px; height:180px; object-fit: scale-down;'>
   <h4><b>{$product->get_item()}</b></h4> 
   <span>{$product->get_item_description()}</span>
   <p class='price'><b>{$product->get_price()}€</b></p> 
   <a class='buttonPlus' href='?cart_update={$product->get_id()}+'>+</a>
   <span>{$order->get_cart()->get_item($product->get_id())->get_quantity()}</span>
   <a class='buttonMinus' href='?cart_update={$product->get_id()}-'>-</a>
  </div>";
  }
?>
</div>
</body>
</html>