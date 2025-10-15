<?php
require_once 'content.php';
class link_button extends content {
    private $button_text;
    private $link_id;

    public function __construct($button_text,$link_id,$extra_values=[]){
        //=======================================================================
        // Constructs the header by setting the button text and page id to link to.
        //=======================================================================
        $this->button_text = $button_text;
        $this->link_id = $link_id;
    }

    public function getButton(){
        //=======================================================================
        // returns the link button with the linked page and text.
        //=======================================================================
        return "<a href='index.php?page=" . $this->link_id . "' id='menu'>" . $this->button_text . " </a>";

    }

    public function showContent(){
        //=======================================================================
        // returns the link button with the linked page and text.
        //=======================================================================
        echo "<a href='index.php?page=" . $this->link_id . "' id='menu'>" . $this->button_text . " </a>";
    }

}
?>