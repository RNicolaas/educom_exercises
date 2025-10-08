<?php
require_once "database.php";
class item{
    private $item_id;
    private $name;
    private $price;
    private $image_location;
    private $description;
    private $database;

    public function __construct($item_id,database $database){
        //================================================
        // Constructs the item and reads the price image 
        // and description from the database and stores it.
        //================================================
        $this->database = $database;
        $item_info = $this->database->getItemInfo($item_id);
        $this->item_id = $item_id;
        $this->price = $item_info['price'];
        $this->image_location = $item_info['image_location'];
        $this->description = $item_info['description'];
        $this->name = $item_info['name'];
    }
    
    public function showItem($itempage=false){
        //=======================================================================
        // Show the item with image, name and price given the items id. Also 
        // shows description and puts the item name as header if the item is 
        // shown on its own page.
        //=======================================================================
        $content = "";
        $content = $content . "<a href='index.php?page=item&item_id=" . $this->item_id . "'>";
        $content = $content . "<img src = " . $this->image_location . " id='product'></a><br>";
        if(!$itempage){
            $content = $content . "<p id='product_name'>" . $this->name . "\n </p>";
        }
        $content = $content . "<p id='price'>€ " . $this->price . "\n </p>";
        if ($itempage){
            $content = $content . "<p>" . $this->description . "\n </p>";
        }
        return($content);
    }

    public function getPrice(){
        return($this->price);
    }

    public function getID(){
        return($this->item_id);
    }

    public function getName(){
        return($this->name);
    }
}
?>