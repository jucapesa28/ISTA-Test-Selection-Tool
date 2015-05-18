<?php
require('Classes/class.phpmailer.php');
require('Classes/class.smtp.php');

$email = 'jucapesa28@gmail.com'; //this should be lab test email address

                                                $mail   = new PHPMailer; // call the class 

                                                $mail->IsSMTP(); 

                                                $mail->SMTPAuth = true; // authentication enabled

                                                $mail->Host = "127.0.0.1";

                                                $mail->Port = 25; // or 587

                                                $mail->IsHTML(true);

                                                $mail->Username = "devtstis"; //Username for SMTP authentication any valid email created in your domain

                                                $mail->Password = "knL1E1k8z0"; //Password for SMTP authentication

                                                $mail->SetFrom("ista@ista.org", $_SESSION['companyname'] . " - New Test Request"); //From address of the mail

                                                $mail->Subject = $_SESSION['companyname'] . " - New Test Request"; //Subject od your mail

                                                $mail->AddAddress($email, "ISTA - Lab"); //To address who will receive this email

                                                $mail->MsgHTML("<h1>Company Details</h1><br/><br/><strong>Company Name: </strong>" . $_SESSION['companyname'] . "<br />

                                                <strong>Contact Name: </strong>" . $_SESSION['fullname'] . "<br />

                                                <strong>Address: </strong>" . $_SESSION['address'] . "<br />

                                                <strong>Email Address: </strong>" . $_SESSION['emailaddress'] . "<br />

                                                <strong>Phone Number: </strong>" . $_SESSION['companyname'] . "<br /><br /><br />

                                                <h1>Test Details</h1><br /><br />

                                                <strong>Product Name: </strong>" . $_SESSION['productname'] . "<br />

                                                <strong>Product Model: </strong>" . $_SESSION['productmodel'] . "<br />

                                                <strong>Length: </strong>" . $_SESSION['length'] . "<br />

                                                <strong>Width: </strong>" . $_SESSION['width'] . "<br />

                                                <strong>Height </strong>" . $_SESSION['height'] . "<br />

                                                <strong>Weight: </strong>" . $_SESSION['weight'] . "<br />

                                                <strong>Test Protocol: </strong>" . $_SESSION['testprotocol'] . "<br />

                                                <strong>Number of Samples: </strong>" . $_SESSION['numberofsamples'] . "<br />

                                                <strong>Comment(s): </strong>" . $_SESSION['comment'] . "<br />"); 

                                                $send = $mail->Send(); //Send the mails

                                                if($send){

                                                            echo '<center><h3 style="color:#009933;">Mail sent successfully</h3></center>';

                                                }

                                                else{

                                                            echo '<center><h3 style="color:#FF3300;">Mail error: </h3></center>'.$mail->ErrorInfo;

                                                }

?>