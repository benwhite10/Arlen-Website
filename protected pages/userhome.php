<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Admin</title>
        <link rel="stylesheet" media="screen and (min-device-width: 668px)" type="text/css" href="css/style.css" />
    	<link rel="stylesheet" media="screen and (max-device-width: 667px)" type="text/css" href="css/mobile.css" />
		<meta name="keywords" content="Arlen Education Tutoring" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<meta name="viewport" content="user-scalable=no"/>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/menu.js"></script>
		<link rel="shortcut icon" href="images/favicon.ico">
    </head>
    <body>
        <?php if (login_check($mysql) == 4) : ?>
            <!--Open the page-->
            <div id="main">
				<div id="header">
					<div id="title">
						<a href = "index.php"><img src="images/logo.png"/></a>
					</div>
					<div id="menubar">
						<ul id="menu">
							<li class="logout"><a href="includes/logout.php">LOG OUT</a></li>
						</ul>
					</div>
					  
					<div id = "menubutton">
						<img src="images/menuwhite.png" onmouseover="this.src='images/menublue.png'" onmouseout="this.src='images/menuwhite.png'"/>
					</div>
			
				</div>
		
				<div id="dropdown">
					<ul id="dropmenu">
						<li class="logout"><a href="includes/logout.php">LOG OUT</a></li>
					</ul>
				</div>
		
				<!-- Content -->
				<div id="site_content">
					<div id="maincontent">
						<h1>User</h1>
					</div>
				</div>
				<!-- End of content -->
						
				<div id="footer" style="margin-top: 1000px">
					<div id = "footercontainer">
						<div class = "footersection">
							<h1>Arlen Education</h1>
							<p>78 Pall Mall, St James, London SW1Y 5ES</p>
							<div class = "footerbuttons">
								<a id = "facebook" href="https://www.facebook.com"></a>
								<a id = "googleplus" href="ttps://plus.google.com/"></a>
								<a id = "linkedin" href="https://www.linkedin.com"></a>
							</div>
						</div><div class = "footersection footersection_right">
							<p>Copyright 2015, Arlen Education Ltd.</p>
							<p>Designed by Arlen Education Technology</p>
							<p>Registered Company No: 019203309</P>
							<p>VAT Registered</p>
						</div>
					</div>
				</div>

			</div>

        <?php else : ?>
            <!-- Not correct log in -->
            <p><span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.</p>
        <?php endif; ?>
    </body>
</html>