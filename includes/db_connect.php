<?php
//include_once 'config.php';   // As functions.php is not included
include_once $_SERVER['DOCUMENT_ROOT']."/includes/config.php";
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);