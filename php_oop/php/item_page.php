<?php
require_once "page.php";
require_once "item.php";
require_once "database.php";
class item_page extends page{
    private $item;

    public function __construct($item_id,$response,database $database){
        //================================================
        // Constructs the item_page by making an item 
        // object for the inputted item id and initialising 
        // the content of the page to show the item.
        //================================================
        $this->item = new item($item_id, $database);
        parent::__construct($this->item->getName(),'',$response);
        $content = $this->getItemContent($response);
        $this->setContent($content);
    }

    private function getItemContent($response){
        $content = '';
        $content = $this->showBackLink($content);
        $content = $content . $this->item->showItem(true);
        if($response['loggedin']){
            $content = $this->showAddtocart($content,$response);
        }
        return($content);
    }

    public function getID(){
        //================================================
        // Returns the item id of the item this page is 
        // for.
        //================================================
        return($this->item->getID());
    }

    private function showBackLink($content){
        //=======================================================================
        // Show a link to get back to the main shop.
        //=======================================================================
        $content = $content . "<a href='index.php?page=shop'> Back </a><br>";
        return($content);
    }

    function showAddtocart($content,$response){
        //=======================================================================
        // Show the button to add the current item to the cart, if the user is 
        // logged in.
        //=======================================================================
        $content = $content . '<form action="index.php" method="post">';
        $content = $content . '<input type="hidden" id="page" name="page" value="item">';
        $content = $content . '<input type="hidden" id="item_id" name="item_id" value=' . $response['item_id'] . '>';
        $content = $content . '<button type="submit">Add to cart</button></form>';
        return($content);
    }
}
?>