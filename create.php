<?php

	session_start();
	
	if (!isset($_SESSION['emailaddress'])) {
		header("location: login.php");
		}
	
	if(isset($_POST['create'])){
		if(isset($_POST['txtProductName']) && isset($_POST['txtProductModel']) && isset($_POST['txtNumOfSamples']) && isset($_POST['txtComment'])){
			$_SESSION['productname'] = $_POST['txtProductName'];
			$_SESSION['productmodel'] = $_POST['txtProductModel'];
			
			//check if measure type is either in english or metrics
			if($_POST['measureType'] == "true"){
				$_SESSION['height'] = $_POST['height'] . " inches";
				$_SESSION['length'] = $_POST['length'] . " inches";
				$_SESSION['width'] = $_POST['width'] . " inches";
				$_SESSION['weight'] = $_POST['weight'] . " lbs";
			}
				
			else {
				$_SESSION['height'] = $_POST['height'] . " mm";
				$_SESSION['length'] = $_POST['length'] . " mm";
				$_SESSION['width'] = $_POST['width'] . " mm";
				$_SESSION['weight'] = $_POST['weight'] . " kg";
			}
			
			$_SESSION['numberofsamples'] = $_POST['txtNumOfSamples'];
			$_SESSION['comment'] = $_POST['txtComment'];
			header("location: send-test.php");
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

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<style>
	.error-validation {
			color: red;
			border: solid 1px red;
			padding: 10px;
			margin-left: 160px;
			margin-top: 20px;
			max-width: 550px;
			background: #ffd6d6;
			float: right;
		}
</style>

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

			<!-- Package Type Modal -->
			<div class="modal fade" id="PackageTypeHelp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">About Package Type</h4>
			      </div>
			      <div class="modal-body">
			        	<span>
			                 <strong>Package type: </strong>ISTA® has developed specialized test protocols that includes test for package type like unitized 
			                 loads and reusable containers. Please define your package type by selecting one of the package types from the drop down list.<br /><br />
			                 <strong>Individual Pkg up to 150 lbs: </strong>Here goes some text Here goes some text Here goes some text<br /><br />
			                 <strong>Individual Pkg over to 150 lbs: </strong>Here goes some text Here goes some text Here goes some text<br /><br />
			                 <strong>Unitized: </strong>A single or number of products packaged in a specific manner and capable of being handled and shipped as a unit.<br /><br />
			                 <strong>Bulk: </strong>Bulk loading is shipping products in large amounts in one transport container and because of their size or weight, special handling equipments or mechanical means are required.<br /><br />
			                 <strong>Reusable: </strong>Transport containers holding loads up to 150 lbs and capable of being reused in the distribution system.
			           	</span>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
			
			<!-- Product Model Modal -->
			<div class="modal fade" id="ProductModelHelp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">About Distribution Type</h4>
			      </div>
			      <div class="modal-body">
			        <span>
			                 <strong>Distribution type: </strong>ISTA® has developed specialized test protocols that includes test for specific distribution modes such as parcel delivery 
			                 and bulk shipments. Please define the distribution mode through which your packaged-products move in the distribution environment by selecting one of the 
			                 specific distribution modes from the drop down list.<br /><br />
			                 <strong>Any: </strong>Here goes some text Here goes some text Here goes some text<br /><br />
			                 <strong>Specialized Furniture: </strong>Furniture that is heavy, bulky and has a fragile side and special equipment required for handling. ISTA 2C test is designed to evaluate the performance of furniture goods in a container.<br /><br />
			                 <strong>Parcel Delivery: </strong>Parcel delivery is the shipping of individual packages weighing less than 150 lbs. as a single shipment.<br /><br />
			                 <strong>Less-Than-Truckload Delivery: </strong>Less-than-truckload delivery refers to any shipment that does not fill the entire truck. ISTA 2F covers testing of individual packaged products, including palletized loads when prepared for less-than-truckload shipment.<br /><br />
			                 <strong>Distribution Center to Retail: </strong>Individual packaged product stored in a distribution center shipped to retail facility. ISTA 3F test specializes in testing of non-unitized load transported from distribution center (DC) to retail.<br /><br />
			                 <strong>Various: </strong>Distribution involves various combinations of distribution methods. ISTA allows ISTA members to create a test protocol that will suit their own particular purposes and applications.</span>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
			
			<h1>Progress</h1>
			<div class="progress">
				  <div class="progress-bar progress-bar-info" style="width: 25%">
				    <span class="sr-only">25% Complete (success)</span>
				  </div>
				  <div class="progress-bar progress-bar-warning" style="width: 25%">
   					<span class="sr-only">25% Complete (warning)</span>
	  			</div>
			</div>
			
		    <fieldset>
		    
		    <legend>	
			    <div style="color:#fff">
		    		<i class="fa fa-pencil fa-4x"></i><h2 style="color:#fff">Create Your Test Request</h2>
		    	</div>
		    	 <p class="splash-subhead">
	            	Enter the details and information related to your package.
	        	</p>
        </legend>
        
		<form class="pure-form pure-form-stacked" id='createtest' action='create.php' method='post' parsley-validate>
					
					<legend>
						<h1>Test Protocol: <label for="lblTestProtocol"><?php echo $_SESSION['testprotocol']?></label></h1>
						<div class="pure-u-1 pure-u-med-1-2">
			                <label for='zipcode'>Product Name</label>
			                <input type='text' id="txtPoductName" name="txtProductName"  placeholder="Product Name" parsley-required="true" />
			            </div>
		            
			            <div class="pure-u-1 pure-u-med-1-2">
			                <label for='productomodel'>Product Model</label>
			                <input type='text' id="txtProductModel" name="txtProductModel" placeholder="Product Model" parsley-required="true"/>
			            </div>
					</legend>
					
		            <legend>
		            	<h3 style="color: #fff">Package Dimensions/Weight</h3>
		            	<div class="pure-u-1 pure-u-med-1-2">
			                <input type="button" class="pure-button pure-input-2-3 pure-button-primary btn-lg" style="margin-top: 10px; margin-bottom: 10px;" name="english" id="english" value="English Units" disabled="true" />
	         				<input type="button" class="pure-button  pure-input-2-3 pure-button-primary btn-lg" style="margin-bottom: 20px;" name="metric" id="metrics" value="Metric Units" />
		            	</div>
		            	
			            <div class="row">
	  						<div class="col-md-3"><label for="LengthLabel">Length </label><input type="text" name="length" id="length" value="" placeholder="inches" parsley-required="true"></div>
	  						<div class="col-md-3"><label for="widthLabel"> Width </label><input type="text" name="width" id="width" value="" placeholder="inches" parsley-required="true"></div>
				            <div class="col-md-3"><label for="heightLabel"> Height </label><input type="text" name="height" id="height" value="" placeholder="inches" parsley-required="true"></div>
			           		<div class="col-md-3"><label for="weightLabel">Weight </label><input type="text" name="weight" id="weight" value="" placeholder="lbs" parsley-required="true"></div>
			           		<input type="hidden" value="true" name="measureType" id="measureType" />
			           	</div>
		            </legend>
		            
		            <legend>
		            	<h3 style="color: #fff">Other Information</h3>
		            	<div class="pure-u-1 pure-u-med-1-2">
		            		<label for='lblNumberOfSamples'>Number of Samples</label>
			                <input type='text' name="txtNumOfSamples" placeholder="Number of Samples" parsley-required="true"/>
		            	</div>
		            	
		            	<div class="pure-u-1 pure-u-med-1-2">
		            		<label for="lblComment">Comment(s):</label>
			                <textarea name="txtComment" class="form-control" rows="4" placeholder="Write a comment..."></textarea>
		            	</div>
		            </legend>
		            
		            
		    	<button type="submit" class="pure-button pure-button-primary btn-lg" style="margin-top: 30px; margin-bottom: 30px;" name="create">Send Test Request to Lab</button>
		    </fieldset>
		    <script>
				$( '#metrics' ).click(function() {
					  $(this).prop("disabled",true);
					  $('#english').removeAttr("disabled");
					  $( "#measureType" ).val("false");
				});
				
				$( '#english' ).click(function() {
					  $(this).prop("disabled",true);
					  $('#metrics').removeAttr("disabled");
					  $( "#measureType" ).val("true");
				});
			</script>
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

$( "#english" ).click(function() {
  $('#length').attr("placeholder", "inches");
  $('#width').attr("placeholder", "inches");
  $('#height').attr("placeholder", "inches");
  $('#weight').attr("placeholder", "lbs");
});

$( "#metrics" ).click(function() {
   $('#length').attr("placeholder", "mm");
  $('#width').attr("placeholder", "mm");
  $('#height').attr("placeholder", "mm");
  $('#weight').attr("placeholder", "kg");
});

</script>





</body>
</html>
