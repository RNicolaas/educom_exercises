<?php
require_once "page.php";
class login_page extends page{
    public function __construct($response){
        //================================================
        // Constructs the cart_page by making an item 
        // object for the inputted item id and initialising 
        // the content of the page to show the item.
        //================================================
        $title = "login";
        parent::__construct($title,"",$response);
        $content = $this->showLoginForm();
        $this->setContent($content);
    }

    private function showLoginForm(){
        //=======================================================================
        // Shows the form of the login page. 
        //=======================================================================
        return(
            '<form action="index.php?page=login" method="post">
            <input type="hidden" id="page" name="page" value="login">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br>
            <label for="password">Password:</label>
            <input type="text" id="password" name="password"><br>
            <button type="submit">Send</button>
            </form>'
        );
    }
}
?>