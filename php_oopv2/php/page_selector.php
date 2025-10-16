<?php
class page_selector {
    public static function getPageID(){
        //=======================================================================
        // Echos the link button with the linked page and text.
        //=======================================================================
        $args = [];
        $page = 0;
        if(isset($_GET['page']) and $_GET['page'] != 0){
            require_once "page.php";
            if($_GET['page'] == 8){
                $args['item_id'] = $_GET['item_id'];
            }
            $page = $_GET['page'];
        }
        return([$page,$args]);
    }
}
?>