<?php
 	//include any required libraries/classes
	require_once "Classes/Users.class.php";
 	//check to see if already logged in, if so, re-direct to admin.php
	$error = '';	
		

	$id=$_POST['id'];
	
	
		$user = new Users("","","","");
		$status = $user->delete($id);
			if($status != false){
				echo "ok";
			}
			//Create error message
			else{
				echo $error = "<label class='error'>*Employee not Inserted!</label>";
			}


		
	?>
