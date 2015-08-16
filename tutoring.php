<?php
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	sec_session_start(); // Our custom secure way of starting a php session
	
	$strSQL = "SELECT `Description`, `Text` FROM `Website Text` WHERE `Page` = 'Tutoring'";
	$stmt = $mysql->prepare($strSQL);
	$stmt->execute();
	 /* bind result variables */
	$stmt->bind_result($name, $text);
	/* fetch values */
	while ($stmt->fetch()) {
		switch ($name){
			case 'Introduction':
				$intro = $text;
				break;
			case '11+/13+':
				$eleven = $text;
				break;
			case 'GCSE':
				$gcse = $text;
				break;
			case 'Sixth Form':
				$sixth = $text;
				break;
			case 'University Applications':
				$univ = $text;
				break;
			default:
				break;
		}
	}
	$mysql->close;
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Arlen Education</title>
    <meta name="description" content="Arlen Education" />
    <meta name="keywords" content="Arlen Education Tutoring" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <link rel="stylesheet" media="screen and (min-device-width: 668px)" type="text/css" href="css/style.css" />
    <link rel="stylesheet" media="screen and (max-device-width: 667px)" type="text/css" href="css/mobile.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/menu.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>

    <div id="main">
        <div id="header">
            <div id="title">
                <a href = "index.php"><img src="images/logo.png"/></a>
            </div>
            <div id="menubar">
                <ul id="menu">
                    <li><a href = "index.php">HOME</a></li>
                    <li><a href = "aboutus.php">ABOUT</a></li>
                    <li class="current"><a href = "tutoring.php">TUTORING</a></li>
                    <li><a href = "contact.php">CONTACT</a></li>
                    <?php
						if (login_check($mysql) == true) {
							echo "<li><a href = 'includes/portalredirect.php'>PORTAL</a></li>";
						}else {
							echo "<li><a href = 'login.php'>LOGIN</a></li>";
						}
					?>
                </ul>
            </div>
                      
            <div id = "menubutton">
            	<img src="images/menuwhite.png" onmouseover="this.src='images/menublue.png'" onmouseout="this.src='images/menuwhite.png'"/>
            </div>
            
        </div>
        
        <div id="dropdown">
        	<ul id="dropmenu">
                <li><a href = "aboutus.php">ABOUT</a></li>
                <li class="current"><a href = "tutoring.php">TUTORING</a></li>
                <li><a href = "contact.php">CONTACT</a></li>
                <?php
					if (login_check($mysql) == true) {
						echo "<li><a href = 'includes/portalredirect.php'>PORTAL</a></li>";
					}else {
						echo "<li><a href = 'login.php'>LOGIN</a></li>";
					}
				?>
            </ul>
        </div>
		
		<!-- Content -->
        <div id="site_content">
        	<div id="maincontent">
        		<div id="sidebar">
        			<ul id="sidemenu">
        				<li class="current"><a>Introduction</a></li>
        				<li><a>11+ / 13+</a></li>
        				<li><a>GCSE</a></li>
        				<li><a>Sixth Form</a></li>
        				<li><a>University Applications</a></li>
        			</ul>
        		</div><div id="sidecontent">
        			<div class="introduction">
            			<h1>Introduction</h1>
            			<p><?php echo $intro ?></p>
            		</div>
            
            		<div class="prep" style="display:none">
            			<h1>11+ / 13+</h1>
            			<p><img src="images/Ben2.png" width="200px" height="300px" style="float:right; margin-left: 20px"><?php echo $eleven ?>
            			</p>
            		</div>
            		
            		<div class="gcse" style="display:none">
            			<h1>GCSE</h1>
            			<p><?php echo $gcse ?></p>
            		</div>
            		
            		<div class="alevel" style="display:none">
            			<h1>Sixth Form</h1>
            			<p><?php echo $sixth ?></p>
            		</div>
            		
            		<div class="university" style="display:none">
            			<h1>University Applications</h1>
            			<p><?php echo $univ ?></p>
            		</div>
        		</div>
        	</div>
        </div>
        <!-- End of site content-->
        
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

</body>
</html>