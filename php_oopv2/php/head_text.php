<?php
require_once "content.php";
class head_text extends content {
    private $text;

    public function __construct($text){
        $this->text = $text;
    }

    public function showContent(){
        echo '<h2>'.htmlspecialchars($this->text).'</h2>';
    }
}
?>