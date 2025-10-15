<?php
require_once "content.php";
class item extends content{
    private $item_id;
    private $name;
    private $price;
    private $image_location;
    private $description;

    public function __construct($item_id,$name,$price,$description,$image_location){
        //================================================
        // Constructs the item and reads the price image 
        // and description from the database and stores it.
        //================================================
        $this->item_id = $item_id;
        $this->price = $price;
        $this->image_location = $image_location;
        $this->description = $description;
        $this->name = $name;
    }
    
    public function showContent($itempage=false){
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
}
?>