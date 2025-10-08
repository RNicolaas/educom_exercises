<?php
require_once "page.php";
class contact_page extends page{
    public function __construct($response){
        //================================================
        // Constructs the cart_page by making an item 
        // object for the inputted item id and initialising 
        // the content of the page to show the item.
        //================================================
        $title = "Contact";
        parent::__construct($title,"",$response);
        $content = $this->showContactForm();
        $this->setContent($content);
    }

    private function showContactForm(){
        //=======================================================================
        // Shows the form of the contact page. Also makes sure that the values
        // that were already filled in, are filled in again if these variables 
        // are in the session variables. Also saves the values to post when 
        // submitted. 
        //=======================================================================
        $content = '';
        $content = $content . 
            '<form action="index.php?page=contact" method="post">
            <input type="hidden" id="page" name="page" value="contact">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value='
        ;
        if (!empty($_POST["name"])){
            $content = $content . htmlspecialchars($_POST["name"]);
        }
        $content = $content .
            '><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"  value='
        ;
        if (!empty($_POST["email"])){
            $content = $content . htmlspecialchars($_POST["email"]);
        }
        $content = $content .    
            '><br>
            <label for="message" style="vertical-align: top;">Message:</label>
            <textarea name="message" id="message" rows="3" cols="52">'
        ;
        if (!empty($_POST["message"])){
            $content = $content . htmlspecialchars($_POST["message"]);
        }
        $content = $content .
            '</textarea><br>
            <button type="submit">Send</button>
            </form>'
        ;
        return($content);
    }
}
?>