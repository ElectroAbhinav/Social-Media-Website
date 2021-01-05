<?php
//DECLARING VARIABLES TO PREVENT THE COLLISONS OF THE VALUES

$fname = "";	//First-name
$lname = "";	//Last-name
$em = "";	//Email
$em2= "";	//Email-confirmation
$password = "";	//Password
$password2 = "";	//Password-confirmation
$date = ""; //Sign-Up-date
$error_array = array(); //Holds-error-messages

//If the register button is pressed, the values are passed on to this form and thus we can start evaluating the form variables.
if(isset($_POST['register_button']))
{
			//Registration form values
	
	//First name
	$fname = strip_tags($_POST['reg_fname']); //Removes the HTML tags. 
	$fname = str_replace(' ', '', $fname); //If the user by mistake enters a space after the name then this str_replace gets rid of the space. 
	$fname = ucfirst(strtolower($fname));  //Converts to lower case whatever is entered EXCEPT the first letter.
	$_SESSION['reg_fname'] = $fname; //Stores the fname value in session variable.

	//Last name
	$lname = strip_tags($_POST['reg_lname']); //Removes the HTML tags. 
	$lname = str_replace(' ', '', $lname); //If the user by mistake enters a space after the name then this str_replace gets rid of the space. 
	$lname = ucfirst(strtolower($lname));  //Converts to lower case whatever is entered EXCEPT the first letter.
	$_SESSION['reg_lname'] = $lname; //Stores the lname value in the session variable.
	
	//Email
	$em = strip_tags($_POST['reg_email']); //Removes the HTML tags. 
	$em = str_replace(' ', '', $em); //If the user by mistake enters a space after the name then this str_replace gets rid of the space. 
	$em = ucfirst(strtolower($em));  //Converts to lower case whatever is entered EXCEPT the first letter.
	$_SESSION['reg_email'] = $em;  //Stores the email value in session variable.


	//Email-Confirmation
	$em2 = strip_tags($_POST['reg_email2']); //Removes the HTML tags. 
	$em2 = str_replace(' ', '', $em2); //If the user by mistake enters a space after the name then this str_replace gets rid of the space. 
	$em2 = ucfirst(strtolower($em2));  //Converts to lower case whatever is entered EXCEPT the first letter.
	$_SESSION['reg_email2'] = $em2; //Stores the confirmation email value in session variable.

	//Password
	$password = strip_tags($_POST['reg_password']); //Removes the HTML tags. 
	
	//Password-Confirmation
	$password2 = strip_tags($_POST['reg_password2']); //Removes the HTML tags. 

	//Date
	$date = date("Y-m-d"); //Gets the current date.

	
//VALIDATION CHECKS
	if($em == $em2)
	{
		//Check Wheather the email is in valid format.
		if(filter_var($em, FILTER_VALIDATE_EMAIL))
		{
			$em=filter_var($em, FILTER_VALIDATE_EMAIL);

			//Check if Email already exists.
			$e_check = mysqli_query($con,"SELECT email FROM users WHERE email = '$em'" );

			//Count number of rows returned.
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0)
			{
				array_push($error_array, "Email already exists in our database.<br>");	
			}

		}
		else
		{
			array_push($error_array,"Invalid Format.<br>");
		}
	}
	else
	{
		array_push($error_array, "Email and Confirmation-Emails do not match!<br>");
	} 


	if(strlen($fname) > 25 || strlen($fname) < 2)
	{
		array_push($error_array, "Your first name must be between 2 and 25 characters.<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2)
	{
		array_push($error_array, "Your last name must be between 2 and 25 characters.<br>");
	}

	if($password != $password2)
	{
		array_push($error_array, "Passwords must match.<br>");
	}
	else
	{
		if(preg_match('/[^A-Za-z0-9]/', $password))
		{
			array_push($error_array, "Your password can only contain english characters and numbers.<br>");
		}
	}

	if(strlen($password) > 30 || strlen($password) < 5)
	{
		array_push($error_array, "Your password must be between 5 to 30 characters long.<br>");
	}

	if(empty($error_array))
	{
		$password = md5($password); //Encrypt password before sending to the database.

		//Generate username by concatenating first name and last name.
		$username = strtolower($fname. "_" .$lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

		$i=0;
		//If username exists add number to username. 
		while (mysqli_num_rows($check_username_query) != 0) 
		{
			$i++;
			$username = $username."_".$i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}
		
		//Profile picture assignment
		$rand = rand(1,41); //Random number between 1 and 41.

		//Picture 1 to 41 path location and allocation.
		if($rand == 1)			
			$profile_pic = "assets/images/profile_pics/defaults/Andorian_head.png";
		else if($rand == 2)			
			$profile_pic = "assets/images/profile_pics/defaults/Anonymous_mask.png";
		else if($rand == 3)			
			$profile_pic = "assets/images/profile_pics/defaults/Cat_head";
		else if($rand == 4)			
			$profile_pic = "assets/images/profile_pics/defaults/Exploding_head.png";
		else if($rand == 5)			
			$profile_pic = "assets/images/profile_pics/defaults/Fortune_teller.png";
		else if($rand == 6)			
			$profile_pic = "assets/images/profile_pics/defaults/Fortuma_bender.png";
		else if($rand == 7)			
			$profile_pic = "assets/images/profile_pics/defaults/Gary_the_snail.png";
		else if($rand == 8)			
			$profile_pic = "assets/images/profile_pics/defaults/head_alizarin.png";
		else if($rand == 9)			
			$profile_pic = "assets/images/profile_pics/defaults/head_amethyst.png";
		else if($rand ==10)			
			$profile_pic = "assets/images/profile_pics/defaults/head_belize_hole.png";
		else if($rand == 11)			
			$profile_pic = "assets/images/profile_pics/defaults/head_carrot.png";
		else if($rand == 12)			
			$profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
		else if($rand == 13)			
			$profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
		else if($rand == 14)			
			$profile_pic = "assets/images/profile_pics/defaults/head_green_sea.png";
		else if($rand == 15)			
			$profile_pic = "assets/images/profile_pics/defaults/head_nephritis.png";
		else if($rand == 16)			
			$profile_pic = "assets/images/profile_pics/defaults/head_pete_river.png";
		else if($rand == 17)			
			$profile_pic = "assets/images/profile_pics/defaults/head_pomegranate.png";
		else if($rand == 18)			
			$profile_pic = "assets/images/profile_pics/defaults/head_pumpkin.png";
		else if($rand == 19)			
			$profile_pic = "assets/images/profile_pics/defaults/head_red.png";
		else if($rand == 20)			
			$profile_pic = "assets/images/profile_pics/defaults/head_sun_flower.png";
		else if($rand == 21)			
			$profile_pic = "assets/images/profile_pics/defaults/head_turqoise.png";
		else if($rand == 22)			
			$profile_pic = "assets/images/profile_pics/defaults/head_wet_asphalt.png";
		else if($rand == 23)			
			$profile_pic = "assets/images/profile_pics/defaults/head_wisteria.png";
		else if($rand == 24)			
			$profile_pic = "assets/images/profile_pics/defaults/Head_with_brain.png";
		else if($rand == 25)			
			$profile_pic = "assets/images/profile_pics/defaults/Iron_man.png";
		else if($rand == 26)			
			$profile_pic = "assets/images/profile_pics/defaults/Jake.png";
		else if($rand == 27)			
			$profile_pic = "assets/images/profile_pics/defaults/Lego_head.png";
		else if($rand == 28)			
			$profile_pic = "assets/images/profile_pics/defaults/Lion_head.png";
		else if($rand == 29)			
			$profile_pic = "assets/images/profile_pics/defaults/Mr_karbs.png";
		else if($rand == 30)			
			$profile_pic = "assets/images/profile_pics/defaults/Patrick_star.png";
		else if($rand == 31)			
			$profile_pic = "assets/images/profile_pics/defaults/Plankton.png";
		else if($rand == 32)			
			$profile_pic = "assets/images/profile_pics/defaults/Sandy_cheeks.png";
		else if($rand == 33)			
			$profile_pic = "assets/images/profile_pics/defaults/Scream.png";
		else if($rand == 34)			
			$profile_pic = "assets/images/profile_pics/defaults/Spongebob_squarepants.png";
		else if($rand == 35)			
			$profile_pic = "assets/images/profile_pics/defaults/Squidward_tentacles.png";
		else if($rand == 36)			
			$profile_pic = "assets/images/profile_pics/defaults/Star.png";
		else if($rand == 37)			
			$profile_pic = "assets/images/profile_pics/defaults/Summer.png";
		else if($rand == 38)			
			$profile_pic = "assets/images/profile_pics/defaults/Super_mario.png";
		else if($rand == 39)			
			$profile_pic = "assets/images/profile_pics/defaults/Venom_head.png";
		else if($rand == 40)			
			$profile_pic = "assets/images/profile_pics/defaults/Vulcan_head.png";
		else if($rand == 41)			
			$profile_pic = "assets/images/profile_pics/defaults/Walter_white.png";

		
	$query = mysqli_query($con, "INSERT INTO users VALUES('','$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

	array_push($error_array, "<span style='color: #14C800'> You're all set! Go ahead and Login!</span><br>");

	//Clear session variables after successfull registration.
	$_SESSION['reg_fname']="";
	$_SESSION['reg_lname']="";
	$_SESSION['reg_email']="";
	$_SESSION['reg_email2']="";
	}
}
?>