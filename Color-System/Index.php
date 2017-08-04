<?php
// Begin session
session_start();
// Laad DataController.php in index.
include("lib/scripts/DataController.php");
// Controleer of bestand als page wordt herkend.
if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = "Home";
}
// Laad die page in
if($page) {
	include("pages/".$page.".php");
}
?>
