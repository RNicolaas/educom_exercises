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
        $this->list_id = 'cart';
        [$this->item_ids,$this->amounts] = $session->getItemsInCart();
        if($this->item_ids == []){
            require_once "paragraph.php";
            $this->list = [];
            $this->list[] = new paragraph($database->getParagraph(6));
        }else{
            require_once "item_factory.php";
            $factory = new item_factory($database);
            $this->list = [];
            for($i=0; $i<count($this->item_ids); $i++){
                $this->list[] = $factory->getItem($this->item_ids[$i],amount: $this->amounts[$this->item_ids[$i]]);
            }
            require_once "form.php";
            $this->list[] = new form(4,$database);
        }
        parent::__construct($this->list, $this->list_id);
    }
}
?>