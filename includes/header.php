<?php
	require 'config/config.php';

	if(isset($_SESSION['username'])) //Here session variable is  'username' and not '$username'.
		{
			$userLoggedIn = $_SESSION['username']; 
		}
	else
		{
			header("Location: register.php"); //If the user is not logged in then it directs them to login page.
		}		
?>

<!DOCTYPE html>
<html>
<head>
	<title>Centfeed</title>
	
	<!-- JAVASCRIPT !-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> <!-- Adds JQuery to page. !-->
	
	<!-- TWITTER BOOTSTRAP !-->
	<script src="assets/js/bootstrap.js"></script> 
	
	<!-- CSS !-->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	 
	 <div class="top_bar">
		
		<div class="logo">
			<a href="index.php">Centfeed!</a>
		</div>

		<nav>
			<a href="#">Home</a>
			<a href="#">Messages</a>
			<a href="#">Notifications</a>
			<a href="#">Settings</a>

		</nav>	 	

	 </div>