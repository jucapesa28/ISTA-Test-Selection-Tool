<?php
	//start the session
 	session_start();
	
 	//include any required libraries/classes
	require_once "Classes/Database.class.php";
	
	//include email class
	require('Classes/class.phpmailer.php');
	require('Classes/class.smtp.php');

 		
 		//check to see if already logged in, if so, re-direct to admin.php
		if (isset($_SESSION['username'])) {
		header("location: testselection.php");
		}
	
		//Cheking if the user is valid
		 function verifyUser($p_email)
		 {
			$db = new Database();
			$conn= $db->getConn();
			
			$user_type = 0;
			//$p_password = sha1($p_password);
			$stmt = $conn->prepare("select emailaddress, password from user where emailaddress=?");
			$stmt->bind_param("s",$p_email);
			if($stmt->execute()){
			$stmt->bind_result($v_email, $v_password);
				while($stmt->fetch()){
					$status=true;
					$user=array('emailaddress'=>$v_email,'password'=>$v_password);		 
				}
			}
			$stmt->free_result();
			$stmt->close();
			
			return $user;
		 }
		 
		 //Send email to user in order to recover his password
		 function sendRecoveryEmail($se_sendTo, $se_password)
		 {
		 		$email = $se_sendTo;
				$mail	= new PHPMailer; // call the class 
				$mail->IsSMTP(); 
				$mail->SMTPAuth = true; // authentication enabled
				$mail->Host = "127.0.0.1";
				$mail->Port = 25; // or 587
				$mail->IsHTML(true);
				$mail->Username = "devtstis"; //Username for SMTP authentication any valid email created in your domain
				$mail->Password = "knL1E1k8z0"; //Password for SMTP authentication
				$mail->SetFrom("ista@ista.org", "ISTA - Test Selection Tool"); //From address of the mail
				$mail->Subject = "ISTA | Password Recovery"; //Subject od your mail
				$mail->AddAddress($email, "ISTA - Password Recovery"); //To address who will receive this email
				$mail->MsgHTML("<b>Hello, </b><br/><br/>Here is your account password: " . $se_password . "<br /><br /><br />ISTA - Test Selection Tool"); 
				
				$send = $mail->Send(); 
		 }
	
	
	if(isset($_POST['recover']))
	{
		$email = $_POST['emailaddress'];
		
		//verify if this email exists
		$user = verifyUser($email);
	
		if(isset($user))
		{
			//email params
			$sendTo = $user[emailaddress];
			$password = $user[password];
			
			//send email with username and password
			sendRecoveryEmail($sendTo, $password);
			
			//redirects user to confirmation page
			header("location: forgotpasswordconfirmation.php");
		}
		//if invalid login credentials, create error message
		else
		{
			echo "<div class='error-validation'>*I am sorry, but this email does not exist</div>";
		}
	}
		
	//if missing information, create error message
	
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
	    <form class="pure-form" action='forgotpassword.php' method='post' parsley-validate>
	    	<div style="color:#fff">
	    		<i class="fa fa-lock fa-4x"></i><h2 style="color:#fff">Forgot your Password?</h2>
	    	</div>
	    	 <p class="splash-subhead">
            	Please enter a valid email information to recover your password.
        	</p>
	    	
		    <fieldset>
		        <input type="email" name='emailaddress' id='emailaddress' class="pure-input-1-2" placeholder="Email" parsley-trigger="change" parsley-required="true" parsley-type="email">
		    </fieldset>
		    <button type="submit" class="pure-button pure-input-2-3 pure-button-primary btn-lg" name="recover">Recover Password</button>
		</form>
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
