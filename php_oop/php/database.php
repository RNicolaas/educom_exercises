<?php
class database{
    private $database;

    public function connect(){
        // Set up a connection to the database.
        $database = new mysqli("localhost","root","Bc1nygR6BYZ","database_phpmysql");
        if ($database -> connect_errno) {
            echo "Failed to connect to database: " . $database -> connect_error;
            exit();
        }
        $this->database = $database;
        return($database);
    }

    private function databaseQuery($query){
        //=======================================================================
        // Connects to databse database_phpmysql, sends the query, closes the 
        // connection and returns the result.
        //=======================================================================
        $result = $this->database -> query($query);
        return $result;
    }

    public function getAllFromTable($column,$table){
        //=======================================================================
        // Return all elements from inputted column in inputted table.
        //=======================================================================
        $query = "SELECT " . $column . " FROM " . $table . ";";
        $result = $this->databaseQuery($query); 
        return($result);
    }

    public function registerInDatabase($name,$email,$password){
        //=======================================================================
        // Registers the name email and password into the database and returns 
        // the assigned id.
        //=======================================================================
        global $database;
        $registration_query = "INSERT INTO users (name,email,password) VALUES ('".$name."','".$email."','".$password."');";
        $result = $database -> query($registration_query);
        if ($result){
            $id_query = "SELECT user_id FROM users WHERE email='" . $email . "';";
            $result = $database -> query($id_query);
            $row = $result -> fetch_assoc();
            $id = $row['user_id'];
            return($id);
        }else{
            global $response;
            $response["error"] = "Could not register, try again later.";
        }
    }

    public function isCorrectLogin($_email,$_password){
        //=======================================================================
        // Checks whether there is already a user with the input emailadress and 
        // if the inputted password is incorrect. Returns user_id if correct and
        // return false if incorrect.
        //=======================================================================
        $sql_query = "SELECT user_id,password FROM users WHERE email='".$_email."';";
        $result = $this->databaseQuery($sql_query);
        if ($result -> num_rows == 0){ // There is no user with this email
            return false;
        }
        $row = $result -> fetch_assoc();
        $userpassword = $row['password'];
        $userid = $row['user_id'];
        if ($_password == $userpassword){
            return($userid);
        }else{
            return(false);
        }
    }

    public function login($user_id,$response){
        //=======================================================================
        // Logs in the user with the specified ID.
        //=======================================================================
        $query = "SELECT name FROM users WHERE user_id='" . $user_id . "';";
        $result = $this->databaseQuery($query); 
        $row = $result -> fetch_assoc();
        $name = $row['name'];
        startSession();
        $_SESSION['name'] = $name;
        $_SESSION['user'] = $user_id;
        $response['loggedin'] = true;
        return($response);
    }

    public function isExistingUser($_usermail){
        //=======================================================================
        // Checks whether there is already a user with the input emailadress.
        // Returns true if there is, return false if there isn't
        //=======================================================================
        $sql_query = "SELECT COUNT(email) AS count FROM users WHERE email='".$_usermail."';";
        $result = $this->databaseQuery($sql_query);
        $row = $result -> fetch_assoc();
        $count = $row['count'];
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getItemInfo($item_id){
        //=======================================================================
        // Get all info from the item with the inputted item id from the 
        // database.
        //=======================================================================
        $query = "SELECT * FROM items WHERE item_id='" . $item_id . "';";
        $result = $this->databaseQuery($query); 
        $row = $result -> fetch_assoc();
        return($row);
    }

    public function getMultiItemInfo($item_ids){
        //=======================================================================
        // Get all info from the items with the inputted item ids from the 
        // database.
        //=======================================================================
        $sql_input = "(" . implode(',',$item_ids) . ")";
        $query = "SELECT * FROM items WHERE item_id IN " . $sql_input . ";";
        $result = $this->databaseQuery($query); 
        return($result);
    }

    public function getTableLength($table){
        //=======================================================================
        // Returns the number of rows in a table in the database.
        //=======================================================================
        $query = "SELECT COUNT(*) AS count FROM " . $table . ";";
        $result = $this->databaseQuery($query);
        $row = $result -> fetch_assoc();
        $count = $row['count'];
        return ($count);
    }

    public function getNewOrderID(){
        //=======================================================================
        // Determine the highest order_id in use and return 1 above this.
        //=======================================================================
        $query = "SELECT MAX(order_id) AS max FROM orders;";
        $result = $this->databaseQuery($query); 
        $row = $result -> fetch_assoc();
        $max = $row['max'];
        return($max+1);
    }

    public function sendOrderToDatabase($response){
        //=======================================================================
        // Add an order to the database and empty the shopping cart.
        //=======================================================================
        global $database;
        startSession();
        $user_id = $_SESSION['user'];
        $items = $response['cart_item_ids'];
        $amounts = $response['cart_item_amounts'];
        $order_id = $this->getNewOrderID();
        for($i = 0; $i < count($items); $i++){
            $order_query = "INSERT INTO orders (order_id,user_id,item_id,amount,status) VALUES ('".$order_id."','".$user_id."','".$items[$i]."','".$amounts[$items[$i]]."','paid');";
            $this->databaseQuery($order_query); 
        }
        $_SESSION['cart'] = [];
    }
}
?>