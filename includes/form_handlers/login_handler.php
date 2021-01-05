<?php 

if(isset($_POST['login_button']))
{
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Sanitize email.
	$_SESSION['log_email'] = $email; //Stores email in session. variable.
	$password = md5($_POST['log_password']); //Get password.

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1)
	{
		$row = mysqli_fetch_array($check_database_query); //Results from the SQL query are stored in the $row variable.
		$username = $row['username']; //Any column of the fetched database stored in $row variable can be acessed via ths method.(Here the coloumn of username is accessed.)

		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
	
	if(mysqli_num_rows($user_closed_query) == 1)
	{
		$reopen_account	= mysqli_query($con,"UPDATE users SET user_closed='no' WHERE email='$email'" );
	}		 

		$_SESSION['username'] = $username; //Checks if the user is logged in or not. If not then this redirects the user to the index page of the 'Centfeed'.
		header("Location: index.php");
		exit();
	}

	else
	{
		array_push($error_array, "Email or Password was incorrect. Please try again.<br>");
	}
} 

?>
