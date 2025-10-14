<?php
require_once "php/paragraph.php";
require_once "php/head_text.php";
require_once "php/header.php";
require_once "php/database.php";
$database = new database();
$database->connect();
$header = new header($database);
$head = new head_text('big');
$head->showContent();
$para = new paragraph('small');
$para->showContent();
?>