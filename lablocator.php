<?php
	//start the session
 	session_start();
	
 	//include any required libraries/classes
	require_once "Classes/Database.class.php";
	//include email class
	include "Classes/class.phpmailer.php"; // include the class name
 	
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
<link rel="stylesheet" type="text/css" href="css/map.css" />

</head>
<body style="background: #00874f">
	
<div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
    	
        <a class="pure-menu-heading" href="index.html"><img src="images/istalogo.jpg" alt="ISTA Logo" /></a>
    </div>
</div>

<div class="splash">
	     <div id="store-locator-container">
      <div id="page-header">
        <h1>Using Chipotle as an Example</h1>
        <p>I used locations around Minneapolis and the southwest suburbs. So, for example, Edina, Plymouth, Eden Prarie, etc. would be good for testing the functionality. 
        You can use just the city as the address - ex: Edina, MN.</p>
      </div>
      
      <div id="form-container">
        <form id="user-location" method="post" action="#">
            <div id="form-input">
              <label for="address">Enter Address or Zip Code:</label>
              <input type="text" id="address" name="address" />
             </div>
            
            <button id="submit" type="submit">Submit</button>
        </form>
      </div>

      <div id="map-container">
        <div id="loc-list">
            <ul id="list"></ul>
        </div>
        <div id="map"></div>
      </div>
    </div>
</div> <!--END-->

<div class="header" style="background: #00874f">
	
    <!--<div class="footer l-box is-center">
        View the source of this layout to learn more. Made with love by the YUI Team.
    </div>-->

</div>

    <script src="js/handlebars-v1.3.0.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="js/jquery.storelocator.js"></script>
      <script>
        $(function() {
          $('#map-container').storeLocator({'dataType': 'xml', 'dataLocation': 'locations.xml'});
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
