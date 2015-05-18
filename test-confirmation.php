<?php
	session_start();

	if (!isset($_SESSION['emailaddress'])) {
		header("location: login.php");
		}	

		if(isset($_POST['back']))
		{
			unset($_SESSION['testprotocol']);
			
			header("location: testselection.php");
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
  
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.cs

<script type="text/javascript" src="Scripts/jquery-2.0.2.min.js"></script>
<script type="text/javascript" src="Scripts/parsley.min.js"></script>
<script type="text/javascript" src="Scripts/parsley.extend.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

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
	  			<div class="progress-bar progress-bar-success" style="width: 25%">
   					<span class="sr-only">25% Complete (success)</span>
	  			</div>
			</div>
			
		    <fieldset>
		    
		    <legend>	
			    <div style="color:#fff; margin-bottom: 10px">
		    		<i class="fa fa-thumbs-up fa-4x"></i>
		    	</div>
	            	<div class="alert alert-success" style="text-transform: none"><img src="images/check_mark.png" /> Your test request has been sent successfully.</div>
        </legend>
        
		<form class="pure-form pure-form-stacked" id='sendtest' action='test-confirmation.php' method='post' parsley-validate>
					
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
							    </div>
							  </div>
						</div>
					</legend>
					
					<button type="submit" class="pure-button pure-button-primary btn-lg" style="margin-top: 30px; margin-bottom: 30px;" name="back">Create a New Test Request</button>
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
