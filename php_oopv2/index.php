<?php
require_once "php/controller.php";
require_once "php/database.php";
$database = new database();
$database->connect();
$controller = new controller($database);
$controller->getPage();
$controller->showPage();
?>