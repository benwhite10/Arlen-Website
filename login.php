<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();
 
if (login_check($mysql) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
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
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
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
                    <li><a href = "index.php">HOME</a></li>
                    <li><a href = "aboutus.php">ABOUT</a></li>
                    <li><a href = "tutoring.php">TUTORING</a></li>
                    <li><a href = "contact.php">CONTACT</a></li>
                    <?php
						if (login_check($mysql) == true) {
							echo "<li class='current'><a href = 'includes/portalredirect.php'>PORTAL</a></li>";
						}else {
							echo "<li class='current'><a href = 'login.php'>LOGIN</a></li>";
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
						echo "<li class='current'><a href = 'includes/portalredirect.php'>PORTAL</a></li>";
					}else {
						echo "<li class='current'><a href = 'login.php'>LOGIN</a></li>";
					}
				?>
            </ul>
        </div>
		
		
		<!-- Content -->
        <div id="site_content">
        	<div id="maincontent">
        		<div id="login_form">
        		
        		<?php
        		if (isset($_GET['error'])) {
            		echo '<p class="error">Error Logging In!</p>';
        		}
        		?> 
        		<p style="max-width: 900px; margin-left: auto; margin-right:auto; text-align: center; color: #FF0000"><?php echo $error; ?></p>
        		<form id="loginform" action="includes/process_login.php" method="post" name="login_form" class="basic-grey">                      
            		<label for="email">Email:</label>
        			<input type="email" name="email" id="email" placeholder="Your Email"/>
        			
            		<label for="password">Password: </label>
            		<input type="password" name="password" id="password" placeholder="Password"/>
            	
            		<input type="submit" id="submit" class="button" value="Login" onclick="formhash(this.form, this.form.password);" />
        		</form>
 				<div style="text-align:left; width:45%; display:inline-block; padding-left: 5%;">
					<a href="create.php">Create New Account</a> 
				</div><div style="text-align:right; width:45%; display:inline-block; padding-right: 5%">
					<a href="forgot1.php">Forgot Your Password?</a>
				</div>
				</div>
			</div>
		</div>
		<!--End Of Content-->
		
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