<?php
class page_selector {
    public static function getPageID(){
        //=======================================================================
        // Echos the link button with the linked page and text.
        //=======================================================================
        if(isset($_GET['page']) and $_GET['page'] != 0){
            require_once "page.php";
            return($_GET['page']);
        }else{
            return(1);
        }
    }
}
?>