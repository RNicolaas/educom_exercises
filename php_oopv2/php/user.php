<?php
class user {
    private $id;
    private $name;
    private $database;
    private $login;

    public function __construct($database,$session){
        //=======================================================================
        // construct by saving the database.
        //=======================================================================
        $this->database = $database;
        $this->session = $session;
        if($this->session->isLoggedIn()){
            [$this->id,$this->name] = $this->session->getUser();
            $this->login = true;
        }else{
            $this->login = false;
            $this->id = 0;
        }
    }

    public function login($email,$password){
        //=======================================================================
        // login the user given the email and password.
        //=======================================================================
        [$id,$name] = $this->database->getLogin($email,$password);
        if($id != false){
            $this->name = $name;
            $this->id = $id;
            $this->session->setUser($id,$name);
            return(true);
        }
        return(false);
    }

    public function logout(){
        unset($this->name);
        unset($this->id);
        $this->login = false;
        $this->session->unsetUser();
    }

    public function getLoginStatus(){
        return($this->login);
    }

    public function getName(){
        return($this->name);
    }

    public function getId(){
        return($this->id);
    }
}
?>