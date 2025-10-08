<?php
include "php/functions.php";
require "php/database.php";
$database = new database();
$database->connect();

require "php/controller.php";

$controller = new controller($database);
$controller->show();
 
?>