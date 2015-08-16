<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
sec_session_start();
$loginvalue = login_check($mysql)
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
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
    <script type="text/javascript" src="js/questionsformvalidation.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico">
</head>
    <body>
    <?php if($loginvalue == -1): ?>
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
						if ($loginvalue == true) {
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
					if ($loginvalue == true) {
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
        		<div id="create_form">
					<form id="questionform" action="" method="" accept-charset="UTF-8" class="basic-grey">	
						<label for="question1">Security Question 1:</label>
						<select id="question1" name="question1">
							<option value=''>-Question 1-</option>
							<?php
								$strSQL = "SELECT * FROM `Security Questions`";
								$stmt = $mysql->prepare($strSQL);
								$stmt->execute();
								 /* bind result variables */
								$stmt->bind_result($id, $question);
								/* fetch values */
								while ($stmt->fetch()) {
									echo "<option value='$id'>$question</option>";
								}
								$mysql->close;
							?>
						</select>
						<label for="answer1">Answer</label>
						<textarea name="answer1" id="answer1" placeholder="Your Answer Here"></textarea>
						<label for="question2">Security Question 2:</label>
						<select id="question2" name="question2">
							<option value=''>-Question 2-</option>
							<?php
								$strSQL = "SELECT * FROM `Security Questions`";
								$stmt = $mysql->prepare($strSQL);
								$stmt->execute();
								 /* bind result variables */
								$stmt->bind_result($id, $question);
								/* fetch values */
								while ($stmt->fetch()) {
									echo "<option value='$id'>$question</option>";
								}
								$mysql->close;
							?>
						</select>
						<label for="answer2">Answer</label>
						<textarea name="answer2" id="answer2" placeholder="Your Answer Here"></textarea>
						<input id="submit" type="submit" class="button" value="Submit Form"/>
					</form>
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
	<?php else : 
		header('Location: ../login.php');
		endif; 
	?>   
    </body>
</html>