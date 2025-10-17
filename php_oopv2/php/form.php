<?php
class form {
    private $form_id;
    private $formline_id_list;
    private $formline_list;
    private $database;
    private $args;
    private $reason;

    public function __construct($form_id, $database, $args=[]){
        $this->form_id = $form_id;
        $this->args = $args;
        $this->database = $database;
        $this->formline_id_list = $database->getFormLines($form_id);
        $this->getFormLines();
        $this->setValues();
    }

    private function getFormLines(){
        require_once "formline.php";
        $this->formline_list = [];
        for($i=0; $i<count($this->formline_id_list); $i++){
            $this->formline_list[] = new formline($this->formline_id_list[$i],$this->database);
        }
    }

    public function showContent(){
        echo '<form action="index.php" method="post">';
        echo '<input type="hidden" id="page" name="form" value=' . $this->form_id . '>';
        for($i=0; $i<count($this->formline_list); $i++){
            $this->formline_list[$i]->showContent();
        }
        echo '</form>';
    }

    public function validate(){
        require_once "formline_validator.php";
        $validator = new formline_validator($this->database,$this->args);
        for($i=0; $i<count($this->formline_list); $i++){
            if(!$validator->validateFormline($this->formline_list[$i])){
                $this->reason = $validator->getReason();
                return(false);
            }
        }
        return(true);
    }

    public function setValues(){
        for($i=0; $i<count($this->formline_list); $i++){
            $this->formline_list[$i]->setValues($this->args);
        }
    }

    public function getReason(){
        return($this->reason);
    }
}
?>