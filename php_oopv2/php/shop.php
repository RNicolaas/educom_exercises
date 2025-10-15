<?php
require_once 'content_list.php';
class shop extends content_list{
    private $item_ids;
    private $list;
    private $list_id;

    public function __construct($database){
        //================================================
        // Constructs the shop by getting all the items 
        // from the ids in the database.
        //================================================
        $this->item_ids = $database->getItemIds();
        $this->list_id = 'shop';
        require_once "item_factory.php";
        $factory = new item_factory($database);
        $this->list = [];
        for($i=0; $i<count($this->item_ids); $i++){
            $this->list[] = $factory->getItem($this->item_ids[$i]);
        }
        parent::__construct($this->list, 'shop');
    }
}
?>