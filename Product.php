<?php

class Product
{

    private $id;
    private $item;
    private $item_description;
    private $price;
    private $image_url;

    public function __construct($id, $item, $item_description, $price, $image_url)
    {
        $this->id = $id;
        $this->item = $item;
        $this->item_description = $item_description;
        $this->price = $price;
        $this->image_url = $image_url;
    }

    public static function get_all_products()
    {
        global $conn;
        $conn->select_db("mcdo");
        $sql = "SELECT * FROM `Products`";
        $result = $conn->query($sql);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $array = [];
        foreach ($result as $row) {
            $array[] = new Product(
                $row['id'],
                $row['item'],
                $row['item_description'],
                $row['price'],
                $row['image_url']
            );
        }
        return $array;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_item()
    {
        return $this->item;
    }

    public function get_item_description()
    {
        return $this->item_description;
    }

    public function get_price()
    {
        return $this->price;
    }

    public function get_image_url()
    {
        return $this->image_url;
    }
}

?>