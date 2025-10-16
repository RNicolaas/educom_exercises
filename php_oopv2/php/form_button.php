<?php
require_once "inputbox.php";
class form_button extends inputbox {
    public function __construct($input_type,$id,$text){
        parent::__construct($input_type,$id,$text);
    }

    public function showContent(){
        echo '<button type="submit">' . $this->text . '</button>';
    }
}
?>