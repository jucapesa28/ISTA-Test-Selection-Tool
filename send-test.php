<?php
require('Classes/class.phpmailer.php');
require('Classes/class.smtp.php');

	session_start();
	
	//Send email confirmation to activate new user account
		function sendEmailToLab()
		 {
			 	$email = $_SESSION['labemail']; //this should be lab test email address
				$mail	= new PHPMailer; // call the class 
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
				$mail->MsgHTML("<div style='text-align: center'><img src='http://dev.tst.ista.org/images/istalogo.jpg' alt='ISTA logo' /></div>
				<h2>*Test Lab:</h2><p>This test request has been sent to you via the ISTA Test Selection Tool. This tool allows 
				those requiring package testing to identify an appropriate test protocol and submit a request to an ISTA certified laboratory of their 
				choosing. Please contact the test requester below for additional information.</p>
				<h2>Company Details</h2><br/><br/><strong>Company Name: </strong>" . $_SESSION['companyname'] . "<br />
				<strong>Contact Name: </strong>" . $_SESSION['fullname'] . "<br />
				<strong>Address: </strong>" . $_SESSION['address'] . "<br />
				<strong>Email Address: </strong>" . $_SESSION['emailaddress'] . "<br />
				<strong>Phone Number: </strong>" . $_SESSION['phone'] . "<br /><br /><br />
				<h2>Test Details</h2><br /><br />
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
					//send email to customer (test request order confirmation)
					sendEmailToCustomer();
					
					header("location: test-confirmation.php");
				}
				else{
					echo '<center><h3 style="color:#FF3300;">Mail error: </h3></center>'.$mail->ErrorInfo;
				}
		 }

	//Send email confirmation to activate new user account
		function sendEmailToCustomer()
		 {
			 	$email = $_SESSION['emailaddress'];
				$mail	= new PHPMailer; // call the class 
				$mail->IsSMTP(); 
				$mail->SMTPAuth = true; // authentication enabled
				$mail->Host = "127.0.0.1";
				$mail->Port = 25; // or 587
				$mail->IsHTML(true);
				$mail->Username = "devtstis"; //Username for SMTP authentication any valid email created in your domain
				$mail->Password = "knL1E1k8z0"; //Password for SMTP authentication
				$mail->SetFrom("ista@ista.org", "ISTA - Test Request Confirmation"); //From address of the mail
				$mail->Subject = $_SESSION['companyname'] . " - New Test Request"; //Subject od your mail
				$mail->AddAddress($email, "ISTA - Test Request Confirmation"); //To address who will receive this email
				$mail->MsgHTML("<div style='text-align: center'><img src='http://dev.tst.ista.org/images/istalogo.jpg' alt='ISTA logo' /></div>
				<h2>*Test Lab:</h2><p>This test request has been sent to you via the ISTA Test Selection Tool. This tool allows 
				those requiring package testing to identify an appropriate test protocol and submit a request to an ISTA certified laboratory of their 
				choosing. Please contact the test requester below for additional information.</p>
				<h2>Company Details</h2><strong>Company Name: </strong>" . $_SESSION['companyname'] . "<br />
				<strong>Contact Name: </strong>" . $_SESSION['fullname'] . "<br />
				<strong>Address: </strong>" . $_SESSION['address'] . "<br />
				<strong>Email Address: </strong>" . $_SESSION['emailaddress'] . "<br />
				<strong>Phone Number: </strong>" . $_SESSION['phone'] . "<br /><br /><br />
				<h2>Test Details</h2>
				<strong>Product Name: </strong>" . $_SESSION['productname'] . "<br />
				<strong>Product Model: </strong>" . $_SESSION['productmodel'] . "<br />
				<strong>Length: </strong>" . $_SESSION['length'] . "<br />
				<strong>Width: </strong>" . $_SESSION['width'] . "<br />
				<strong>Height </strong>" . $_SESSION['height'] . "<br />
				<strong>Weight: </strong>" . $_SESSION['weight'] . "<br />
				<strong>Test Protocol: </strong>" . $_SESSION['testprotocol'] . "<br />
				<strong>Number of Samples: </strong>" . $_SESSION['numberofsamples'] . "<br />
				<strong>Comment(s): </strong>" . $_SESSION['comment'] . "<br />"); 
				
				$send = $mail->Send(); //Send the e-mail
		 }

	if (!isset($_SESSION['emailaddress'])) {
		header("location: login.php");
		}	
			if(isset($_POST['send']))
			{
				if(isset($_SESSION['productname']) && isset($_SESSION['productmodel']) && isset($_SESSION['numberofsamples'] ) && isset($_SESSION['comment'])){
						
					$_SESSION['labemail'] = $_POST['txtTestLab'];
					
					//send email to test lab
					sendEmailToLab();
					
			}
			else {
				echo "<div class='error-validation'>*You must have to fill all the fields on this form.</div>";
			}
		}   
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example that shows off a responsive product landing page.">
<script src="Scripts/dropdownMenu.js" type="text/javascript"></script>

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

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Map Locator style -->
<link rel="stylesheet" type="text/css" href="css/map.css" />

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link href="js/select2/select2.css" rel="stylesheet"/>
<script src="js/select2/select2.js"></script>

<script>
        $(document).ready(function() { $("#labslist").select2(); });
</script>

</head>
<body style="background: #00874f">>
	
<div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
    	
        <a class="pure-menu-heading" href="index.html"><img src="images/istalogo.jpg" alt="ISTA Logo" /></a>
               
        <div id="logindisplay" style="width: 150px; float: right; margin-right: 20px; text-align: center">
        	<h3>Welcome <?php echo $_SESSION['firstname'] ?>!</h3><a class="button-large pure-button" href="logout.php">Logout</a>
        </div>
    </div>
</div>



<div class="splash">	
			<h1>Progress</h1>
			<div class="progress">
				  <div class="progress-bar progress-bar-info" style="width: 25%">
				    <span class="sr-only">25% Complete (success)</span>
				  </div>
				  <div class="progress-bar progress-bar-warning" style="width: 25%">
   					<span class="sr-only">25% Complete (warning)</span>
	  			</div>
	  			<div class="progress-bar progress-bar-danger" style="width: 25%">
   					<span class="sr-only">25% Complete (danger)</span>
	  			</div>
			</div>
			
		    <fieldset>
		    
		    <legend>	
			    <div style="color:#fff">
		    		<i class="fa fa-truck fa-4x"></i><h2 style="color:#fff">Send Test Request to Lab</h2>
		    	</div>
		    	 <p class="splash-subhead">
	            	Find a lab near to you and then send your test.
	        	</p>
        </legend>
        
        		<legend>
        			<h3 style="color: #fff">1. Find a Lab</h3>
							<div id="store-locator-container">
							      <div id="form-container" class="form-horizontal">
							        <form id="user-location" method="post" action="#">
							            <div class="input-group col-md-8">
							              	<input type="text" class="form-control" id="address" name="address" placeholder="Enter Address or Zip Code" />
							              	<span class="input-group-btn">
        										<button id="submit" class="pure-button pure-button-primary btn-lg" type="submit">Find</button>
      										</span>
							             </div>
							        </form>
							      </div>
							
							      <div id="map-container">
							        <div id="loc-list">
							            <ul id="list"></ul>
							        </div>
							        <div id="map"></div>
							      </div>
							 </div>
					</legend>
        
		<form class="pure-form pure-form-stacked" id='sendtest' action='send-test.php' method='post' parsley-validate>
					
					<legend>
		            	<div class="pure-u-1 pure-u-med-2-3">
		            		<h3 style="color: #fff">2. Select a Test Lab from the list</h3>
			            	<label for="lblTestLab">Test Lab</label>
			            	<select class="pure-input-1-2" style="width: 98%"  name="txtTestLab" id="labslist" parsley-required="true">
			            		<option value="-1">--Select One--</option>
			                    <option value="tjkmet@rit.edu">RIT Packaging Science Dynamics Lab</option>
			                    <option value="tjkmet@rit.edu">Exova Canada Inc.</option>
			                    <option value="tjkmet@rit.edu">Infinity Testing Solutions Inc.</option>
	                		</select>
	                	</div>
		            </legend>
		            
					<legend>
						<div class="panel panel-success">
							  <div class="panel-heading">
							    <h3 class="panel-title" style="font-weight: bold">Test Request Summary</h3>
							  </div>
							  <div class="panel-body">
							  	 <div class="row">
							    	<div class="col-md-6"><label for="lblProductName">Product Name</label></div>
							    	<div class="col-md-6"><label for="txtProductName"><?php echo $_SESSION['productname']?></label></div>
							    	<div class="col-md-6"><label for="lblProductModel">Product Model</label></div>
							    	<div class="col-md-6"><label for="txtProductModel"><?php echo $_SESSION['productmodel']?></label></div>
							    	<div class="col-md-6"><label for="lblLength">Length</label></div>
							    	<div class="col-md-6"><label for="txtLength"><?php echo $_SESSION['length']?></label></div>
							    	<div class="col-md-6"><label for="lblWidth">Width</label></div>
							    	<div class="col-md-6"><label for="txtWidth"><?php echo $_SESSION['width']?></label></div>
							    	<div class="col-md-6"><label for="lblHeight">Height</label></div>
							    	<div class="col-md-6"><label for="txtHeight"><?php echo $_SESSION['height']?></label></div>
							    	<div class="col-md-6"><label for="lblWeight">Weight</label></div>
							    	<div class="col-md-6"><label for="txtWeight"><?php echo $_SESSION['weight']?></label></div>
							    	<div class="col-md-6"><label for="lblTestProtocolName">Test Protocol Name</label></div>
							    	<div class="col-md-6"><label for="txtTestProtocolName"><?php echo $_SESSION['testprotocol']?></label></div>
							    	<div class="col-md-6"><label for="lblNumberOfSamples">Number Of Samples</label></div>
							    	<div class="col-md-6"><label for="txtNumberOfSamples"><?php echo $_SESSION['numberofsamples']?></label></div>
							    	<div class="col-md-6"><label for="lblComment">Comment(s)</label></div>
							    	<div class="col-md-6"><label for="txtComment"><?php echo $_SESSION['comment']?></label></div>
							    	<!--<div class="col-md-6"><button type="button" id="edit-btn" class="btn btn-primary">Edit</button></div>-->
							    </div>
							  </div>
						</div>
					</legend>
					<legend>
						<p style="color:yellow; text-transform: none;">
							*NOTE: The ISTA Test Selection Tool allows you to send test requests directly 
							to ISTA certified test labs via email. ISTA recommends contacting the ISTA certified labs directly for more immediate response.
						</p>
					</legend>
		            
		    	<button type="submit" class="pure-button pure-button-primary btn-lg" style="margin-top: 30px; margin-bottom: 30px;" name="send">Send Test Request to Lab</button>
		    </fieldset>
		</form>
</div>   


<div class="header" style="background: #00874f">
	
    <!--<div class="footer l-box is-center">
        View the source of this layout to learn more. Made with love by the YUI Team.
    </div>-->

</div>
	<!--Lab Locator scripts-->
	<script src="js/handlebars-v1.3.0.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="js/jquery.storelocator.js"></script>
      <script>
        $(function() {
          $('#map-container').storeLocator({'dataType': 'xml', 'dataLocation': 'locations.xml', 'slideMap': false, 'modalWindow': true});
        });
      </script>

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
