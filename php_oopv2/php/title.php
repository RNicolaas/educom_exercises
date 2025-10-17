<?php
require_once "content.php";
class title extends content {
    private $text;

    public function __construct($text,$color=''){
        $this->text = $text;
        $this->color = $color;
    }

    public function showContent(){
        if($this->color != ''){
            echo '<h1 style="color: ' . $this->color . ';">'.htmlspecialchars($this->text).'</h1>';
        }else{
            echo '<h1>'.htmlspecialchars($this->text).'</h1>';
        }
    }
}
?>