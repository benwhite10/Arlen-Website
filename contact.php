<?php
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	sec_session_start(); // Our custom secure way of starting a php session
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
    <script type="text/javascript" src="js/formvalidation.js"></script>
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
                    <li><a href = "tutoring.php">TUTORING</a></li>
                    <li class="current"><a href = "contact.php">CONTACT</a></li>
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
                <li class="current"><a href = "contact.php">CONTACT</a></li>
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
        				<li class="current"><a>Client Enquiry</a></li>
        				<li><a>Become a tutor</a></li>
        			</ul>
        		</div><div id="sidecontent">
        			<!-- Open Client Application Page-->
            		<div class="enquiry">
            			<h1>Contact Us</h1>
        				<p>If you are interested in finding out more about tutoring for your children then please complete the form below and one of our team will be in contact shortly.</p>
            			<div id="contacts">
							<p>Phone: 07411250857 </p>
							<p>Email: <a href="mailto:enquiries@arleneducation.com?subject=Enquiry">enquiries@arleneducation.com </a> </p>
        					<!--<p>Address: <br>78 Pall Mall <br> St James <br> London <br> SW1Y 5ES </p>-->
						</div><div id="mapcontainer">
						<iframe width="100%" height="100%" padding-top="100px" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=78%20Pall%20Mall%2C%20London%2C%20United%20Kingdom&key=AIzaSyD-I9UGhZMxKqrhN04YB46KB7it7OTHEJY"></iframe>
						</div><div id="client_application_form">
        					<form id="clientapplicationform" action="" method="" accept-charset="UTF-8" class="basic-grey">			
        						<h2>Online Enquiry Form</h2>
        						<label for="name">Name*: </label>
        						<input id="name" type="text" name="name" placeholder="Your Name"/>
        						
        						<label for="number">Contact Number*: </label>
        						<input id="number" type="text" name="number" placeholder="Your Contact Number"/>
        						
        						<label for="email">Email*: </label>
        						<input id="email" type="email" name="email" placeholder="Your Email"/>
        						
        						<label for="method">Preferred Contact*: </label>
								<select id="method" name="method">
									<option value="phone">Phone</option>
									<option value="friend">Email</option>
								</select>
								
								<label for="extrainfo">Additional Info: </label>
        						<textarea id="extrainfo" name="extrainfo" placeholder="Add here any notes such as when would be a good time to make contact with you."></textarea>

        						<label for="level">Age Range* : </label>
								<select id="level" name="level">
									<option value="">-Select-</option>
									<option value="11+">11+</option>
									<option value="13+">13+</option>
									<option value="GCSE">GCSE</option>
									<option value="A Level">A Level</option>
									<option value="IB">IB</option>
									<option value="University Applications">University Applications</option>
									<option value="Other">Other</option>
								</select>
        						
        						<label for="subjct">Subject*: </label>
								<select id="subjct" name="subjct">
									<option value="">-Subject-</option>
										<?php
											$strSQL = "SELECT * FROM `Subjects` ORDER BY `Subject Name`";
											$stmt = $mysql->prepare($strSQL);
											$stmt->execute();
											 /* bind result variables */
											$stmt->bind_result($id, $name);
											/* fetch values */
											while ($stmt->fetch()) {
												echo "<option value='$name'>$name</option>";
											}
											$mysql->close;
										?>
								</select>
        						
        						<label for="description">Description: </label>
        						<textarea id="description" name="description" placeholder="Please add here a description of the kind of tutoring you are looking for and any additional information you think may be useful at this stage"></textarea>
        						
        						<label for="heard">How did you find us?* : </label>
								<select id="heard" name="heard">
									<option value="">-Choose Option-</option>
									<option value="Advert in a magazine">Advert in a magazine</option>
									<option value="Through a friend">Through a friend</option>
									<option value="Through a school">Through a school</option>
									<option value="other">Other</option>
								</select>

        						<label for="heardother">Other: </label>
        						<input id="heardother" type="text" name="heardother" placeholder="If other please write here"/>
        						
        						<input id="submit" type="submit" class="button" value="Submit Form"/>
        					</form>
        				</div>
        				<div id="success2">
        					<span>
        						<p>Thank you for submitting your form, your will receive a reply within 7 days</p>
        					</span>
        				</div>
        				<div id="failure2">
        					<span>
        						<p>Oops, something went wrong</p>
        					</span>
        				</div>
        				
            		</div>
            		<!-- Close Client Application Page-->
        			<!-- Tutor Application Page-->
        			<div class="tutorapp" style="display:none">
        				<h1>Become a tutor</h1>
        				<h2>Please fill in all of the information below</h2>
        				<p>At Arlen we are always looking for talented new tutors. Our selection process involves a Skype or phone interview as well as a face to face meeting. If you are successful in making it through the selection process then you will become a member of our team here at Arlen.</p>
            			<div id="application_form">
        					<form id="applicationform" action="" method="" accept-charset="UTF-8" autocomplete="off" novalidate class="basic-grey">			
        						<h2>Personal Information</h2>
        						<label for="firstname">First Name*: </label>
        						<input id="firstname" type="text" name="firstname" placeholder="Your First Name"/>
        						
        						<label for="surname">Surname*: </label>
        						<input id="surname" type="text" name="surname" placeholder="Your Surname"/>
        						
        						<label for="email">Email*: </label>
        						<input id="email" type="email" name="email" placeholder="Your Email"/>
        						
        						<label for="number">Contact Number*: </label>
        						<input id="number" type="text" name="number" placeholder="Your Contact Number"/>
        						
        						<label for="skype">Skype Name: </label>
        						<input id="skype" type="text" name="skype" placeholder="(May be used for interview)"/>
        						
        						<label for="addline1">Address Line 1*: </label>
        						<input id="addline1" type="text" name="addline1" placeholder="Address Line 1"/>
        						
        						<label for="addline2">Address Line 2: </label>
        						<input id="addline2" type="text" name="addline2" placeholder="Address Line 2"/>
        						
        						<label for="addcity">Town/City*: </label>
        						<input id="addcity" type="text" name="addcity" placeholder="Town/City"/>
        						
        						<label for="addcounty">County: </label>
        						<input id="addcounty" type="text" name="addcounty" placeholder="County"/>
        						
        						<label for="postcode">Postcode*: </label>
        						<input id="postcode" type="text" name="postcode" placeholder="Postcode"/>
        						
        						<br><br>
        						<h2>Academic Information</h2>
        						<label for="university">University*: </label>
        						<input id="university" type="text" name="university" placeholder="Your University Name"/>

        						<label for="course">Course*: </label>
        						<input id="course" type="text" name="course" placeholder="Your University Course"/>

        						<label for="degree">Degree(s)*: </label>
        						<input id="degree" type="text" name="degree" placeholder="e.g BA (First)"/>
								
								<br>
        						<h2>Subjects</h2>
        						<p>Please use the grid below to indicate the subjects you are able to teach and the level to which you are able to teach those subjects. Please choose at least 1 and a maximum of 5 subjects, if you wish to select any more please write so in the box underneath.</p> 
								
								<table id="table" class="responsive-table-input-matrix">
									<thead>
									<tr>
										<th></th>
										<th>11+</th>
										<th>13+</th>
										<th>GCSE</th>
										<th>A Level</th>
										<th>IB</th>
										<th>University Application</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>
											<select id="subject1" name="subject1">
											<option value="">-Subject-</option>
											<?php
												$strSQL = "SELECT * FROM `Subjects` ORDER BY `Subject Name`";
												$stmt = $mysql->prepare($strSQL);
												$stmt->execute();
												 /* bind result variables */
												$stmt->bind_result($id, $name);
												/* fetch values */
												while ($stmt->fetch()) {
													echo "<option value='$id'>$name</option>";
												}
												$mysql->close;
											?>
											</select>
										</td>
										<td><input type='checkbox' name='Sub1[]' value='1' ></td>
										<td><input type='checkbox' name='Sub1[]' value='2' ></td>
										<td><input type='checkbox' name='Sub1[]' value='3' ></td>
										<td><input type='checkbox' name='Sub1[]' value='4' ></td>
										<td><input type='checkbox' name='Sub1[]' value='5' ></td>
										<td><input type='checkbox' name='Sub1[]' value='6' ></td>
									</tr>
									<tr>
										<td>
											<select id="subject2" name="subject2">
											<option value="">-Subject-</option>
											<?php
												$strSQL = "SELECT * FROM `Subjects` ORDER BY `Subject Name`";
												$stmt = $mysql->prepare($strSQL);
												$stmt->execute();
												 /* bind result variables */
												$stmt->bind_result($id, $name);
												/* fetch values */
												while ($stmt->fetch()) {
													echo "<option value='$id'> $name </option>";
												}
												$mysql->close;
											?>
											</select>
										</td>
										<td><input type='checkbox' name='Sub2[]' value='1' ></td>
										<td><input type='checkbox' name='Sub2[]' value='2' ></td>
										<td><input type='checkbox' name='Sub2[]' value='3' ></td>
										<td><input type='checkbox' name='Sub2[]' value='4' ></td>
										<td><input type='checkbox' name='Sub2[]' value='5' ></td>
										<td><input type='checkbox' name='Sub2[]' value='6' ></td>
									</tr>
									<tr>
										<td>
											<select id="subject3" name="subject3">
											<option value="">-Subject-</option>
											<?php
												$strSQL = "SELECT * FROM `Subjects` ORDER BY `Subject Name`";
												$stmt = $mysql->prepare($strSQL);
												$stmt->execute();
												 /* bind result variables */
												$stmt->bind_result($id, $name);
												/* fetch values */
												while ($stmt->fetch()) {
													echo "<option value='$id'> $name </option>";
												}
												$mysql->close;
											?>
											</select>
										</td>
										<td><input type='checkbox' name='Sub3[]' value='1' ></td>
										<td><input type='checkbox' name='Sub3[]' value='2' ></td>
										<td><input type='checkbox' name='Sub3[]' value='3' ></td>
										<td><input type='checkbox' name='Sub3[]' value='4' ></td>
										<td><input type='checkbox' name='Sub3[]' value='5' ></td>
										<td><input type='checkbox' name='Sub3[]' value='6' ></td>
									</tr>
									<tr>
										<td>
											<select id="subject4" name="subject4">
											<option value="">-Subject-</option>
											<?php
												$strSQL = "SELECT * FROM `Subjects` ORDER BY `Subject Name`";
												$stmt = $mysql->prepare($strSQL);
												$stmt->execute();
												 /* bind result variables */
												$stmt->bind_result($id, $name);
												/* fetch values */
												while ($stmt->fetch()) {
													echo "<option value='$id'> $name </option>";
												}
												$mysql->close;
											?>
											</select>
										</td>
										<td><input type='checkbox' name='Sub4[]' value='1' ></td>
										<td><input type='checkbox' name='Sub4[]' value='2' ></td>
										<td><input type='checkbox' name='Sub4[]' value='3' ></td>
										<td><input type='checkbox' name='Sub4[]' value='4' ></td>
										<td><input type='checkbox' name='Sub4[]' value='5' ></td>
										<td><input type='checkbox' name='Sub4[]' value='6' ></td>
									</tr>
									<tr>
										<td>
											<select id="subject5" name="subject5">
											<option value="">-Subject-</option>
											<?php
												$strSQL = "SELECT * FROM `Subjects` ORDER BY `Subject Name`";
												$stmt = $mysql->prepare($strSQL);
												$stmt->execute();
												 /* bind result variables */
												$stmt->bind_result($id, $name);
												/* fetch values */
												while ($stmt->fetch()) {
													echo "<option value='$id'> $name </option>";
												}
												$mysql->close;
											?>
											</select>
										</td>
										<td><input type='checkbox' name='Sub5[]' value='1' ></td>
										<td><input type='checkbox' name='Sub5[]' value='2' ></td>
										<td><input type='checkbox' name='Sub5[]' value='3' ></td>
										<td><input type='checkbox' name='Sub5[]' value='4' ></td>
										<td><input type='checkbox' name='Sub5[]' value='5' ></td>
										<td><input type='checkbox' name='Sub5[]' value='6' ></td>
									</tr>
									</tbody>
								</table>
								<br>
								<label for="extrasubjects">Other subjects: </label>
        						<textarea id="extrasubjects" name="extrasubjects" placeholder="Please enter any additional subjects you are able to teach."></textarea>
								<br>
        						<h2>Tutor Profile</h2>
        						<label for="biography">Biography* : </label>
        						<textarea id="biography" name="biography" placeholder="Briefly describe yourself"></textarea>
        						
        						<label for="experience">Teaching Experience* : </label>
        						<textarea id="experience" name="experience" placeholder="Briefly describe your teaching and/or tutoring experience"></textarea>

        						<label for="situation">Current Situation* : </label>
        						<textarea id="situation" name="situation" placeholder="Please describe your current situation"></textarea>

        						<label for="testimonials">Testimonials : </label>
        						<textarea id="testimonials" name="testimonials" placeholder="If you have any please include any testimonials here"></textarea>

        						<label for="notes">Additional Information: </label>
        						<textarea id="notes" name="notes" placeholder="Please include here any other information you think will be relevant to your application"></textarea>

        						<h2>The Last Bit</h2>
        						<label for="heard">How did you find us?* : </label>
								<select id="heard" name="heard">
									<option value="">-Choose Option-</option>
									<option value="Advert in a magazine">Advert in a magazine</option>
									<option value="Through a friend">Through a friend</option>
									<option value="Through a school">Through a school</option>
									<option value="other">Other</option>
								</select>

        						<label for="heardother">Other: </label>
        						<input id="heardother" type="text" name="heardother" placeholder="If other please write here"/>

        						<label for="terms">Terms of Use*: </label>
        						<input id="terms" name = "terms" type="checkbox"/> I agree to Arlen Education's terms of use<br>
        						<!--<table id="terms_table" class="responsive-table-input-matrix">
									<tbody>
									<tr>
										<td><p>I agree to Arlen Education's terms of use</p></td>
										<td><input id="terms" name = "terms" type="checkbox"/></td>
									</tr>
									</tbody>
								</table>-->
        						<input id="submit" type="submit" class="button" value="Submit Form"/>
        					</form>
        				</div>
        				<div id="success">
        					<span>
        						<p>Thank you for submitting your form, your will receive a reply within 7 days</p>
        					</span>
        				</div>
        				<div id="failure">
        					<span>
        						<p>Oops, something went wrong</p>
        					</span>
        				</div>
        			</div>
            		<!-- Close Tutor Application Page-->
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