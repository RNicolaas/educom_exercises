<?php
require_once "page.php";
require_once "item.php";
require_once "database.php";
class shop_page extends page{
    private $item_list;
    private $database;

    public function __construct($response, database $database){
        //================================================
        // Constructs the cart_page by making an item 
        // object for the inputted item id and initialising 
        // the content of the page to show the item.
        //================================================
        $this->database = $database;
        $title = "Shop";
        [$content,$item_list] = $this->getItems();
        $this->item_list = $item_list;
        parent::__construct($title,$content,$response);
    }

    private function getItems(){
        //=======================================================================
        // Get all item ids from the database and then show all of the items.
        //=======================================================================
        $items = [];
        $content = "";
        $item_ids = $this->database->getAllFromTable("item_id","items");
        $i = 0;
        while ($row = $item_ids -> fetch_assoc()){
            $items[] = new item($row['item_id'],$this->database);
            $content = $content . $items[$i]->showItem();
            $i++;
        }
        return([$content,$items]);
    }
}
?>