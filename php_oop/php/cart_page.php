<?php
require_once "page.php";
require_once "item.php";
class cart_page extends page{
    private $item_list;
    private $amount_list;

    public function __construct($response, database $database){
        //================================================
        // Constructs the cart_page by making an item 
        // object for the inputted item id and initialising 
        // the content of the page to show the item.
        //================================================
        $title = "Shopping cart";
        [$content,$item_list,$amounts] = $this->returnItemsInCart($response,$database);
        $this->item_list = $item_list;
        $this->amount_list = $amounts;
        parent::__construct($title,$content,$response);
    }

    private function getItemsInCart(){
        //=======================================================================
        // returns the items in cart and the amount of each.
        //=======================================================================
        startSession();
        if(isset($_SESSION['cart'])){
            $unique_items = array_values(array_unique($_SESSION['cart']));
            $amounts = array_count_values($_SESSION['cart']);
        }else{
            return ([[],[]]);
        }
        return([$unique_items,$amounts]);
    }

    private function showOrderButton($content){
        //=======================================================================
        // Show the button to order, if the user has items in the shopping cart.
        //=======================================================================
        $content = $content . '<form action="index.php" method="post">';
        $content = $content . '<input type="hidden" id="page" name="page" value="cart">';
        $content = $content . '<input type="hidden" id="order" name="order" value=1>';
        $content = $content . '<button type="submit">Order</button></form>';
        return($content);
    }

    private function returnItemsInCart($response,$database){
        //=======================================================================
        // Show all the items in the cart and their price. Then show the total 
        // cost.
        //=======================================================================
        $content = ""; 
        $item_list = [];
        [$itemID_list, $amounts] = $this->getItemsInCart();
        if($itemID_list == []){
            $content = $content . returnParagraph('You have no items in your shopping cart yet!');
        }else{
            for($i = 0; $i < count($itemID_list); $i++){
                $item_list[] = new item($itemID_list[$i],$database);
                $content = $content . $item_list[$i]->showItem();
                $content = $content . "<p> Amount: " . $amounts[$itemID_list[$i]] . "\n<br>";
            }
            $content = $content . "<p id='price'>Total price: €" . $response["total_price"] . "<p><br>";
            $content = $this->showOrderButton($content);
        }
        return([$content,$item_list,$amounts]);
    }
}
?>