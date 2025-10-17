<?php
class actions {
    private $database;
    private $session;
    private $user;

    public function __construct($database, $session, $user){
        //=======================================================================
        // Constructs model by saving the database and session.
        //=======================================================================
        $this->session = $session;
        $this->database = $database;
        $this->user = $user;
    }

    public function doAction($action,$args=[]){
        switch($action){
            case 'additem':
                $args = $this->addItem($args['item_id'],$args);
                break;
            case 'login':
                $args = $this->login($args['email'],$args['password'],$args);
                break;
            case 'logout':
                $args = $this->logout($args);
                break;
            case 'register':
                $args = $this->register($args['name'],$args['email'],$args['password'],$args);
                break;
            case 'contact':
                $args = $this->contactAction($args['name'],$args['email'],$args['message'],$this->user->getId(),$args);
                break;
            case 'order':
                $args = $this->placeOrder($args);
                break;
        }
        return($args);
    }

    private function addItem($item_id,$args){
        $this->session->addItemToCart($item_id);
        $args['text'] = 'Item added to your shopping cart!';
        return($args);
    }

    private function login($email,$password,$args){
        if($this->user->login($email,$password)){
            $args['page'] = 1;
            $args['login'] = true;
            $args['username'] = $this->user->getName();
        }else{
            $args['page'] = 5;
            $args['form_error'] = 'E-mail or password incorrect.';
            $args['login'] = false;
        }
        return($args);
    }

    private function logout($args){
        $this->user->logout();
        $args['login'] = false;
        return($args);
    }

    private function register($name,$email,$password,$args){
        $this->database->registerInDatabase($name,$email,$password);
        $args['page'] = 5;
        return($args);
    }

    private function contactAction($name,$email,$message,$user_id,$args){
        $this->database->putContactRequestInDatabase($user_id,$name,$email,$message);
        $args['text'] = $this->database->getParagraph(7);
        $args['page'] = 1;
        return($args);
    }

    private function placeOrder($args){
        if($args['login']){
            [$item_ids,$amounts] = $this->session->getItemsInCart();
            $order_id = $this->database->getMaxValue('orders','order_id') + 1;
            for($i=0; $i<count($item_ids); $i++){
                $this->database->putOrderItemInDatabase($order_id,$this->user->getId(),$item_ids[$i],$amounts[$item_ids[$i]]);
            }
            $args['text'] = $this->database->getParagraph(8);
            $args['page'] = 1;
            $this->session->emptyCart();
            return($args);
        }else{
            $args['page'] = 5;
            $args['form_error'] = $this->database->getParagraph(9);
        }
        return($args);
    }
}
?>