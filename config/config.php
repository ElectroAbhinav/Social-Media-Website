<?php
ob_start(); //Turns on output buffering.
session_start();

$timezone = date_default_timezone_set("Asia/Kolkata"); //Sets the time to IST.

$con = mysqli_connect("localhost", "root", "", "social"); //$con is the connection variable.

if(mysqli_connect_errno())
{
	echo "Failed to connect:".mysqli_connect_errno();
}
?>
