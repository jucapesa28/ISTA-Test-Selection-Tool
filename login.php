<?php
	//start the session
 	session_start();
	
 	//include any required libraries/classes
	require_once "Classes/Database.class.php";
	
	//include email class
	require('Classes/class.phpmailer.php');
	require('Classes/class.smtp.php');
 	
 		//check to see if already logged in, if so, re-direct to admin.php
		if (isset($_SESSION['emailaddress'])) 
		{
			header("location: testselection.php");
		}
		
			//check if the hashcode is set on the URL to activate the current user account
			if(!empty($_GET["key"]) && !empty($_GET["email"]))
			{
				$user_hash = $_GET["key"];
				$user_email = $_GET["email"];
				
				//verify user hash
				$isValid = verifyUserHash($user_hash, $user_email);
				
				if($isValid != "false")
				{
					activateUser($isValid);
				}
				else
				{
					echo "<div class='error-validation'>*I am sorry, but your account is not active yet. Please, make sure you are using the correct activation link.</div>";
				}
			}
			
		
		//Verify if current user account is active
		function verifyUserStatus($email)
		{
			$db = new Database();
			$conn= $db->getConn();
				
				$stmt = $conn->prepare("select isactive from user where emailaddress=?");
				$stmt->bind_param("s",$email);
				if($stmt->execute()){
				$stmt->bind_result($v_status);
					while($stmt->fetch()){
						$user_status = $v_status;		 
					}
				}
				$stmt->free_result();
				$stmt->close();
				
				if($user_status === "1")
					return TRUE;
				else
					return FALSE;
		}
		
		//make sure that user hash exist and match the current user email (returns user email)
		function verifyUserHash($userHash, $userEmail)
		{
			$db = new Database();
			$conn= $db->getConn();
				
				$stmt = $conn->prepare("select emailaddress from user where hashcode=? and emailaddress=?");
				$stmt->bind_param("ss",$userHash,$userEmail);
				if($stmt->execute()){
				$stmt->bind_result($v_email);
					while($stmt->fetch()){
						$user_emailaddress = $v_email;		 
					}
				}
				$stmt->free_result();
				$stmt->close();
				
				if(!empty($user_emailaddress))
				{
					return $user_emailaddress;
				} 
				else
				{
					return "false";
				}
		}
		
		//If hashcode match with the current user, it will activate the user account
		function activateUser($user_email)
		{
			$db = new Database();
			$conn= $db->getConn();
				
				$stmt = $conn->prepare("update user set isactive='1' where emailaddress=?");
				$stmt->bind_param("s",$user_email);
				$stmt->execute();
				
				$stmt->free_result();
				$stmt->close();
		}
	
		//Cheking if the user is valid
	 	function verifyUser($p_email,$p_password)
		 {
			$db = new Database();
			$conn= $db->getConn();
			
			$user_type = 0;
			//$p_password = sha1($p_password);
			$stmt = $conn->prepare("select emailaddress, firstname, lastname, companyname, address, city, state, zipcode, phonenumber from user 
			where emailaddress=? and password=?");
			$stmt->bind_param("ss",$p_email,$p_password);
			if($stmt->execute()){
			$stmt->bind_result($v_email, $v_firstname, $v_lastname, $v_companyname, $v_address, $v_city, $v_state, $v_zipcode, $v_phonenumber);
				while($stmt->fetch()){
					$status=true;
					$user=array('emailaddress'=>$v_email, 'firstname'=>$v_firstname, 'lastname'=>$v_lastname, 'companyname'=>$v_companyname, 
					'address'=>$v_address, 'city'=>$v_city, 'state'=>$v_state, 'zipcode'=>$v_zipcode, 'phonenumber'=>$v_phonenumber);		 
				}
			}
			$stmt->free_result();
			$stmt->close();
			return $user;
		 }
		 
		 //Authenticate user if it is active
		 function userAutthentication($usr_email)
		 {
		 		$isActivated = verifyUserStatus($usr_email);
		 		
				if($isActivated === TRUE)
				{
					$password=$_POST['password'];
				
					$user = verifyUser($usr_email,$password);
				
					if(isset($user)){
						
						//setting session vars with user info
						$_SESSION['companyname'] = $user[companyname];
						$_SESSION['emailaddress'] = $user[emailaddress];
						$_SESSION['firstname'] = $user[firstname];
						$_SESSION['fullname'] = $user[firstname] . " " . $user[lastname];
						$_SESSION['address'] = $user[address] . ", " . $user[city] . ", " . $user[state] . " " . $user[zipcode];
						$_SESSION['phone'] = $user[phonenumber]; 
						header("location: testselection.php");
					}
					else{
						echo "<div class='error-validation'>*Please check username/password</div>";
					}
				}
				else
				{
					echo "<div class='error-validation'>*I am sorry, but your account is not active yet. Please, make sure you are using the correct activation link.</div>";
				}
		 }
	
	
		if(isset($_POST['login']))
		{
			$user_email = $_POST['emailaddress'];
				
			//authenticate user
			userAutthentication($user_email);
		}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example that shows off a responsive product landing page.">

    <title>ISTA - Test Selection Tool</title>

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure.css">

    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/main-grid-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/main-grid.css">
    <!--<![endif]-->
  
  
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/marketing-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/layouts/landing.css">
    <!--<![endif]-->
    
    <script type="text/javascript" src="Scripts/jquery-2.0.2.min.js"></script>
	<script type="text/javascript" src="Scripts/parsley.min.js"></script>
	<script type="text/javascript" src="Scripts/parsley.extend.js"></script>
  
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

</head>
<body style="background: #00874f">
	
<div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
    	
        <a class="pure-menu-heading" href="index.html"><img src="images/istalogo.jpg" alt="ISTA Logo" /></a>
    </div>
</div>

     <div class="splash">
	    <form class="pure-form" action='login.php' method='post' parsley-validate>
	    	<div style="color:#fff">
	    		<i class="fa fa-unlock-alt fa-4x"></i><h2 style="color:#fff">Account Information</h2>
	    	</div>
		    <fieldset class="pure-group">
		        <input type="email" name='emailaddress' id='emailaddress' class="pure-input-1-2" placeholder="Email" parsley-trigger="change" parsley-required="true" parsley-type="email">
		        <input type="password" name='password' id='password' class="pure-input-1-2" placeholder="Password" parsley-required="true">
		    </fieldset>
		    <button type="submit" class="pure-button pure-input-2-3 pure-button-primary btn-lg" name="login">Sign in</button>
		</form>
			<div style="margin-top: 10px;">
		    	<a href="forgotpassword.php" style="color:#fff">Forgot Password?</a> 
		    </div>
	</div> 

<div class="header" style="background: #00874f">
	
    <!--<div class="footer l-box is-center">
        View the source of this layout to learn more. Made with love by the YUI Team.
    </div>-->

</div>

<script src="http://yui.yahooapis.com/3.14.1/build/yui/yui.js"></script>
<script>
YUI().use('node-base', 'node-event-delegate', function (Y) {
    // This just makes sure that the href="#" attached to the <a> elements
    // don't scroll you back up the page.
    Y.one('body').delegate('click', function (e) {
        e.preventDefault();
    }, 'a[href="#"]');
});
</script>





</body>
</html>
