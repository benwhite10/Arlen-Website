<?php
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	sec_session_start(); // Our custom secure way of starting a php session
	
	$strSQL = "SELECT `Description`, `Text` FROM `Website Text` WHERE `Page` = 'About Us'";
	$stmt = $mysql->prepare($strSQL);
	$stmt->execute();
	 /* bind result variables */
	$stmt->bind_result($name, $text);
	/* fetch values */
	while ($stmt->fetch()) {
		switch ($name){
			case 'About Us Intro':
				$abintro = $text;
				break;
			case 'Meet Our Team':
				$abmeet = $text;
				break;
			case 'Kieron Short':
				$kshort = $text;
				break;
			case 'Kieron Long':
				$klong = $text;
				break;
			case 'Ben Short':
				$bshort = $text;
				break;
			case 'Ben Long':
				$blong = $text;
				break;
			case 'Svend Short':
				$sshort = $text;
				break;
			case 'Svend Long':
				$slong = $text;
				break;
			case 'Core Values':
				$core = $text;
				break;
			case 'Why Arlen':
				$why = $text;
				break;
			case 'Testimonials':
				$test = $text;
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
                    <li class="current"><a href = "aboutus.php">ABOUT</a></li>
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
                <li class = "current"><a href = "aboutus.php">ABOUT</a></li>
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
        	<div id="maincontent">
        		<div id="sidebar">
        			<ul id="sidemenu">
        				<li class="current aboutus"><a>About us</a></li>
        				<li><a class="values">Core values</a></li>
        				<li><a>Our Services</a></li>
        				<li><a>Testimonials</a></li>
        				<li><a>FAQs</a></li>
        			</ul>
        		</div><div id="sidecontent">
        			<div class="aboutus">
            			<h1>About us</h1>
            			<p><?php echo $abintro ?></p>
						<br>
            			<?php echo $abmeet ?>
            			<br>
            			<div class="profile">
            				<div class="photo kieron">
            					<img src="images/Keiron2.png" />
            				</div><div class="text">
            					<h2><b>Kieron Lomax</b></h2>
            					<p><?php echo $kshort ?></p>
            					<p class = "readmore"><i>Read More</i></p>
            					<p class = "extra"><?php echo $klong ?></p>
            					<p class = "extra"><i>Show Less</i></p>
            				</div>
            			</div>
            			<div class="profile">
            				<div class="photo ben">
            					<img src="images/Ben2.png" />
            				</div><div class="text">
            					<h2><b>Ben White</b></h2>
            					<p><?php echo $bshort ?></p>
            					<p class = "readmore"><i>Read More</i></p>
            					<p class = "extra"><?php echo $blong ?></p>
            					<p class = "extra"><i>Show Less</i></p>
            				</div>
            			</div>
            			<div class="profile">
            				<div class="photo svend">
            					
            				</div><div class="text">
            					<h2><b>Svend Larsen</b></h2>
            					<p><?php echo $sshort ?></p>
            					<p class = "readmore"><i>Read More</i></p>
            					<p class = "extra"><?php echo $slong ?></p>
            					<p class = "extra"><i>Show Less</i></p>
            				</div>
            			</div>
            		</div>
            		
            		<div class="values">
            			<?php echo $core ?>	
            		</div>
            		
            		<div class="whyarlen">
            			<?php echo $why ?>	
            		</div>
            		
            		<div class="testimonials">
            			<p><?php echo $test ?></p>
            		</div>
            		
            		<div class="faqs">
            			<h1 id="0" style="padding-top: 70px; margin-top: -70px;">FAQs</h1>
            			<ul id = "aboutlist">
                			<li><a href="#1">I’ve seen an advert for a private tutor charging £25 per hour, surely this is better value for money?</a></li>
                			<li><a href="#2">How do you select your tutors?</a></li>
                			<li><a href="#3">Why are you different to any other tutor agency?</a></li>
                			<li><a href="#4">As a client of Arlen Education, what will I receive?</a></li>
                		</ul>
                		<br>
            			<h2 id="1" style="padding-top: 70px; margin-top: -70px;">I’ve seen an advert for a private tutor charging £25 per hour, surely this is better value for money?</h2>
            			<p>On first impressions, £25 per hour does certainly seem a cheaper alternative. However, there is currently no regulation or industry standards in place in the UK for private tutors, anyone is able to set up as an “expert” tutor with no prior experience or specialist subject knowledge. Arlen Education prides itself on representing only the leading tutors in the UK. We operate a highly selective and very intense selection procedure, ensuring that every tutor we represent is able to deliver a service above and beyond our clients’ requirements and expectations. All our tutors are subject to the following: an enhanced DBS (CRB) disclosure form, qualification checks, a two stage interview process with all three of our founding partners and frequent lesson observation and feedback (the only agency in the UK offering this service!)</p>
            			<h6><a href="#0">Back to top</a></h6>
            			<br><br>
            			<h2 id="2" style="padding-top: 70px; margin-top: -70px;">How do you select your tutors?</h2>
            			<p>All out tutors are selected according to Arlen’s 3 core values:<p>
            			<p><b>Excellence</b> – our tutors are all experts in their chosen field with qualifications from some of the leading Universities in the world</p>
            			<p><b>Inspiration</b> – just because someone is good at a topic, does not mean they can teach...we use our extensive teaching experience to look for tutors not just with strong academics but a clear passion about their subject and a natural affinity with their pupils, something which is key to promoting effective learning</p>
            			<p><b>Dedication</b> – we hire tutors who can demonstrate full and genuine commitment to the professional standards required by Arlen and never compromise on quality</p>
            			<p>All our tutors are subject to the following: an enhanced DBS (CRB) disclosure form, qualification checks, a two stage interview process with all three of our founding partners and frequent lesson observation and feedback</p>
            			<h6><a href="#0">Back to top</a></h6>
            			<br><br>
            			<h2 id="3" style="padding-top: 70px; margin-top: -70px;">Why are you different to any other tutor agency?</h2>
						<p>Most agencies allocate a tutor to a client and then</p> 
						<h6><a href="#0">Back to top</a></h6>
						<br><br>
						<h2 id="4" style="padding-top: 70px; margin-top: -70px;">As a client of Arlen Education, what will I receive?</h2>
						<h6><a href="#0">Back to top</a></h6>
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