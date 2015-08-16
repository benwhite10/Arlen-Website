<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
 
sec_session_start();
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
							<li><a href="manageusers.php">MANAGE USERS</a></li>
							<li class="current"><a href="../includes/logout.php">LOG OUT</a></li>
						</ul>
					</div>
					  
					<div id = "menubutton">
						<img src="../images/menuwhite.png" onmouseover="this.src='../images/menublue.png'" onmouseout="this.src='../images/menuwhite.png'"/>
					</div>
			
				</div>
		
				<div id="dropdown">
					<ul id="dropmenu">
						<li><a href="home.php">HOME</a></li>
						<li><a href="manageusers.php">MANAGE USERS</a></li>
						<li class="current"><a href="includes/logout.php">LOG OUT</a></li>
					</ul>
				</div>
		
				<!-- Content -->
				<div id="site_content">
					<div id="maincontent">
						<form id="selectform" class="basic-grey" style="border: none">
							<label for="aa">Select Page</label>
							<select id="aa" name="aa" style="width: 300px"> 
								<option value="Home">Home</option>
								<option value="AboutUs">About Us</option>
								<option value="Tutoring">Tutoring</option>
							</select>
						</form>
						<script>
							$(document).ready(function(){
								var type = $('#aa').val();
								var str = "." + type;
								$('.Home').hide();
								$('.AboutUs').hide();
								$('.Tutoring').hide();
								$(str).show();
							});
							
							$('#aa').change(function(){
								var type = this.value;
								var str = "." + type;
								$('.Home').hide();
								$('.AboutUs').hide();
								$('.Tutoring').hide();
								$(str).show();
							});
						</script> 
						<div id="client_application_form">
        					<form id="clientapplicationform" action="runupdatewebsite.php" method="post" accept-charset="UTF-8" class="basic-grey">			
								<?php
									$strSQL = "SELECT * FROM `Website Text` ORDER BY `Page`";
									$stmt = $mysql->prepare($strSQL);
									$stmt->execute();
									 /* bind result variables */
									$stmt->bind_result($id, $page, $desc, $text);
									/* fetch values */
									while ($stmt->fetch()) {
										$trim = str_replace(' ', '', $page);
										echo "<label for=$id class=$trim>$page - $desc : </label>";
										echo "<textarea id=$id name=$id class=$trim>$text</textarea>";
									}
									$mysql->close;
								?>
								<input type="submit" name="submit" class="button" value="Submit Form" style="margin-left: 200px">
        					</form>
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