<?php
class request {
    private $request_type;
    private $page;
    private $action;
    private $user;
    private $args;
    private $database;

    public function __construct($database,$session){
        //=======================================================================
        // Constructs the header by setting the button text and page id to link to.
        //=======================================================================
        $this->database = $database;
        $this->args = [];
        require_once 'user.php';
        $this->user = new user($database,$session);
        $this->getRequest();
    }

    private function getRequest(){
        //=======================================================================
        // Determines the request.
        //=======================================================================
        if(count($_POST)>0){
            $this->args = $_POST;
            $this->request_type = 'post';
            $this->page = 1;
            $this->getPostAction();
        }else{
            $this->args = $_GET;
            $this->request_type = 'get';
            if(isset($_GET['page'])){
                $this->page = $_GET['page'];
                switch($this->page){
                    case 8:
                        break;
                    case 10:
                        $this->action = 'logout';
                        $this->page = 1;
                        break;
                }
            }else{
                $this->page = 1;
            }
            if(isset($_GET['additem'])){
                $this->action = 'additem';
                $this->args["item_id"] = $_GET['item_id'];
            }
        }
        $this->args['page'] = $this->page;
        $this->args['login'] = $this->user->getLoginStatus();
        $this->args['user_id'] = $this->user->getId();
        $this->args['username'] = $this->user->getName();
    }

    private function getPostAction(){
        if(isset($this->args['form'])){
            require_once "form.php";
            $form = new form($this->args['form'],$this->database,$this->args);
            if($form->validate()){
                switch($this->args['form']){
                    case 1:
                        $this->action = 'contact';
                        break;
                    case 2:
                        $this->action = 'login';
                        break;
                    case 3:
                        $this->action = 'register';
                        break;
                    case 4:
                        $this->action = 'order';
                        break;
                }
            }else{
                $this->args['form_error'] = $form->getReason();
                switch($this->args['form']){
                    case 1:
                        $this->args['page'] = 4;
                        break;
                    case 2:
                        $this->args['page'] = 5;
                        break;
                    case 3:
                        $this->args['page'] = 6;
                        break;
                }
            }
        }
    }

    public function getType(){
        return($this->request_type);
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

    public function getAction(){
        return($this->action);
    }

    public function hasAction(){
        if(isset($this->action)){
            return(true);
        }else{
            return(false);
        }
    }
}
?>