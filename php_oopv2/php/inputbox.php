<?php
require_once "content.php";
class inputbox extends content {
    private $input_type;
    private $id;
    private $value;

    public function __construct($input_type,$id,$text){
        $this->input_type = $input_type;
        $this->id = $id;
        $this->text = $text;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function showContent(){
        echo '<label for="message" style="vertical-align: top;">' . $this->text . '</label><br>';
        echo '<input type="' . $this->input_type . '" id="' . $this->id . '" name="' . $this->id . '" value="' . $this->value . '"><br>';
    }
}
?>