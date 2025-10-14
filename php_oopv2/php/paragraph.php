<?php
require_once "content.php";
class paragraph extends content {
    private $text;

    public function __construct($text){
        $this->text = $text;
    }

    public function showContent(){
        echo '<p>'.htmlspecialchars($this->text).'</p>';
    }
}
?>