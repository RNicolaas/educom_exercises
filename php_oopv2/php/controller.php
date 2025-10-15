<?php
class controller {
    private $database;
    private $page;

    public function __construct($database){
        //=======================================================================
        // Constructs the header by setting the button text and page id to link to.
        //=======================================================================
        $this->database = $database;
    }

    public function getPage(){
        //=======================================================================
        // Gets the id of the page from the page selector and makes the page 
        // object.
        //=======================================================================
        require_once "page_selector.php";
        require_once "page.php";
        $page_id = page_selector::getPageID();
        $this->page = new page($this->database, $page_id);
    }

    public function showPage(){
        $this->page->showPage();
    }
}
?>