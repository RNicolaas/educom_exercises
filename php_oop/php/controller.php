<?php
require_once "database.php";
class controller{
    private $request;
    private $response;
    private $database;

    public function __construct(database $database){
        $this->database = $database;
        $this->request = $this->getRequest();
        $this->response = $this->getResponse($this->request);
        if (isset($this->response["action"])){
            $this->response = $this->doAction($this->response);
        }
    }

    public function show(){
        $this->showResponse($this->response);
    }

    private function getRequest(){
        //=======================================================================
        // Determines what type of request is sent, what page is asked for and 
        // whether the user is logged in. Returns this information in an array.
        //=======================================================================
        $request = [];
        if (isset($_POST['page'])){
            $request["type"] = "post";
            $request["page"] = $_POST["page"];
        }elseif (isset($_GET['page'])){
            $request["type"] = "get";
            $request["page"] = $_GET["page"];
        }else{
            $request["type"] = "get";
            $request["page"] = "home";
        }
        $this->startSession();
        if (isset($_SESSION["user"])){
            $request["loggedin"] = true;
        }else{
            $request["loggedin"] = false;
        }
        return($request);
    }

    private function getResponse($request){
        //=======================================================================
        // Determines what response has to be shown given the request. Returns 
        // array response with the variables necessary to show the correct page.
        //=======================================================================
        $response = [];
        $response["loggedin"] = $request["loggedin"];
        if($request["type"] == "post"){
            switch ($request["page"]) {
                case "contact":
                    $response = $this->submitContactForm($response);
                    break;
                case "registration":
                    $response = $this->submitRegistrationForm($response);
                    break;
                case "login":
                    $response = $this->submitLoginForm($response);
                    break;
                case "item":
                    $response = $this->addToCart($response);
                    break;
                case "cart":
                    $response = $this->getCart($response);
                    $response = sendOrder($response);
                    break;
            }
        }else{
            switch ($request["page"]){
                case "logout":
                    $response["action"] = "logout";
                    $response["page"] = "home";
                    break;
                case "item":
                    $response["item_id"] = $_GET["item_id"];
                    $response["page"] = $request["page"];
                    break;
                case "cart":
                    $response["page"] = $request["page"];
                    $response = getCart($response);
                default:
                    $response["page"] = $request["page"];
            }
        }
        return($response);
    }

    private function showResponse($response){
        //=======================================================================
        // Show the response.
        //=======================================================================
        switch ($response["page"]) {
            case "home":
                require_once "home_page.php";
                $page = new home_page($response);
                $page->showPage();
                break;
            case "about":
                require_once "about_page.php";
                $page = new about_page($response);
                $page->showPage();
                break;
            case "contact":
                require_once "contact_page.php";
                $page = new contact_page($response);
                $page->showPage();
                break;
            case "registration":
                require_once "registration_page.php";
                $page = new registration_page($response);
                $page->showPage();
                break;
            case "login":
                require_once "login_page.php";
                $page = new login_page($response);
                $page->showPage();
                break;
            case "shop":
                require_once "shop_page.php";
                $page = new shop_page($response,$this->database);
                $page->showPage();
                break;
            case "item":
                require_once "item_page.php";
                $page = new item_page($response["item_id"],$response,$this->database);
                $page->showPage();
                break;
            case "cart":
                require_once "cart_page.php";
                $page = new cart_page($response,$this->database);
                $page->showPage();
                break;
            default:
                require_once "home_page.php";
                $page = new home_page($response);
                $page->showPage();
                break;
        }
    }

    function startSession(){
        //=======================================================================
        // Start session if there is none.
        //=======================================================================
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    private function addToCart($response){
        //=======================================================================
        // Add the item id to the cart session variable. Set response variables 
        // such that the same item page will be loaded and a message pops up that 
        // says the item was added to the cart.
        //=======================================================================
        $item_id = $_POST['item_id'];
        startSession();
        if(isset($_SESSION['cart'])){
            $_SESSION['cart'][] = $item_id;
        }else{
            $_SESSION['cart'] = [$item_id];
        }
        $response['message'] = 'Item added to cart!';
        $response['page'] = 'item';
        $response['item_id'] = $item_id;  
        return($response);
    }

    private function submitRegistrationForm($response){
        //=======================================================================
        // Checks if all requiredments for registration are met and adds an error 
        // to response if they aren't. Adds the action register to response if 
        // submitted correctly.
        // NEEDS is isExistingUser() to function!
        //=======================================================================
        $response["page"] = "registration";
        if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])){
            $response["error"] = "Not all required fields have been filled in!";
        }elseif ($this->database->isExistingUser($_POST["email"])){
            $response["error"] = "Email is already in use!";
            $_POST["email"] = "";
        }elseif ($_POST["password"] != $_POST["password2"]) {
            $response["error"] = "Passwords didn't match!";
        }else{
            $response["action"] = "register";
            $response["name"] = $_POST["name"];
            $response["email"] = $_POST["email"];
            $response["password"] = $_POST["password"];
            $response["page"] = "home";
        }
        return($response);
    }

    private function submitContactForm($response){
        //=======================================================================
        // Checks if all requirements for the contact form are met and adds an 
        // error to response if they aren't. Adds the action contact to response 
        // if submitted correctly.
        //=======================================================================
        $response["page"] = "contact";
        if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["message"])){
            $response["error"] = "Not all required fields have been filled in!";
        }else{
            $response["action"] = "contact";
        } 
        return($response);
    }

    private function submitLoginForm($response){
        //=======================================================================
        // Checks if all requirements for the login form are met and adds an 
        // error to response if they aren't. Adds the action login to response 
        // if submitted correctly.
        // NEEDS is isCorrectLogin() to function!
        //=======================================================================
        $response["page"] = "login";
        if (empty($_POST["email"]) || empty($_POST["password"])){
            $response["error"] = "Not all required fields have been filled in!";
        }elseif (($user_id = $this->database->isCorrectLogin($_POST["email"],$_POST["password"])) !== false){
            $response["action"] = "login";
            $response["page"] = "home";
            $response["loggedin"] = true;
            $response["user_id"] = $user_id;
        }else {
            $response["error"] = "E-mail or password is incorrect!";
        }
        return($response);
    }

    private function contactAction($response){
        //=======================================================================
        // The action taken for the contact form. Now just a placeholder message 
        // is shown.
        //=======================================================================
        $response["message"] = "Thank you, we will reply to your message as soon as possible";
        $response["page"] = "home";
        return($response);
    }

    private function doAction($response){
        //=======================================================================
        // Executes the action stored in response.
        //=======================================================================
        switch ($response["action"]){
            case "login":
                $response = login($response['user_id'],$response);
                break;
            case "register":
                $user_id = $this->database->registerInDatabase($response["name"],$response["email"],$response["password"]);
                $response = login($user_id,$response);
                break;
            case "contact":
                $response = $this->contactAction($response);
                break;
            case "logout":
                $response = logout($response);
                break;
        }
        return($response);
    }

    private function getCart($response){
        //=======================================================================
        // Puts the items and amounts in the response. Also calculates the total 
        // price and puts this in the response.
        //=======================================================================
        [$items, $amounts] = getItemsInCart();
        if ($items == false){
            $response['cart_empty'] = true;
            return($response);
        }
        $response['cart_empty'] = false;
        $response['cart_item_ids'] = $items;
        $response['cart_item_amounts'] = $amounts;
        $item_info = getMultiItemInfo($items);
        $total_price = 0;
        while($row = $item_info -> fetch_assoc()){
            $total_price += $row['price'] * $amounts[$row['item_id']];
        }
        $response["total_price"] = $total_price;
        return($response);
    }
}
?>