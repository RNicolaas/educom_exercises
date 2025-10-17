<?php
class response {
    private $request;
    private $args;
    private $user;
    private $database;
    private $session;
    private $page;

    public function __construct($request, $database, $session){
        $this->request = $request;
        $this->database = $database;
        $this->session = $session;
        $this->args = $this->request->getArgs();
        $this->page = $this->request->getPage();
        $this->user = $this->request->getUser();
        $this->getResponse();
    }

    private function getResponse(){
        //=======================================================================
        // returns the page id and extra arguments when necessary.
        //=======================================================================
        require_once "actions.php";
        if($this->request->hasAction()){
            $actions = new actions($this->database, $this->session, $this->user);
            $this->args = $actions->doAction($this->request->getAction(),$this->args);
        }
        if(isset($this->args['page'])){
            $this->page = $this->args['page'];
        }
    }

    public function getPage(){
        return($this->page);
    }

    public function getUser(){
        return($this->user);
    }

    public function getArgs(){
        return($this->args);
    }
}
?>