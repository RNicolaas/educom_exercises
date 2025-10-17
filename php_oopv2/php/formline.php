<?php
class formline {
    private $formline_id;
    private $inputbox_id_list;
    private $inputbox_list;

    public function __construct($formline_id, $database){
        $this->formline_id = $formline_id;
        $this->inputbox_id_list = $database->getInputBoxes($formline_id);
        $this->getInputBoxes();
    }

    private function getInputBoxes(){
        require_once "inputbox_factory.php";
        $factory = new inputbox_factory($this->inputbox_id_list);
        $this->inputbox_list = $factory->getInputBoxes();
    }

    public function showContent(){
        for($i=0; $i<count($this->inputbox_list); $i++){
            $this->inputbox_list[$i]->showContent();
        }
    }

    public function getId(){
        return($this->formline_id);
    }

    public function getIBs(){
        return($this->inputbox_list);
    }

    public function setValues($args){
        for($i=0; $i<count($this->inputbox_list); $i++){
            if(isset($args[$this->inputbox_list[$i]->getId()])){
                $this->inputbox_list[$i]->setValue($args[$this->inputbox_list[$i]->getId()]);
            }
        }
    }
}
?>