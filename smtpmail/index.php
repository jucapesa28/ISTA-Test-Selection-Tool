<?php
include 'library.php'; // include the library file
include "classes/class.phpmailer.php"; // include the class name

if(isset($_POST["send"])){
	$email = $_POST["email"];
	$mail	= new PHPMailer; // call the class 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = "jucapesa28@gmail.com"; //Username for SMTP authentication any valid email created in your domain
	$mail->Password = "5359681"; //Password for SMTP authentication
	$mail->AddReplyTo("jucapesa28@gmail.com", "Reply name"); //reply-to address
	$mail->SetFrom("jucapesa28@gmail.com", "Jucapesa SMTP Mailer"); //From address of the mail
	// put your while loop here like below,
	$mail->Subject = "Your SMTP Mail"; //Subject od your mail
	$mail->AddAddress($email, "Juan Perez"); //To address who will receive this email
	$mail->MsgHTML("<b>Hi, your first SMTP mail has been received. Great Job!.. <br/><br/>by <a href='http://www.asif18.com/7/php/send-mails-using-smtp-in-php-by-gmail-server-or-own-domain-server/'>Asif18</a></b>"); //Put your body of the message you can place html code here
	$mail->AddAttachment("images/asif18-logo.png"); //Attach a file here if any or comment this line, 
	$send = $mail->Send(); //Send the mails
	if($send){
		echo '<center><h3 style="color:#009933;">Mail sent successfully</h3></center>';
	}
	else{
		echo '<center><h3 style="color:#FF3300;">Mail error: </h3></center>'.$mail->ErrorInfo;
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Send mails using SMTP and PHP in PHP Mailer using our own server or gmail server by Asif18</title>
<meta name="keywords" content="send mails using smpt in php, php mailer for send emails in smtp, use gmail for smtp in php, gmail smtp server name"/>
<meta name="description" content="Send mails using SMTP and PHP in PHP Mailer using our own server or gmail server"/>
<style>
.as_wrapper{
	font-family:Arial;
	color:#333;
	font-size:14px;
}
.mytable{
	padding:20px;
	border:2px dashed #17A3F7;
	width:100%;
}
</style>
<body>
<div class="as_wrapper">
	<h1>Send mails using SMTP and PHP in PHP Mailer using our own server or gmail server</h1>
    <form action="" method="post">
    <table class="mytable">
    <tr>
    	<td><input type="email" placeholder="Email" name="email" /></td>
	</tr>
    <tr>
    	<td><input type="submit" name="send" value="Send via SMTP" /></td>
	</tr>
    </table>
    </form>
</div>
</body>
</html>