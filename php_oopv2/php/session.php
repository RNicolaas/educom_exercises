<?php
class session_handler {
    private $session;

    public function __construct(){
        //================================================
        // Constructs session by starting a session.
        //================================================
        $this->startSession();
    }

    private function startSession(){
        //=======================================================================
        // Start session if there is none.
        //=======================================================================
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public function getItemsInCart(){
        //=======================================================================
        // returns the items in cart and the amount of each.
        //=======================================================================
        if(isset($_SESSION['cart'])){
            $unique_items = array_values(array_unique($_SESSION['cart']));
            $amounts = array_count_values($_SESSION['cart']);
        }else{
            return ([[],[]]);
        }
        return([$unique_items,$amounts]);
    }

    public function addItemToCart($item_id){
        //=======================================================================
        // Adds an item to the shopping cart.
        //=======================================================================
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $item_id;
    }

    public function emptyCart(){
        if(isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
        }
    }

    public function setUser($id,$name){
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $name;
    }

    public function getUser(){
        if(isset($_SESSION['user_id'])){
            return([$_SESSION['user_id'],$_SESSION['username']]);
        }else{
            return(['','']);
        }
    }

    public function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return(true);
        }else{
            return(false);
        }
    }

    public function unsetUser(){
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
    }
}
?>