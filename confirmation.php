<?php
	session_start();

	if (!isset($_SESSION['emailaddress'])) {
		header("location: login.php");
		}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>ISTA - Test Selection Tool</title>
    <link rel="stylesheet" media="screen" href="css/Site.css" />
    <script src="Scripts/modernizr-1.7.min.js" type="text/javascript"></script>
    <script src="Scripts/dropdownMenu.js" type="text/javascript"></script>
    <script src="Scripts/dimensionFields.js" type="text/javascript"></script>
</head>
<body>
<div class="pagediv">
    <div class="page">
        <div id="logoTop">
            <a href="http://www.ista.org"><img src="images/istalogo.jpg" alt="ISTA Logo" /></a>
        </div>
            <header>
                <div id="title">
                    <h1><img src="images/packageIcon.png" alt="logo" /> Test Selection Tool</h1>
                </div>
                <!--<nav>
                    <ul id="menu">
                        <li>@Html.ActionLink("Test Selection Tool", "TestSelection2", "TestSelection")</li> 
                        <li>@Html.ActionLink("Test Request", "Create", "TestSelection")</li> 
                    </ul>
                </nav>-->
            </header>

            <div id="main" style="margin: 9% auto">
				<h2><img src="images/check_mark.png" height="32px" width="32px" alt="back" /> Your Test Request has been sent successfully!!</h2>
				<p>
				    <a href="testselection.php"><img src="images/back.png" height="32px" width="32px" alt="back" /> Back to Test Selection Tool</a><br /><br />
				</p>
            </div>
            <footer>
            </footer>
        </div>
        </div>
</body>
</html>