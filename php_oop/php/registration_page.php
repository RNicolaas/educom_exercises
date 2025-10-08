<?php
require_once "page.php";
class registration_page extends page{
    public function __construct($response){
        //================================================
        // Constructs the cart_page by making an item 
        // object for the inputted item id and initialising 
        // the content of the page to show the item.
        //================================================
        $title = "Registration";
        parent::__construct($title,"",$response);
        $content = $this->showRegistrationForm();
        $this->setContent($content);
    }

    private function showRegistrationForm(){
        //=======================================================================
        // Shows the form of the registration page. Also makes sure that the name 
        // and email are filled in again if these values are in the session 
        // variables. Also saves the values to post when submitted.
        //=======================================================================
        $content = "";
        $content = $content . 
            '<form action="index.php?page=registration" method="post">
            <input type="hidden" id="page" name="page" value="registration">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value='
        ;
        if (!empty($_POST["name"])){
            $content = $content .  htmlspecialchars($_POST["name"]);
        }
        $content = $content . 
            '><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"  value='
        ;
        if (!empty($_POST["email"])){
            $content = $content .  htmlspecialchars($_POST["email"]);
        }
        $content = $content .     
            '><br>
            <label for="password">Password:</label>
            <input type="text" id="password" name="password"><br>
            <label for="password2">Repeat password:</label>
            <input type="text" id="password2" name="password2"><br>
            <button type="submit">Send</button>
            </form>'
        ;
        return($content);
    }
}
?>