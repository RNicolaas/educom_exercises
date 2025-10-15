<?php
require_once "content.php";
class content_list extends content {
    private $list;
    private $list_id;

    public function __construct($list,$list_id=''){
        $this->list = $list;
        $this->list_id = $list_id;
    }

    public function showContent(){
        echo "<ul id='" . $this->list_id . "'>";
        for($i=0; $i<count($this->list); $i++){
                echo "<li>";
                echo $this->list[$i]->showContent(); 
                echo "</li>";
        }
        echo "</ul>";
    }
}
?>