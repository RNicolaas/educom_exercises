<?php
class form {
    private $form_id;
    private $formline_id_list;
    private $formline_list;
    private $database;

    public function __construct($form_id, $database){
        $this->form_id = $form_id;
        $this->database = $database;
        $this->formline_id_list = $database->getFormLines($form_id);
        $this->getFormLines();
    }

    private function getFormLines(){
        require_once "formline.php";
        $this->formline_list = [];
        for($i=0; $i<count($this->formline_id_list); $i++){
            $this->formline_list[] = new formline($this->formline_id_list[$i],$this->database);
        }
    }

    public function showContent(){
        echo '<form action="index.php?form=' . $this->form_id . '" method="post">';
        for($i=0; $i<count($this->formline_list); $i++){
            $this->formline_list[$i]->showContent();
        }
        echo '</form>';
    }
}
?>