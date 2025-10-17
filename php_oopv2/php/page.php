<?php
class page {
    private $footer;
    private $header;
    private $page_id;
    private $page_content;
    private $menu;
    private $args;

    public function __construct($database,$page_id,$args=[]){
        //=======================================================================
        // Constructs the header by getting the title and stylesheet from the 
        // database.
        //=======================================================================
        [$title,$stylesheet,$footer] = $database->getBasicPage();
        require_once "header.php";
        require_once "page_content.php";
        require_once "menu.php";
        require_once "title.php";

        $this->footer = $footer;
        $this->args = $args;
        $this->header = new header($title,$stylesheet);
        $this->title = new title($title);
        $this->page_content = new page_content($database,$page_id,$args);
        $this->menu = new menu($database,$args);
        $this->page_content->getContent();
    }

    public function showPage(){
        //=======================================================================
        // shows the page.
        //=======================================================================
        $this->beginDoc();
        $this->header->getHeader();
        $this->title->showContent();
        $this->menu->showMenu();
        $this->page_content->showContent();
        $this->showFooter();
        $this->endDoc();
    }

    private function beginDoc(){ 
        echo "<!DOCTYPE html>\n<html>"; 
    }

    private function showFooter(){
        echo "<footer>" . $this->footer . "</footer>";
    }

    private function endDoc(){ 
        echo "</html>"; 
    }
}
?>