<?php
require_once "page.php";
class home_page extends page{
    public function __construct($response){
        //================================================
        // Constructs the cart_page by making an item 
        // object for the inputted item id and initialising 
        // the content of the page to show the item.
        //================================================
        $title = "Home";
        parent::__construct($title,"",$response);
        $content = $this->showParagraph("Welcome to the page of Rodney Nicolaas. Here you'll be able to find all information necessary.");
        $this->setContent($content);
    }
}
?>