<style type="text/css">
	strong {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 13px;
	}
	#contact-wrapper {
		/*border: 5px solid #EE2C75;*/
		background-color: #F1F1F1;
		width: 40%;
		/*margin: 0 auto;*/
		padding: 35px 25px 35px 25px;
		border-radius: 2px;		
	}
	.techText_title {
		text-align: center;
		font-size: 24px;
		font-family: Arial, Helvetica, sans-serif;
	}
	.input-section select {
		/*border: 1px solid blue;*/
		/*padding: 10px;*/
		padding: 10px 0 10px 0;
		border-radius: 2px;
	}
	.input-section input {	
		width: 100%;
		padding: 10px 0 10px 0;
		border-radius: 2px;
		font-size: 14px;
	}
	::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		padding-left: 10px;
	}
	::-moz-placeholder { /* Firefox */
		padding-left: 10px;
	}
	::-ms-input-placeholder { /* IE 10 */
		padding-left: 10px;
	}
	.input-btn-container {
		padding: 25px 0 10px 0;
	}
	.submit-form {
		background-color: #883878;
		color: white;
		padding: 10px 20px 10px 20px;
		font-size: 18px;
		border: 2px;
	}
	.success-color {
		color: green;
	}
	@media only screen and (max-width : 768px) {
		#contact-wrapper {
			width: 90%;
		}
	}
</style>
  
  <?php
  	require("../includes/resource/db.php");
    
	//If the form is submitted
	if(isset($_POST['submit'])) {
		
		//Check to make sure that the name field is not empty: FIRST NAME
		if(trim($_POST['firstname']) == '') {
			$hasError = true;
		} else {
			$firstname = trim($_POST['firstname']);
		}
		//Check to make sure that the name field is not empty: LAST NAME
		if(trim($_POST['lastname']) == '') {
			$hasError = true;
		} else {
			$lastname = trim($_POST['lastname']);
		}
		//Check to make sure sure that a valid email address is submitted: EMAIL
		if(trim($_POST['email']) == '')  {
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
		
		$subject = "Request Catalog";

		//Check to make sure that the subject field is not empty: ADDRESS
		if(trim($_POST['address']) == '' && $_GET['subj'] == "catalog") {
			$hasError = true;
		} else {
			$address = trim($_POST['address']);
		}
		if(trim($_POST['suitenumber']) == '' && $_GET['subj'] == "catalog") {
			$hasError = true;
		} else {
			$suitesumber = trim($_POST['city']);
		}
		if(trim($_POST['city']) == '' && $_GET['subj'] == "catalog") {
			$hasError = true;
		} else {
			$city = trim($_POST['city']);
		}
		if(trim($_POST['state']) == '' && $_GET['subj'] == "catalog") {
			$hasError = true;
		} else {
			$state = trim($_POST['state']);
		}
		//Check to make sure sure that a zip is submitted
		if (eregi("^[0-9-]$", trim($_POST['zip'])) && $_GET['subj'] == "catalog") {
			$hasError = true;
		} else {
			$zip = trim($_POST['zip']);
		}
		
		//If there is no error, send the email and send to cattable database is alegriashoes
		if(!isset($hasError)) {
			// Enter data to database //
			$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
			mysql_select_db($database, $linkID) or die("Could not find database."); 
					
			$query = "INSERT INTO $cattable VALUES ('','$firstname','$lastname','$email', '$address', '$suitenumber', '$city', '$state', '$zip')";
			mysql_query($query);
			//print $query;		
			mysql_close();
			
			$firstname = "";
			$lastname = "";
			$email = "";
			$address = "";
			$suitenumber = "";
			$city = "";
			$state = "";
			$zip = "";
		}
	}
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="../includes/js/jquery.validate.pack.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#contactform").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			address: "required",
			city: "required",
			state: "required",
			zip: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			firstname: "<p style='color:red;'>Please enter your First Name</p>",
			lastname: "<p style='color:red;'>Please enter your Last Name</p>",
			email: "<p style='color:red;'>Please enter a valid Email Address</p>",
			address: "<p style='color:red;'>Please enter your Address</p>",
			city: "<p style='color:red;'>Please enter your City</p>",
			state: "<p style='color:red;'>Please select a State</p>",
			zip: "<p style='color:red;'>Please enter your zip</p>"
		}
	});
});

</script>

	<div id="contact-wrapper">
		<div class="techText_title">
			<b>Request Catalog Form</b>
		</div>
		<?php if(isset($hasError)) { //If errors are found ?>
			<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
		<?php } ?>

		<?php
			if(!isset($hasError) && isset($_POST['submit'])) {
				echo "<h4 class='success-color'>Thank you for your catalog request. A copy should arrive within 2-4 weeks.</h4>";
			}
		 ?>
		<form method="post" action="main.php" id="contactform">
			<div class="catalogCol">
	        <div class="input-section">
	        <!-- First Name -->
	        	<p for="name"><strong>First Name: <span class="switch">*</span></sStrong></p>
				<input placeholder="First Name" type="text" size="50" name="firstname" id="firstname" value="<?php echo $firstname?>" class="required" />
			</div>
			<div class="input-section">
			<!-- Last Name -->		   
			    <p for="name"><strong>Last Name: *</strong></p>
				<input placeholder="Last Name" type="text" size="50" name="lastname" id="lastname" value="<?php echo $lastname?>" class="required" />
			</div>
	 		<div class="input-section">
	 		<!-- Email -->		
				<p for="email"><strong>Email: *</strong></p>
				<input placeholder="Email" type="text" size="50" name="email" id="email" value="<?php echo $email?>" class="required email" />
			</div>
			<!-- Address -->
	        <div class="input-section">            
	            <p for="address"><strong>Address: *</strong></p>
	            <input placeholder="Address" type="text" size="50" name="address" id="address" value="<?php echo $address ?>" class="required"/>
	        </div>
	        <!-- Suite Number -->
	        <div class="input-section">            
	            <p for="suitenumber"><strong>Suite/Apt #:</strong></p>
	            <input placeholder="Suite #" type="text" size="50" name="suitenumber" id="suitenumber" value="<?php echo $suitenumber ?>"/>
	        </div>
	        <!-- City -->
	        <div class="input-section">           
	            <p for="city"><strong>City: *</strong></p>
	            <input placeholder="City" type="text" size="50" name="city" id="city" value="<?php echo $city ?>" class="required"/>
	        </div>
	        	<!-- State -->
	             <div class="input-section">                
	                <p for="state"><strong>State: *</strong></p>
	                <select class="select required" id="state" name="state">
	                    <option value="" selected> Select a State</option><option value="AK">AK - Alaska</option><option value="AL">AL - Alabama</option><option value="AR">AR - Arkansas</option><option value="AZ">AZ - Arizona</option><option value="CA">CA - California</option><option value="CO">CO - Colorado</option><option value="CT">CT - Connecticut</option><option value="DC">DC - District of Columbia</option><option value="DE">DE - Delaware</option><option value="FL">FL - Florida</option><option value="GA">GA - Georgia</option><option value="HI">HI - Hawaii</option><option value="IA">IA - Iowa</option><option value="ID">ID - Idaho</option><option value="IL">IL - Illinois</option><option value="IN">IN - Indiana</option><option value="KS">KS - Kansas</option><option value="KY">KY - Kentucky</option><option value="LA">LA - Louisiana</option><option value="MA">MA - Massachusetts</option><option value="MD">MD - Maryland</option><option value="ME">ME - Maine</option><option value="MI">MI - Michigan</option><option value="MN">MN - Minnesota</option><option value="MO">MO - Missouri</option><option value="MS">MS - Mississippi</option><option value="MT">MT - Montana</option><option value="NC">NC - North Carolina</option><option value="ND">ND - North Dakota</option><option value="NE">NE - Nebraska</option><option value="NH">NH - New Hampshire</option><option value="NJ">NJ - New Jersey</option><option value="NM">NM - New Mexico</option><option value="NV">NV - Nevada</option><option value="NY">NY - New York</option><option value="OH">OH - Ohio</option><option value="OK">OK - Oklahoma</option><option value="OR">OR - Oregon</option><option value="PA">PA - Pennsylvania</option><option value="RI">RI - Rhode Island</option><option value="SC">SC - South Carolina</option><option value="SD">SD - South Dakota</option><option value="TN">TN - Tennessee</option><option value="TX">TX - Texas</option><option value="UT">UT - Utah</option><option value="VA">VA - Virginia</option><option value="VT">VT - Vermont</option><option value="WA">WA - Washington</option><option value="WI">WI - Wisconsin</option><option value="WV">WV - West Virginia</option><option value="WY">WY - Wyoming</option>
	                </select>
	            </div>
	        <div class="input-section">
	        <!-- Zip Code -->
	            <p for="zip"><strong>Zip: *</strong></p>
	            <input placeholder="Zip" type="text" size="50" name="zip" id="zip" value="<?php echo $zip ?>" class="required"/>
	        </div>
	        <!-- Submit Button -->
	        <div class="input-btn-container">
	        	<input class="submit-form" type="submit" value="Submit" name="submit" />
	        </div>
		</form><!-- End of form -->
	</div><!-- EOD contact-wrapper -->
