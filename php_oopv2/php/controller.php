<?php
class controller {
    private $database;
    private $session;
    private $page;
    private $request;
    private $user;
    private $response;

    public function __construct($database,$session){
        //=======================================================================
        // Constructs the header by setting the button text and page id to link to.
        //=======================================================================
        $this->database = $database;
        $this->session = $session;
        require_once "request.php";
        $this->request = new request($this->database,$this->session);
        require_once "response.php";
        $this->response = new response($this->request,$this->database,$this->session);
    }

    public function getPage(){
        //=======================================================================
        // Gets the id of the page from the page selector and makes the page 
        // object.
        //=======================================================================
        require_once "response.php";
        require_once "page.php";
        $this->page = new page($this->database, $this->response->getPage(), $this->response->getArgs());
    }

    public function showPage(){
        $this->page->showPage();
    }
}
?>