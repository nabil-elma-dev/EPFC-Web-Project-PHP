<?php
	require_once "functions.php";
	$_SESSION = [];	// making session array empty
	session_destroy(); // destroying session
	redirect('index.php'); // redirect towards index
?>
