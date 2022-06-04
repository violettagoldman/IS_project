<?php
require_once("OrderStatus.php");
require_once("Cart.php");
require_once("db.php");

/**
    Order class stores a cart related to an order, its status and its id
*/
class Order
{
    private $id;
    private $status;
    private $cart;

    public function __construct($id, $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    /**
     * Returns current order instance.
     * If no order has been created yet, creates a blank one.
     * If one has been previously strated, will load it.
     * We store the latest order id in the SESSION array.
     */
    public static function get_instance()
    {
        if (ISSET($_SESSION["order_id"]))
        {
            // A previous order exist in the session, we return it.
            $id = $_SESSION["order_id"];
            $order = new Order($id, "");
            $order->load_order();
            return $order;
        }
        else
        {
            // No order has been created for this session, let's create one.
            $id = Order::gen_uid();
            $order = new Order($id, OrderStatus::New);
            $order->save();
            $_SESSION["order_id"] = $order->get_id();
            return $order;
        }
    }

    /**
     * Saves the order to the db.
     * If no order already exists with this id, create a new one.
     */
    public function save()
    {
        global $conn;
        $sql = "INSERT INTO `Orders` (`id`, `order_status`, `cart`) values ('$this->id', '$this->status', '{$this->cart->serialize()}') ON DUPLICATE KEY UPDATE `id` = '$this->id', `cart` = '{$this->cart->serialize()}';";
        $conn->select_db("mcdo");
        if ($conn->query($sql) !== True)
        {
            die("Cannot update: $conn->error");
        }
    }

    /**
     * Load an order from the db.
     */
    public function load_order()
    {
        global $conn;
        $conn->select_db("mcdo");
        $sql = "SELECT * FROM `Orders` WHERE `id` = '$this->id'";
        $result = $conn->query($sql);
        $result = $result->fetch_row();
        $this->status = $result[1];
        $this->cart = new Cart($result[2]);
    }

    public function get_id()
    {
        return $this->id;
    }

    /**
     * Generate a random order id.
     */
    private static function gen_uid($l=3){
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $l);
    }

    public function get_cart()
    {
        return $this->cart;
    }
}
?>