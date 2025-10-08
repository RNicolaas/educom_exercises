<?php
function startSession(){
    //=======================================================================
    // Start session if there is none.
    //=======================================================================
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
}

function returnParagraph($_text){
    //=======================================================================
    // return the text in a paragraph.
    //=======================================================================
    return "<p>" . $_text . "</p>"; // no html specialchars, because it would make links not work
}

function clearSessionParameters(){
    //=======================================================================
    // Clears all the session parameters.
    //=======================================================================
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $_SESSION = [];
    session_destroy();
}

function logout($response){
    //=======================================================================
    // Logout the user by setting the user by removing the session parameters.
    //=======================================================================
    clearSessionParameters();
    $response["loggedin"] = false;
    return($response);
}

function getCart($response){
    //=======================================================================
    // Puts the items and amounts in the response. Also calculates the total 
    // price and puts this in the response.
    //=======================================================================
    [$items, $amounts] = getItemsInCart();
    if ($items == false){
        $response['cart_empty'] = true;
        return($response);
    }
    $response['cart_empty'] = false;
    $response['cart_item_ids'] = $items;
    $response['cart_item_amounts'] = $amounts;
    $item_info = getMultiItemInfo($items);
    $total_price = 0;
    while($row = $item_info -> fetch_assoc()){
        $total_price += $row['price'] * $amounts[$row['item_id']];
    }
    $response["total_price"] = $total_price;
    return($response);
}

function getItemsInCart(){
    //=======================================================================
    // returns the items in cart and the amount of each.
    //=======================================================================
    startSession();
    if(isset($_SESSION['cart'])){
        $unique_items = array_values(array_unique($_SESSION['cart']));
        $amounts = array_count_values($_SESSION['cart']);
    }else{
        return ([false,false]);
    }
    return([$unique_items,$amounts]);
}

function sendOrder($response){
    //=======================================================================
    // Adds the order action to response.
    //=======================================================================
    $response['action'] = 'order';
    sendOrderToDatabase($response);
    $response['message'] = 'Thank you for your purchase, your order has been received.';
    $response['page'] = 'home';
    return($response);
}
?>