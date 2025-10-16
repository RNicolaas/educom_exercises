<?php
class controller {
    private $database;
    private $page;
    private $request;

    public function __construct($database){
        //=======================================================================
        // Constructs the header by setting the button text and page id to link to.
        //=======================================================================
        $this->database = $database;
        require_once "request.php";
        $this->request = new request();
    }

    public function getPage(){
        //=======================================================================
        // Gets the id of the page from the page selector and makes the page 
        // object.
        //=======================================================================
        require_once "page_selector.php";
        require_once "page.php";
        [$page_id,$args] = page_selector::getPageID();
        $this->page = new page($this->database, $page_id, $args);
    }

    public function showPage(){
        $this->page->showPage();
    }
}
?>