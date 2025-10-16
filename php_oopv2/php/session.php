<?php
class session {
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
        //
        //
        //
        //
        //
        //
        //
        //
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $item_id;
    }
}
?>