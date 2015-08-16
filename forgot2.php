<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();

$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
$userid = filter_input(INPUT_GET, 'x3cb2st', $filter = FILTER_SANITIZE_STRING);

if($userid > 0){
	$sql = "SELECT `ID`, `Question` FROM `Security Answers` WHERE UserID = ? LIMIT 2";
	if($stmt = $mysql->prepare($sql)){
		$stmt->bind_param('i',$userid);
		$stmt->execute();
		$stmt->bind_result($id, $question);
		$questions = array();
		while($stmt->fetch()){
			$questions[] = $question;
			$ids[] = $id;
		};
		$stmt->close();
	}else{
		//No questions
	}
}else{
	//No userid
}


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
        		<div id="forgot_form">
        		<p style="max-width: 900px; margin-left: auto; margin-right:auto; text-align: center; color: #FF0000"><?php echo $error; ?></p>
        		<form id="loginform" action="includes/process_forgot.php" method="post" name="login_form" class="basic-grey">                      
            		<input name="questionid1" type="text" style="display:none" value="<?php echo $ids[0]; ?>"/>
            		<input name="questionid2" type="text" style="display:none" value="<?php echo $ids[1]; ?>"/>
            		
            		<label for="answer1"><?php echo $questions[0]; ?></label>
        			<input type="text" name="answer1" id="answer1" placeholder="Your Answer"/>
        			
        			<label for="answer2"><?php echo $questions[1]; ?></label>
        			<input type="text" name="answer2" id="answer2" placeholder="Your Answer"/>
            	
            		<input type="submit" id="submit" class="button" value="Enter" " />
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
    </body>
</html>