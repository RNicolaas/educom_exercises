<?php
class button_factory {
    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    public function getButton($button_id,$args=[]){
        require_once "link_button.php";
        [$name,$button_text,$page_id] = $this->database->getButton($button_id);
        if ($name == 'logout button'){
            $button = new link_button($button_text,$page_id,[['logout','true']]);
        }else{$button = new link_button($button_text,$page_id);}
        return($button);
    }
}
?>