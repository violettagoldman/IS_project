<?php

class Item
{
    private $id;
    private $quantity;

    public function __construct($id, $quantity)
    {
        $this->id = $id;
        $this->quantity = $quantity;
    }

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > 0)
            $this->quantity--;
    }


    public function get_id()
    {
        return $this->id;
    }

    public function get_quantity()
    {
        return $this->quantity;
    }
}

?>