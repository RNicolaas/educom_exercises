<?php
class page{
    private $title;
    private $content;
    private $response;

    public function __construct($title,$content,$response){
        //================================================
        // Initialisation of page object. The title and 
        // content get saved in properties.
        //================================================
        $this->title = $title;
        $this->content = $content;
        $this->response = $response;
    }

    private function beginDoc(){ 
        echo "<!DOCTYPE html>\n<html>"; 
    }
 
    private function beginHeader(){
        echo "<head>"; 
    }
         
    private function headerContent(){ 
        echo "<title>Nicolaas</title>"; 
        echo "<link rel='stylesheet' href='/php_oop/stylesheets/style.css'>";
    }

    private function endHeader(){ 
        echo "</head>"; 
    }
         
    private function beginBody(){ 
        echo "<body>"; 
    }

    private function startPage($title){
        //=======================================================================
        // Shows the start of the page. This includes the overarching header
        // and the links to the other pages.
        //=======================================================================
        echo 
        "<h1>Nicolaas</h1>
        <ul>
            <li><a href='index.php?page=home' id='menu'> Home </a></li>
            <li><a href='index.php?page=about' id='menu'> About </a></li>
            <li><a href='index.php?page=contact' id='menu'> Contact </a></li>";
        if ($this->response['loggedin']){
            echo "<li><a href='index.php?page=logout' id='menu'> Logout [";
            echo $_SESSION["name"];
            echo "]</a></li>";
        }else{echo 
            "<li><a href='index.php?page=registration' id='menu'> Register </a></li>
            <li><a href='index.php?page=login' id='menu'> Login </a></li>";
        }
        echo "<li><a href='index.php?page=shop' id='menu'> Shop </a></li>";
        if ($this->response['loggedin']){
            echo "<li><a href='index.php?page=cart' id='menu'> Cart </a></li>";
        }
        echo "</ul>";
        echo "<h2>" . $title . "</h2>";
        if(isset($this->response["error"])){
            echo "<p style='color:red'>" . $this->response['error'] . "</p>";
        }
    }
         
    private function bodyContent($content){ 
        echo $content; 
    }
         
    private function endBody(){ 
        if (isset($this->response["message"])){
            echo "<p style='color:green'>".$this->response['message']."</p>";
        }
        echo "<footer>&copy; 2025 Rodney Nicolaas</footer>";
        echo "</body>"; 
    }
         
    private function endDoc(){ 
        echo "</html>"; 
    }

    protected function getContent(){
        return($this->content);
    }

    protected function setContent($newContent){
        $this->content = $newContent;
    }

    protected function showParagraph($_text){
        //=======================================================================
        // Shows the text in a paragraph.
        //=======================================================================
        return("<p>" . $_text . "</p>"); // no html specialchars, because it would make the link not work
    }

    public function showPage(){
        $this->beginDoc();
        $this->beginHeader();
        $this->headerContent();
        $this->endHeader();
        $this->beginBody();
        $this->startPage($this->title);
        $this->bodyContent($this->content);
        $this->endBody();
        $this->endDoc();
    }
}