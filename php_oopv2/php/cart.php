<?php
require_once 'content_list.php';
class cart extends content_list{
    private $item_ids;
    private $amounts;
    private $list;
    private $list_id;

    public function __construct($database, $session){
        //================================================
        // Constructs the cart by getting all the items 
        // from the ids in the session.
        //================================================
        [$this->item_ids,$this->amounts] = $session->getItemsInCart();
        $this->list_id = 'cart';
        require_once "item_factory.php";
        $factory = new item_factory($database);
        $this->list = [];
        for($i=0; $i<count($this->item_ids); $i++){
            $this->list[] = $factory->getItem($this->item_ids[$i],amount: $amounts);
        }
        parent::__construct($this->list, $this->list_id);
    }
}
?>