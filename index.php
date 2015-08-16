<?php
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	sec_session_start(); // Our custom secure way of starting a php session
	
	$strSQL = "SELECT `Description`, `Text` FROM `Website Text` WHERE `Page` = 'Home'";
	$stmt = $mysql->prepare($strSQL);
	$stmt->execute();
	 /* bind result variables */
	$stmt->bind_result($name, $text);
	/* fetch values */
	while ($stmt->fetch()) {
		switch ($name){
			case 'Title':
				$title = $text;
				break;
			case 'Left':
				$left = $text;
				break;
			case 'Right':
				$right = $text;
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
    <meta name="viewport" content="user-scalable=no"/>
    <link rel="stylesheet" media="screen and (min-device-width: 668px)" type="text/css" href="css/style.css" />
    <link rel="stylesheet" media="screen and (max-device-width: 667px)" type="text/css" href="css/mobile.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/menu.js"></script>
    <script type="text/javascript" src="js/fader.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>
    <div id="main">
        <div id="header">
            <div id="title">
                <a href = "index.php"><img src="images/logo.png"/></a>
                <!--<h1>Arlen Education</h1>-->
            </div>
            <div id="menubar">
                <ul id="menu">
                    <li class="current"><a href = "index.php">HOME</a></li>
                    <li><a href = "aboutus.php">ABOUT</a></li>
                    <li><a href = "tutoring.php">TUTORING</a></li>
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
                <li><a href = "tutoring.php">TUTORING</a></li>
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
			<div id="slideshowcontainer">
				<div>
					<img src="images/Mercury.jpg"/>
					<h1>and this....</h1>
				</div>
				<div>
					<img src="images/ThomQuad.jpg"/>
					<h1> And This </h1>
				</div>
				<div>
					<img src="images/SouthFront2.png"/>
					<h1>This is a test</h1>
				</div>
			</div>
			
			<span id = "nextbutton" style = "display: none;">
			</span>
			
			<span id = "previousbutton" style = "display: none;">
			</span>
			
			<!-- Mobile front image -->
			<img class="mobilehomeimage" u="image" src="images/university.jpg" />
			
            <div id="mainfrontcontent">
            	<!-- Blurb -->
            	<div id="hometitle">
                    <h1><?php echo $title ?></h1>
                </div>
                <div class="about">
                	<p><?php echo $left ?></p>
            	</div><div class="about about_right">
                	<?php echo $right ?>
                </div>
                <div class="homephotoscontainer">
                    <div class="homephotowrapper">
                        <img src="images/Mercury.jpg"/>
                        <div style="text-align:center">
                            <a href="aboutus.php">About</a>
                        </div>
                    </div><div class="homephotowrapper homephotowrapper_center">
                        <img src="images/ThomQuad.jpg"/>
                        <div style="text-align:center">
                            <a href="tutoring.php">Tutoring</a>
                        </div>
                    </div><div class="homephotowrapper">
                        <img src="images/SouthFront2.png"/>
                        <div style="text-align:center">
                            <a href="contact.php">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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