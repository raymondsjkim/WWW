
<style type="text/css">

#contact-wrapper {
	font-family:Arial, Helvetica, sans-serif;
	width:480px;
	
	background:#f1f1f1;
	padding:5px 0px 10px 20px;
	text-align:left;
}
#contact-wrapper p.error{
	color:#DD0000;
	font-size:12px;
	line-height:140%;
}
#contact-wrapper p.confirm{
	color:#ee2375;
	font-size:12px;
	line-height:140%;
}
#contact-wrapper form{
	width:250px;
}
#contact-wrapper div {
	
	margin:1em 0;
}
#contact-wrapper label {
	display:block;
	float:none;
	font-size:13px;
	width:auto;
	color:#666;
}
form#contactform{
	width:480px;
}
form#contactform input {
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	font-family:Arial, Helvetica, sans-serif;
	border-style:solid;
	border-width:1px;
	padding:4px;
	font-size:13px;
	color:#333;
	width:200px;
}
form#contactform textarea {
	font-family:Arial, Helvetica, sans-serif;
	font-size:100%;
	padding:4px;
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	border-style:solid;
	border-width:1px;
	width:200px;
	font-size:13px;
}
form#contactform select {
	font-size:12px;
	padding:3px;
}

form#contactform label.error {
	color:#DD0000;
	padding-top:3px;
	font-size:11px;
}
form#contactform input.error, 
form#contactform textarea.error{
	
	border:1px solid #DD0000;
}
.catalogCol{
	float:left;width:220px;
}
#catalogAddress label{width:200px;}

#catalogAddress div input{width:200px;}

</style>
            
            
  <?php
  
  
  require("../includes/resource/db.php");
  
/*  
$requestCatalog = $_GET['subj'];

if ($requestCatalog == "catalog") {
	$reqCat = "selected";
} 
if ($requestCatalog == "product") {
	$reqPro = "selected";
} 
if ($requestCatalog == "comment") {
	$reqCom = "selected";
} */
  
//If the form is submitted
if(isset($_POST['submit'])) {
	
	//Check to make sure that the name field is not empty
	if(trim($_POST['firstname']) == '') {
		$hasError = true;
	} else {
		$firstname = trim($_POST['firstname']);
	}
	//Check to make sure that the name field is not empty
	if(trim($_POST['lastname']) == '') {
		$hasError = true;
	} else {
		$lastname = trim($_POST['lastname']);
	}
	//Check to make sure that the occupation field is not empty
	//if(trim($_POST['occupation']) == '') {
	//	$hasError = true;
	//} else {
	//	$occupation = trim($_POST['occupation']);
	//}
	

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['confirm_email']) != trim($_POST['email']))  {
		$hasError = true;
	//} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		//$hasError = true;
	} else {
		//$confirm_email = trim($_POST['confirm_email']);
	}
	
	$subject = "Survey Trial";
/*	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}*/
	//if () {	
		//Check to make sure that the subject field is not empty
		if(trim($_POST['address']) == '' && $_GET['subj'] == "catalog") {
			$hasError = true;
		} else {
			$address = trim($_POST['address']);
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
	//}	
	
	
	//Check to make sure sure that a phone is submitted
	if (eregi("^[0-9-]$", trim($_POST['phone']))) {
		$hasError = true;
	} else {
		$phone = trim($_POST['phone']);
	}
	
	/*Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['message']));
		} else {
			$message = trim($_POST['message']);
		}
	}*/
	//$phone = trim($_POST['phone']);
	//If there is no error, send the email
	if(!isset($hasError)) {
	//echo $subject;
		//if ( $subject == "Request Catalog"){
			//$emailTo = 'leok@lexi-solutions.com'; //sandra@peppergate.com
		//} else {
		//	$emailTo = 'test@happylookslike.com'; 
		//}
		$emailTo = "wilson@peppergate.com"; //Put your own email address here info@happylookslike.com
		$body = "Name: $firstname $lastname \n\nOccupation: $occupation \n\nEmail: $email \n\nAddress: $address, $city, $state $zip \n\nPhone: $phone";
		$headers  = "From: $firstname $lastname <$email>\r\n";//"From: $firstname $lastname <$email>\nReply-To: $email";
		$headers .= "Reply-To: $email";
		
		//echo $headers;
		//echo $body;
		//echo $emailTo;
		
		mail($emailTo, $subject, $body, $headers, "wilson@peppergate.com");
		$emailSent = true;
		
		// Enter data to database //
		$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
		mysql_select_db($database, $linkID) or die("Could not find database."); 
				
		
		
		
				
		$query = "INSERT INTO $ctable VALUES ('','$firstname','$lastname', '$occupation','$email', '$subject', '$address', '$city', '$state', '$zip', '$phone', '$message', '')";
		mysql_query($query);
		//print $query;		
		mysql_close();
		
		$firstname = "";
		$lastname = "";
		$occupation = "";
		$email = "";
		$address = "";
		$city = "";
		$state = "";
		$zip = "";
		$phone = "";
		//$message = "";
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
			//occupation: "required",
			address: "required",
			city: "required",
			state: "required",
			zip: "required",
			email: {
				required: true,
				email: true
			},
			confirm_email: {
				required: true,
				minlength: 5,
				equalTo: "#email",
				email: true
			}
			
			/* topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required" */
		},
		messages: {
			firstname: "Please enter your First Name",
			lastname: "Please enter your Last Name",
			//occupation: "Please enter your Occupation",
			phone: "Please enter a valid Phone Number",
			email: "Please enter a valid Email Address",
			address: "Please enter your Address",
			city: "Please enter your City",
			state: "Please select a State",
			zip: "Please enter your zip",
			confirm_email: {
				equalTo: "Please enter the same email as above"
			}
			//agree: "Please accept our policy"
		}
	});
});
</script>



	<div id="contact-wrapper">
	<div class="techText_title"><b>Request Survey Shoe Trial Form</b></div>
	<?php if(isset($hasError)) { //If errors are found ?>
		<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
	<?php } ?>

	<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
		<p class="confirm"><strong>Email Successfully Sent!</strong><br>
		Thank you for applying! Your email was successfully sent and we will email you back if you qualify for our trial shoe program.</p>
	<?php } ?>

	<form method="post" action="main.php" id="contactform">
		<div class="catalogCol">
        <div>
		    <label for="name"><strong>First Name *</strong></label>
			<input type="text" size="50" name="firstname" id="firstname" value="<?php echo $firstname?>" class="required" />
		</div>
		<div>
		    <label for="name"><strong>Last Name *</strong></label>
			<input type="text" size="50" name="lastname" id="lastname" value="<?php echo $lastname?>" class="required" />
		</div>
        <div>
		    <label for="occupation"><strong>Occupation </strong>(optional)</label>
			<input type="text" size="50" name="occupation" id="occupation" value="<?php echo $occupation?>" />
		</div>
		<div>
			<label for="email"><strong>Email *</strong></label>
			<input type="text" size="50" name="email" id="email" value="<?php echo $email?>" class="required email" />
		</div>
        <div>
			<label for="email"><strong>Confirm Email *</strong></label>
			<input type="text" size="50" name="confirm_email" id="confirm_email" class="required email" />
		</div>
       </div>

        <div class="catalogCol">
           
            <div>
                <label for="address"><strong>Address *</strong></label>
                <input type="text" size="50" name="address" id="address" value="<?php echo $address ?>" class="required"/>
            </div>
            <div>
                <label for="city"><strong>City *</strong></label>
                <input type="text" size="50" name="city" id="city" value="<?php echo $city ?>" class="required"/>
            </div>
             <div>
                <label for="state"><strong>State *</strong></label>
                <select class="select required" id="state" name="state">
                    <option value="" selected> Select a State</option><option value="AK">AK - Alaska</option><option value="AL">AL - Alabama</option><option value="AR">AR - Arkansas</option><option value="AZ">AZ - Arizona</option><option value="CA">CA - California</option><option value="CO">CO - Colorado</option><option value="CT">CT - Connecticut</option><option value="DC">DC - District of Columbia</option><option value="DE">DE - Delaware</option><option value="FL">FL - Florida</option><option value="GA">GA - Georgia</option><option value="HI">HI - Hawaii</option><option value="IA">IA - Iowa</option><option value="ID">ID - Idaho</option><option value="IL">IL - Illinois</option><option value="IN">IN - Indiana</option><option value="KS">KS - Kansas</option><option value="KY">KY - Kentucky</option><option value="LA">LA - Louisiana</option><option value="MA">MA - Massachusetts</option><option value="MD">MD - Maryland</option><option value="ME">ME - Maine</option><option value="MI">MI - Michigan</option><option value="MN">MN - Minnesota</option><option value="MO">MO - Missouri</option><option value="MS">MS - Mississippi</option><option value="MT">MT - Montana</option><option value="NC">NC - North Carolina</option><option value="ND">ND - North Dakota</option><option value="NE">NE - Nebraska</option><option value="NH">NH - New Hampshire</option><option value="NJ">NJ - New Jersey</option><option value="NM">NM - New Mexico</option><option value="NV">NV - Nevada</option><option value="NY">NY - New York</option><option value="OH">OH - Ohio</option><option value="OK">OK - Oklahoma</option><option value="OR">OR - Oregon</option><option value="PA">PA - Pennsylvania</option><option value="RI">RI - Rhode Island</option><option value="SC">SC - South Carolina</option><option value="SD">SD - South Dakota</option><option value="TN">TN - Tennessee</option><option value="TX">TX - Texas</option><option value="UT">UT - Utah</option><option value="VA">VA - Virginia</option><option value="VT">VT - Vermont</option><option value="WA">WA - Washington</option><option value="WI">WI - Wisconsin</option><option value="WV">WV - West Virginia</option><option value="WY">WY - Wyoming</option>
               
                </select>
            </div>
             <div>
                <label for="zip"><strong>Zip *</strong></label>
                <input type="text" size="50" name="zip" id="zip" value="<?php echo $zip ?>" class="required"/>
            </div>
        
        <div>
			<label for="phone"><strong>Phone Number</strong></label>
			<input type="text" size="50" name="phone" id="phone" value="<?php echo $phone ?>" />
		</div>
        
        </div><!-- EOF catalogaddress -->
    
        
      
		
		

		
	    <input type="submit" value="Submit" name="submit" />
	</form>
	</div><!-- EOD contact-wrapper -->
