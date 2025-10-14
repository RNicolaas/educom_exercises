<?php
require_once "header.php";
require_once "page_content.php"
class page {
    private $footer;
    private $header;
    private $page_id;
    private $page_content;

    public function __construct($database,$page_id){
        //=======================================================================
        // Constructs the header by getting the title and stylesheet from the 
        // database.
        //=======================================================================
        $this->database = $database;
        [$title,$stylesheet,$footer] = $database->getBasicPage();

        $this->footer = $row['text'];
        $this->header = new header($title,$stylesheet);
        $this->page_content = new page_content($page_id);
    }

    public function showPage(){
        //=======================================================================
        // shows the page.
        //=======================================================================
        $this->beginDoc();
        $this->$header->getHeader();
        $this->endDoc();
    }

    private function beginDoc(){ 
        echo "<!DOCTYPE html>\n<html>"; 
    }

    private function endDoc(){ 
        echo "</html>"; 
    }

    private function showContent(){
        //
        //
        //
        //
        //
        while(){
            $this->page_content->show_content();
        }
    }
}
?>