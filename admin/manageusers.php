<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/db_connect.php';
include_once '../../includes/register.inc.php';
 
sec_session_start();

$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Admin</title>
        <link rel="stylesheet" media="screen and (min-device-width: 668px)" type="text/css" href="../css/style.css" />
    	<link rel="stylesheet" media="screen and (max-device-width: 667px)" type="text/css" href="../css/mobile.css" />
		<meta name="keywords" content="Arlen Education Tutoring" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<meta name="viewport" content="user-scalable=no"/>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/menu.js"></script>
		<script type="text/JavaScript" src="../js/forms.js"></script>
		<script type="text/JavaScript" src="../js/sha512.js"></script> 
		<link rel="shortcut icon" href="../images/favicon.ico">
    </head>
    <body>
        <?php if (login_check($mysql) == 5) : ?>
            <!--Open the page-->
            <div id="main">
				<div id="header">
					<div id="title">
						<a href = "../index.php"><img src="../images/logo.png"/></a>
					</div>
					<div id="menubar">
						<ul id="menu">
							<li><a href="home.php">HOME</a></li>
							<li class="current"><a href="manageusers.php">MANAGE USERS</a></li>
							<li><a href="../includes/logout.php">LOG OUT</a></li>
						</ul>
					</div>
					  
					<div id = "menubutton">
						<img src="../images/menuwhite.png" onmouseover="this.src='../images/menublue.png'" onmouseout="this.src='../images/menuwhite.png'"/>
					</div>
			
				</div>
		
				<div id="dropdown">
					<ul id="dropmenu">
						<li><a href="home.php">HOME</a></li>
						<li class="current"><a href="manageusers.php">MANAGE USERS</a></li>
						<li><a href="../includes/logout.php">LOG OUT</a></li>
					</ul>
				</div>
		
				<!-- Content -->
				<div id="site_content">
					<div id="maincontent">
						<div id="sidebar">
							<ul id="sidemenu">
								<li class="current createusers"><a>Create</a></li>
							</ul>
						</div><div id="sidecontent">
							<div class="createusers">
								<h1><?php echo $error; ?></h1>
									<div id="create_form">
										<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
												method="post" 
												name="registration_form"
												class="basic-grey">
											<!--Username: <input type='text' name='username' id='username' /><br>-->
											<label for="email">Email: </label>
											<input type="text" name="email" id="email" />
											<label for="password">Password: </label>
											<input type="password" name="password" id="password"/>
											<label for="confirmpwd">Confirm Password: </label>
											<input type="password" name="confirmpwd" id="confirmpwd" />
											<label for="type">User Level</label>
											<select id="type" name="type">
												<option value="1">Applicant</option>
												<option value="2">Tutor</option>
												<option value="3">Client</option>
												<option value="4">User</option>
												<option value="5">Admin</option>
											</select>
											<input type="button" value="Create User" class="button" style="margin-left: 205px" 
												   onclick="return regformhash(this.form,
																   this.form.email,
																   this.form.password,
																   this.form.confirmpwd);" /> 
										</form>
									</div>
							</div>
						</div>
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

        <?php else : 
        	header('Location: ../login.php');
        	endif; 
        ?>
    </body>
</html>