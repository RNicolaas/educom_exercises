<?php
require_once "database.php";
class item_factory {
    private $database;

    public function __construct(database $database){
        //================================================
        // Constructs the item and reads the price image 
        // and description from the database and stores it.
        //================================================
        $this->database = $database;
    }

    public function getItem($item_id){
        [$name,$price,$description,$image_location] = $this->database->getItemInfo($item_id);
        require_once "item.php";
        $item = new item($item_id,$name,$price,$description,$image_location);
        return($item);
    }
}
?>