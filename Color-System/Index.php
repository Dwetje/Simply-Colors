<?php
session_start();
include("GUID.php");
include("DBconfig.php");

if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = "Home";
}

if($page) {
	include("pages/".$page.".php");
}

?>
