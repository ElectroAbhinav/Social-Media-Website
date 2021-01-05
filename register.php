<?php

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Centfeed</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>

</head>
<body>
	
	<?php 
	if(isset($_POST['register_button']))
		echo '
		<script>
		$(document).ready(function(){
			$("#first").hide();
			$("#second").show();

		});

		</script>
		';
	?>

	<div class="wrapper">
		
		<div class="login_box">
			
			<div class="login_header">
				<h1>Centfeed!</h1>
				Login or Sign up below!
			</div>
			
			<div id="first">
				<!--LOGIN BUTTON FORMAT!-->
				<form action="register.php" method="POST">
					
					<input type="email" name="log_email" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['log_email']))
					{
						echo $_SESSION['log_email'];
					}
					?>" required>
					<br>
					<input type="password" name="log_password" placeholder="Password">
					<br>
					<?php if(in_array("Email or Password was incorrect. Please try again.<br>", $error_array)) echo "Email or Password was incorrect. Please try again.<br>"; ?>
					<input type="submit" name="login_button" value="Login">
					<br>

					<!-- 'a' stands for anchor tags, here we put hyperlinks for next set of pages.-->				
					<a href="#" id="signup" class="signup">Need an account? Register here.</a>

				</form>
			</div>
			
				<div id="second">
					<!--SUBMIT BUTTON FORMAT!-->
					<form action="register.php" method="POST">
						<!--	Check why this does not stores the $fname in $SESSION variable whereas $lname and $email are stores ( RESOLVED ) !-->  
						<br>
						<input type="text" name="reg_fname" placeholder="First Name, For eg:José" value="<?php 
						if(isset($_SESSION['reg_fname'])) 
						{
							echo $_SESSION['reg_fname'];
						}?>" required>
						<br>
						<!-- Displaying Error message generated to the user!-->
						<?php if(in_array("Your first name must be between 2 and 25 characters.<br>", $error_array)) echo "Your first name must be between 2 and 25 characters.<br>"; ?>


						<input type="text" name="reg_lname" placeholder="Last Name, For eg:Mourinho" value="<?php 
						if(isset($_SESSION['reg_lname'])) 
						{
							echo $_SESSION['reg_lname'];
						}?>" required>
						<br>
						<!-- Displaying Error message generated to the user!-->
						<?php if(in_array("Your last name must be between 2 and 25 characters.<br>", $error_array)) echo "Your last name must be between 2 and 25 characters.<br>";?>
						

						<input type="email" name="reg_email" placeholder="Email, For eg:JoséMourinho@spurs.com" value="<?php 
						if(isset($_SESSION['reg_email'])) 
						{
							echo $_SESSION['reg_email'];
						}?>" required>
						<br>
						<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
						if(isset($_SESSION['reg_email2']))
						{
							echo $_SESSION['reg_email2'];
						}
						?>"required>
						<br>

						<!-- Displaying Error message generated to the user!-->
						<?php 
						if(in_array("Email already exists in our database.<br>", $error_array)) echo "Email already exists in our database.<br>";	
						else if(in_array("Invalid Format.<br>", $error_array)) echo "Invalid Format.<br>"; 
						else if(in_array("Email and Confirmation-Emails do not match!<br>", $error_array)) echo "Email and Confirmation-Emails do not match!<br>"; ?>

						
						<input type="Password" name="reg_password" placeholder="Password" required>
							<br>
						<input type="Password" name="reg_password2" placeholder="Confirm Password" required>
							<br>
						<?php 
						if(in_array("Passwords must match.<br>", $error_array)) echo "Passwords must match.<br>";	
						else if(in_array("Your password can only contain english characters and numbers.<br>", $error_array)) echo "Your password can only contain english characters and numbers.<br>"; 
						else if(in_array("Your password must be between 5 to 30 characters long.<br>", $error_array)) echo "Your password must be between 5 to 30 characters long.<br>"; ?>

						<input type="submit" name="register_button" value="Register">
						<br>

						<?php if(in_array("<span style='color: #14C800'> You're all set! Go ahead and Login!</span><br>", $error_array)) echo "<span style='color: #14C800'> You're all set! Go ahead and Login!</span><br>";?>

						<a href="#" id="signin" class="signin">Already have an account? Sign in here! </a>

					</form>
			</div>
		</div>
	</div>
</body>
</html>