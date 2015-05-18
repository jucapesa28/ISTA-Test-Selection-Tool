<?php
	session_start();
	
	if (!isset($_SESSION['emailaddress'])) {
		header("location: login.php");
		}
	
	if(isset($_POST['test-selected'])){
		
	 $testProtocolsArray = $_POST['testProtocol'];
		
		  if(empty($testProtocolsArray)) 
		  {
		    echo "<div class='error-validation'>*You must have to select at least one test protocol to continue.</div>";
		  } 
		  else
		  {
		    $N = count($testProtocolsArray);
			
		    for($i=0; $i < $N; $i++)
		    {
		      $_SESSION['testprotocol'] .= $testProtocolsArray[$i] . ". ";
		    }
			
			header("location: create.php");
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

</head>
<body style="background: #00874f">
	
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
			      <div class="modal-body" style="text-align: left">
			        	<span>
			                 <h5><strong>Package type: </strong></h5>ISTA® has developed specialized test protocols that includes test for package type like unitized 
			                 loads and reusable containers. Please define your package type by selecting one of the package types from the drop down list.<br /><br />
			                 <h5><strong>Individual Pkg up to 150 lbs: </strong></h5>Individual packaged-products weighing 150 lbs (68 kgs) or less<br /><br />
			                 <h5><strong>Individual Pkg over to 150 lbs: </strong></h5>Individual packaged-products weighing more than 150 lbs (68 kgs)<br /><br />
			                 <h5><strong>Unitized: </strong></h5>A single or number of products packaged in a specific manner and capable of being handled and shipped as a unit.<br /><br />
			                 <h5><strong>Bulk: </strong></h5>Bulk loading is shipping products in large amounts in one transport container and because of their size or weight, special handling equipments or mechanical means are required.<br /><br />
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
			      <div class="modal-body" style="text-align: left">
			        <span>
			                 <h5><strong>Distribution type: </strong></h5>ISTA® has developed specialized test protocols that includes test for specific distribution modes such as parcel delivery 
			                 and bulk shipments. Please define the distribution mode through which your packaged-products move in the distribution environment by selecting one of the 
			                 specific distribution modes from the drop down list.<br /><br />
			                 <h5><strong>Any: </strong></h5>Here goes some text Here goes some text Here goes some text<br /><br />
			                 <h5><strong>Specialized Furniture: </strong></h5>Furniture that is heavy, bulky and has a fragile side and special equipment required for handling. ISTA 2C test is designed to evaluate the performance of furniture goods in a container.<br /><br />
			                 <h5><strong>Parcel Delivery: </strong></h5>Parcel delivery is the shipping of individual packages weighing less than 150 lbs. as a single shipment.<br /><br />
			                 <h5><strong>Less-Than-Truckload Delivery: </strong></h5>Less-than-truckload delivery refers to any shipment that does not fill the entire truck. ISTA 2F covers testing of individual packaged products, including palletized loads when prepared for less-than-truckload shipment.<br /><br />
			                 <h5><strong>Distribution Center to Retail: </strong></h5>Individual packaged product stored in a distribution center shipped to retail facility. ISTA 3F test specializes in testing of non-unitized load transported from distribution center (DC) to retail.<br /><br />
			                 <h5><strong>Various: </strong></h5>Distribution involves various combinations of distribution methods. ISTA allows ISTA members to create a test protocol that will suit their own particular purposes and applications.</span>
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
			</div>
			
		    <fieldset>
		    
		    <legend>	
			    <div style="color:#fff">
		    		<i class="fa fa-search fa-4x"></i><h2 style="color:#fff">Find Your Test Protocol</h2>
		    	</div>
		    	 <p class="splash-subhead">
	            	Hover over the test protocols to see a brief overview. Click on the links if you would like to go to the Test Protocol PDF for more details. Select the appropriate test protocol.
	        	</p>
        </legend>
        	
        <div class="pure-form pure-form-stacked" >
        	<legend>
        		<div class="pure-u-1 pure-u-med-1-2">
		                <label for='country'>Package Type</label><a href="#" data-toggle="modal" data-target="#PackageTypeHelp" style="color:#fff; font-size: small; text-transform: none"><i class="fa fa-question-circle"></i> About Package Types</a>
		                <select class="pure-input-1-2" id="PackageTypeName" name="PackageTypeName" onchange="enableDropdown();" style="width: 98%" parsley-required="true">
		                	<option value="-1">--Select one--</option>
		                    <option value="Individual Pkg up to 150 lbs">Individual Pkg up to 150 lbs</option>
		                    <option value="Individual Pkg over 150 lbs">Individual Pkg over 150 lbs</option>
		                    <option value="Unitized">Unitized</option>
		                    <option value="Bulk">Bulk</option>
		                </select>
		       </div>
		       <div class="pure-u-1 pure-u-med-1-2">
		                <label for='country'>Distribution Type</label><a href="#" data-toggle="modal" data-target="#ProductModelHelp" style="color:#fff; font-size: small; text-transform: none"><i class="fa fa-question-circle"></i> About Distribution Types</a>
		                <select class="pure-input-1-2" id="DistributionTypeName" name="DistributionTypeName" onchange="displayProtocols();" disabled="disabled" style="width: 98%" parsley-required="true">
		                	<option value="-1">--Select one--</option>
		                    <option value="Any">Any</option>
		                    <option value="Specialized Furniture">Specialized Furniture</option>
		                    <option value="Parcel Delivery">Parcel Delivery</option>
		                    <option value="Less Than Truckload Delivery">Less Than Truckload Delivery</option>
		                    <option value="Distribution Center to Retail">Distribution Center to Retail</option>
		                    <option value="ISTA Member Tests">ISTA Member Tests</option>
		                    <option value="European Consumer Goods">European Consumer Goods</option>
		                    <option value="Thermal Testing of Insulated Shipping Containers">Thermal Testing of Insulated Shipping Containers</option>
		                </select>
		       </div>
        	</legend>
		 </div>

		<form class="pure-form pure-form-stacked" id='testselection' action='testselection.php' method='post' parsley-validate>
					<table class="tests-table table-responsive">
					    <tr>
					        <th rowspan="3">
					            Distribution Type
					        </th>
					        <td id="tableHeader" colspan="4">
					            Package Type
					        </td>
					    </tr>
					    <tr>
					        <td id="subHeader" colspan="2">
					            Individual Packages
					        </td>
					        <td id="subHeader" rowspan="2">
					            Unitized
					        </td>
					        <td id="subHeader" rowspan="2">
					            Bulk
					        </td>
					    </tr>
					    <tr>
					        <td id="subHeader">
					            up to 150 lbs. (68 kg)
					        </td>
					        <td id="subHeader">
					            over 150 lbs. (68 kg)
					        </td>
					    </tr>
					    <tr>
					        <td id="tableCol">Any</td>
					        <td id="cell1">
					            <div class="tooltipTestCharts">
					                <input type="radio" name="testProtocol[]" value="1A" /><a href="http://www.ista.org/forms/1Aoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">1A
					                    <span>
					                        <img src="images/1A.png" alt="test" />
					                    </span></a><br />
					
					                    <input type="radio" name="testProtocol[]" value="1C" /><a href="http://www.ista.org/forms/1Coverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">1C
					                    <span>
					                        <img src="images/1C.png" alt="test" />
					                    </span></a><br />
					
					                    <input type="radio" name="testProtocol[]" value="1G" /><a href="http://www.ista.org/forms/1Goverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">1G
					                    <span>
					                        <img src="images/1G.png" alt="test" />
					                    </span></a><br />
					
					                    <input type="radio" name="testProtocol[]" value="2A" /><a href="http://www.ista.org/forms/2Aoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">2A
					                    <span>
					                        <img src="images/2A.png" alt="test" />
					                    </span></a><br />
					                    
					                    <input type="radio" name="testProtocol[]" value="4AB" /><a href="http://www.ista.org/forms/4ABoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">4AB
					                    <span>
					                        <img src="images/4AB.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell2">
					            <div class="tooltipTestCharts">
					                    <input type="radio" name="testProtocol[]" value="1B" /><a href="http://www.ista.org/forms/1Boverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">1B
					                    <span>
					                        <img src="images/1B.png" alt="test" />
					                    </span></a><br />
					
					                    <input type="radio" name="testProtocol[]" value="1D" /><a href="http://www.ista.org/forms/1Doverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">1D
					                    <span>
					                        <img src="images/1D.png" alt="test" />
					                    </span></a><br />
					
					                    <input type="radio" name="testProtocol[]" value="1H" /><a href="http://www.ista.org/forms/1Hoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">1H
					                    <span>
					                        <img src="images/1H.png" alt="test" />
					                    </span></a><br />
					
					                    <input type="radio" name="testProtocol[]" value="2B" /><a href="http://www.ista.org/forms/2Boverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">2B
					                    <span>
					                        <img src="images/2B.png" alt="test" />
					                    </span></a><br />
					                    
					                    <input type="radio" name="testProtocol[]" value="4AB" /><a href="http://www.ista.org/forms/4ABoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">4AB
					                    <span>
					                        <img src="images/4AB.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell3">
					            <div class="tooltipTestCharts">
					                <input type="radio" name="testProtocol[]" value="1E" /><a href="http://www.ista.org/forms/1Eoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">1E
					                <span>
					                        <img src="images/1E.png" alt="test" />
					                    </span></a><br />
					
					                    <input type="radio" name="testProtocol[]" value="3E" /><a href="http://www.ista.org/forms/3Eoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">3E
					                    <span>
					                        <img src="images/3E.png" alt="test" />
					                    </span></a><br />
					                    
					                     <input type="radio" name="testProtocol[]" value="4AB" /><a href="http://www.ista.org/forms/4ABoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">4AB
					                    <span>
					                        <img src="images/4AB.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell4">
					            <div class="tooltipTestCharts">
					               <input type="radio" name="testProtocol[]" value="3H" /><a href="http://www.ista.org/forms/3Hoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">3H
					                    <span>
					                        <img src="images/3H.png" alt="test" />
					                    </span></a><br />
					                <input type="radio" name="testProtocol[]" value="4AB" /><a href="http://www.ista.org/forms/4ABoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">4AB
					                    <span>
					                        <img src="images/4AB.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					    </tr>
					    <tr>
					        <td id="tableCol">Specialized Furniture</td>
					        <td id="cell5">
					            <div class="tooltipTestCharts">
					                <input type="radio" name="testProtocol[]" value="2C" /><a href="http://www.ista.org/forms/2Coverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">2C
					                    <span>
					                        <img src="images/2C.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell6">
					            <div class="tooltipTestCharts">
					                <input type="radio" name="testProtocol[]" value="2C" /><a href="http://www.ista.org/forms/2Coverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">2C
					                    <span>
					                        <img src="images/2C.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell7">Not Applicable</td>
					        <td id="cell8">Not Applicable</td>
					    </tr>
					    <tr>
					        <td id="tableCol">Parcel Delivery</td>
					        <td id="cell9">
					            <div class="tooltipTestCharts">
					                    <input type="radio" name="testProtocol[]" value="3A" /><a href="http://www.ista.org/forms/3Aoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">3A
					                    <span>
					                        <img src="images/3A.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell10">Not Applicable</td>
					        <td id="cell11">Not Applicable</td>
					        <td id="cell12">Not Applicable</td>
					    </tr>
					    <tr>
					        <td id="tableCol">LTL (Less-Than-Truckload)</td>
					        <td id="cell13">
					            <div class="tooltipTestCharts">
					                    <input type="radio" name="testProtocol[]" value="3B" /><a href="http://www.ista.org/forms/3Boverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">3B
					                    <span>
					                        <img src="images/3B.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell14">
					            <div class="tooltipTestCharts">
					                    <input type="radio" name="testProtocol[]" value="3B" /><a href="http://www.ista.org/forms/3Boverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">3B
					                    <span>
					                        <img src="images/3B.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell15">
					            <div class="tooltipTestCharts">
					                    <input type="radio" name="testProtocol[]" value="3B" /><a href="http://www.ista.org/forms/3Boverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">3B
					                    <span>
					                        <img src="images/3B.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell16">Not Applicable</td>
					    </tr>
					    <tr>
					        <td id="tableCol">Distribution Center to Retail</td>
					        <td id="cell17">
					            <div class="tooltipTestCharts">
					                <input type="radio" name="testProtocol[]" value="3F" /><a href="http://www.ista.org/forms/3Foverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">3F
					                    <span>
					                        <img src="images/3F.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell18">Not Applicable</td>
					        <td id="cell19">Not Applicable</td>
					        <td id="cell20">Not Applicable</td>
					    </tr>
					    <tr>
					        <td id="tableCol">ISTA Member Tests</td>
					        <td id="cell21">
					            <div class="tooltipTestCharts">
					                    <input type="radio" name="testProtocol[]" value="6-FEDEX-A" /><a href="http://images.fedex.com/us/services/pdf/PKG_Testing_Under150Lbs.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">6-FEDEX-A
					                    <span>
					                        <img src="images/6A.png" alt="test" />
					                    </span></a><br />
					
					                    <input type="radio" name="testProtocol[]" value="6-SAMSCLUB" /><a href="http://www.ista.org/forms/6SAMSoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">6-SAMSCLUB
					                    <span>
					                        <img src="images/6-SAMSCLUB.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell22">
					            <div class="tooltipTestCharts">
					                    <input type="radio" name="testProtocol[]" value="6-FEDEX-B" /><a href="http://images.fedex.com/us/services/pdf/PKG_Testing_Over150Lbs.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">6-FEDEX-B
					                    <span>
					                        <img src="images/6B.png" alt="test" />
					                    </span></a><br />
					
					                    <input type="radio" name="testProtocol[]" value="6-SAMSCLUB" /><a href="http://www.ista.org/forms/6SAMSoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">6-SAMSCLUB
					                    <span>
					                        <img src="images/6-SAMSCLUB.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell23">
					            <div class="tooltipTestCharts">
					                    <input type="radio" name="testProtocol[]" value="6-SAMSCLUB" /><a href="http://www.ista.org/forms/6SAMSoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">6-SAMSCLUB
					                    <span>
					                        <img src="images/6-SAMSCLUB.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell24">
					            <div class="tooltipTestCharts">
					                <!--See Series was elimated to avoid confusions-->
					            </div>
					        </td>
					    </tr>
					    <tr>
					        <td id="tableCol">European Consumer Goods</td>
					        <td id="cell25">
					            <div class="tooltipTestCharts">
					                <input type="radio" name="testProtocol[]" value="3K" /><a href="http://www.ista.org/forms/3Koverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">3K
					                    <span>
					                        <img src="images/3K.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell26">Not Applicable</td>
					        <td id="cell27">Not Applicable</td>
					        <td id="cell28">Not Applicable</td>
					    </tr>
					    <tr>
					        <td id="tableCol">Thermal Testing of Insulated Shipping Containers</td>
					        <td id="cell29">
					            <div class="tooltipTestCharts">
					                <input type="radio" name="testProtocol[]" value="7E" /><a href="http://www.ista.org/forms/7Eoverview.pdf" target="_blank" parsley-trigger="change" parsley-group="mygroup" parsley-maxcheck="1">7E
					                    <span>
					                        <img src="images/7E.png" alt="test" />
					                    </span></a>
					            </div>
					        </td>
					        <td id="cell30">Not Applicable</td>
					        <td id="cell31">Not Applicable</td>
					        <td id="cell32">Not Applicable</td>
					    </tr>
					</table>  
					
		        <button type="submit" class="pure-button pure-button-primary btn-lg" style="margin-top: 30px; margin-bottom: 30px;" name="test-selected">Create Test Request</button>
		    </fieldset>
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
