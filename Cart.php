<?php
require_once("Item.php");

class Cart
{

    private $items = [];

    public function __construct($cart_string)
    {
        $this->parse($cart_string);
    }

    /**
     * Create a string representation of the cart content.
     * Format: 'item_id:item_quantity;...'.
     * Example:
     * '2:1;4:2;98:1'
     */
    public function serialize()
    {
        $output = "";
        foreach ($this->items as $item)
        {
            if ($item->get_quantity() === 0) continue;
            $output .= $item->get_id() . ":" . $item->get_quantity() . ";";
        }
        return $output;
    }

    /**
     * Fill the cart instance from a string representation.
     */
    private function parse($cart_string)
    {
        $items = explode(";", $cart_string);
        foreach ($items as $item)
        {
            if (strlen($item) === 0) continue;
            $id = explode(":", $item)[0];
            $quantity = explode(":", $item)[1];
            $this->items[] = new Item($id, $quantity);
        }
    }

    public function get_item($item_id)
    {
        foreach ($this->items as $item)
        {
            if ($item->get_id() === $item_id)
                return $item;
        }
        $new_item = new Item($item_id, 0);
        $this->items[] = $new_item;
        return $new_item;
    }

}

?>