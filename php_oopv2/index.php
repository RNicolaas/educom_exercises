<?php
function clearSessionParameters(){
    //=======================================================================
    // Clears all the session parameters.
    //=======================================================================
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $_SESSION = [];
    session_destroy();
}
//clearSessionParameters();

require_once "php/controller.php";
require_once "php/database.php";
require_once "php/session.php";
$database = new database();
$database->connect();
$session = new session_handler();
$controller = new controller($database,$session);
$controller->getPage();
$controller->showPage();
?>