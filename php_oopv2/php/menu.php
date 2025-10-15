<?php
class menu {
    private $button_info;
    private $button_list;
    private $loggedin;
    private $content;
    private $database;

    public function __construct($database,$loggedin){
        //=======================================================================
        // Constructs the header by setting the button text and page id to link to.
        //=======================================================================
        $this->database = $database;
        $this->button_list = [];
        $this->button_info = $database->getMenuContent();
        $this->getButtons();
        $this->loggedin = $loggedin;
        $this->getMenu();
    }

    private function getButtons(){
        //=======================================================================
        // Get all the button objects.
        //=======================================================================
        require_once "button_factory.php";
        $factory = new button_factory($this->database);
        for($i=0; $i<count($this->button_info); $i++){
            if($this->button_info[$i][1] == 'all' or ($this->button_info[$i][1] == 'login' and $this->loggedin) or ($this->button_info[$i][1] == 'logout' and !$this->loggedin)){
                $this->button_list[] = $factory->getButton($this->button_info[$i][0]);
            }
        }
    }

    private function getMenu(){
        //=======================================================================
        // Echos the link button with the linked page and text.
        //=======================================================================
        $list = [];
        for($i=0; $i<count($this->button_list); $i++){
            $list[] = $this->button_list[$i];
        }
        require_once "content_list.php";
        $this->content = new content_list($list,'menu');
    }

    public function showMenu(){
        $this->content->showContent();
    }
}
?>