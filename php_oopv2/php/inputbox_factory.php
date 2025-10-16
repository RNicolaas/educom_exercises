<?php
class inputbox_factory {
    private $inputbox_ids;

    public function __construct($inputbox_ids){
        $this->inputbox_ids = $inputbox_ids;
    }

    public function getInputBoxes(){
        $inputboxes = [];
        require_once "inputbox.php";
        for($i=0; $i<count($this->inputbox_ids); $i++){
            switch ($this->inputbox_ids[$i]){
                case 6:
                    $inputboxes[] = new inputbox('text','name','Name:');
                    break;
                case 2:
                    $inputboxes[] = new inputbox('email','email','E-mail:');
                    break;
                case 3:
                    $inputboxes[] = new inputbox('password','password','Password:');
                    break;
                case 4:
                    $inputboxes[] = new inputbox('password','repeat_password','Repeat password:');
                    break;
                case 7:
                    $inputboxes[] = new inputbox('text','message','Message:');
                    break;
                case 8:
                    require_once "form_button.php";
                    $inputboxes[] = new form_button('submit','message','Submit');
                    break;
            }
        }
        return($inputboxes);
    }
}
?>