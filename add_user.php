<?php
	
 	//include any required libraries/classes
	require_once "Classes/Users.class.php";
 	//check to see if already logged in, if so, re-direct to admin.php
	$error = '';	
		
	
	//if valid login credentials, create appropriate session variables and cookies, then 
	//redirect to admin.php
	
	$password=$_POST['password'];
	$re_password=$_POST['re_password'];
	$username = $_POST['user'];
	$email = $_POST['email'];
	$user_type = $_POST['user_type'];
	
	if($password == $re_password){
		$user = new Users($username,$password,$email,$user_type);
		$status = $user->register();
			if($status != false){
				echo "ok";
				//$error = "<label class='success'>*User Successfully Added!</label>";
			}
			//if invalid login credentials, create error message
			else{
				echo $error = "<label class='error'>*Please check username/password</label>";
			}
	}
	else{
		echo $error = "<label class='error'>*Passwords do not match, please retype.</label>";
	}

		
	?>
