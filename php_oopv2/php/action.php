<?php
class model {
    private $database;
    private $session;

    public function __construct($database, $session){
        //=======================================================================
        // Constructs model by saving the database and session.
        //=======================================================================
        $this->session = $session;
        $this->database = $database;
    }

    public function doAction($action){
        if($action == 'addItem'){
            $this->addItem();
        }
    }

    private function addItem(){
        
    }
}
?>