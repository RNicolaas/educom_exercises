<?php
class request {
    private $request_type;
    private $page;
    private $action;
    private $args;

    public function __construct(){
        //=======================================================================
        // Constructs the header by setting the button text and page id to link to.
        //=======================================================================
        $this->args = [];
        getRequest();
    }

    private function getRequest(){
        //=======================================================================
        // determines the request.
        //=======================================================================
        if(isset($_POST['page'])){
            $this->request_type = 'post';
            $this->page = $_POST['page'];
        }else{
            $this->request_type = 'get';
            $this->page = $_GET['page'];
            if(isset($_GET['additem'])){
                $this->action = 'additem';
                $this->args["item_id"] = $_GET['page'];
            }
        }
    }

    public function getType(){
        return($this->request_type);
    }

    public function getPage(){
        return($this->page);
    }

    public function getArgs(){
        return($this->args);
    }

    public function getAction(){
        return($this->action);
    }

    public function isAction(){
        if(isset($this->action)){
            return(true);
        }else{
            return(false);
        }
    }
}
?>