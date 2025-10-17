<?php
require_once "content.php";
class item extends content{
    private $item_id;
    private $name;
    private $price;
    private $image_location;
    private $description;
    private $itempage;
    private $amount;

    public function __construct($item_id,$name,$price,$description,$image_location,$itempage=false,$amount=0){
        //================================================
        // Constructs the item and reads the price image 
        // and description from the database and stores it.
        //================================================
        $this->amount = $amount;
        $this->item_id = $item_id;
        $this->price = $price;
        $this->image_location = $image_location;
        $this->description = $description;
        $this->name = $name;
        $this->itempage = $itempage;
    }
    
    public function showContent(){
        //=======================================================================
        // Show the item with image, name and price given the items id. Also 
        // shows description and puts the item name as header if the item is 
        // shown on its own page.
        //=======================================================================
        if ($this->itempage){
            echo "<h2>" . $this->name . "\n </h2>";
        }
        echo "<a href='index.php?page=8&item_id=" . $this->item_id . "'>";
        echo "<img src = " . $this->image_location . " id='product'></a><br>";
        if(!$this->itempage){
            echo "<p id='product_name'>" . $this->name . "\n </p>";
        }
        echo "<p id='price'>€ " . $this->price . "\n </p>";
        if ($this->itempage){
            echo "<p id='item_description'>" . $this->description . "\n </p>";
        }
        if($this->amount != 0){
            echo "<p id='item_amount'> Amount: " . $this->amount . "\n </p>";
        }
    }
}
?>