<?php
class formline_validator{
    private $args;
    private $database;
    private $reason;

    public function __construct($database, $args = []){
        $this->args = $args;
        $this->database = $database;
    }

    public function validateFormline($formline){
        $validation_ids = $this->database->getValidationIds($formline->getId());
        $inputbox_list = $formline->getIBs();
        for($i=0; $i<count($validation_ids); $i++){
            if(!$this->doValidation($inputbox_list,$validation_ids[$i])){
                return(false);
            };
        }
        return(true);
    }

    private function doValidation($inputbox_list,$validation_id){
        switch ($validation_id){
            case 1:
                for($i=0; $i<count($inputbox_list); $i++){
                    if(!$this->notEmpty($inputbox_list[$i])){
                        $this->reason = 'Not all required fields have been filled in.';
                        return(false);
                    }
                }
                break;
            case 2:
                for($i=0; $i<count($inputbox_list); $i++){
                    if($inputbox_list[$i]->getId() == 'email' and !$this->isEmail($inputbox_list[$i])){
                        $this->reason = 'This is not a correct email adres.';
                        return(false);
                    }
                }
                break;
            case 3:
                $array = array_filter($inputbox_list, function($n) { return($n->getId() == 'password');});
                $ib_password = reset($array);
                if(!$this->correctPassword($this->args['email'],$ib_password->getValue())){
                    $this->reason = 'E-mail and/or password is incorrect';
                    return(false);
                }
                break;
            case 4:
                $array = array_filter($inputbox_list, function($n) { return($n->getId() == 'repeat_password');});
                $ib_repeat_password = reset($array);
                $array = array_filter($inputbox_list, function($n) { return($n->getId() == 'password');});
                $ib_password = reset($array);
                if(!$this->passwordsIdentical($ib_password,$ib_repeat_password)){
                    $this->reason = 'Passwords are not the same.';
                    return(false);
                }
                break;
        }
        return(true);
    }

    private function notEmpty($ib){
        if(isset($this->args[$ib->getId()]) and $this->args[$ib->getId()] != ''){
            return(true);
        }else{
            return(false);
        }
    }

    private function passwordsIdentical($ib_password,$ib_repeat_password){
        if($ib_password->getValue() == $ib_repeat_password->getValue()){
            return(true);
        }else{
            return(false);
        }
    }

    private function correctPassword($email,$password){
        [$id,$name] = $this->database->getLogin($email,$password);
        if($id != false){
            return(true);
        }else{
            return(false);
        }
    }

    private function isEmail($ib_email){
        return(true); // browser takes care of this
    }

    public function getReason(){
        return($this->reason);
    }
}
?>