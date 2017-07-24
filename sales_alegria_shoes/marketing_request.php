<?php require_once ("includes/php/checkCookie.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>Marketing Request Form</title>  
<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>
<style type="text/css">

#contact-wrapper {
	font-family:Arial, Helvetica, sans-serif;
	width:100%;
	
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
	width:100%;
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

	width:100%;
}
form#contactform input {
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	font-family:Arial, Helvetica, sans-serif;
	border-style:solid;
	border-width:1px;
	padding:4px;
	font-size:13px;
	color:#333;
	width:260px;
}
form#contactform textarea {
	font-family:Arial, Helvetica, sans-serif;
	font-size:100%;
	padding:4px;
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	border-style:solid;
	border-width:1px;
	width:260px;
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
	float:left;width:33%;margin-top:0px;
}
#contact-wrapper div.catalogCol {
	margin-top:0px;
}
#catalogAddress label{width:300px;}

#catalogAddress div input{width:300px;}

form#contactform input#submit{width:140px;height:42px;padding:0;margin:0;background:#883878;color:#FFF;font-weight:bold;}

.contentRow .areaHeader{margin-top: 10px;padding-top: 10px;}

form#contactform input.radio {width:15px;}

</style>

<?php
//If the form is submitted
if(isset($_POST['submit'])) {
		$date	 	= date('m-d-Y');
		$firstname 	= trim($_POST['firstname']);
		$lastname 	= trim($_POST['lastname']);
		$salesNum 	= trim($_POST['salesNum']);
		$email 		= trim($_POST['email']);
		$message 	= stripslashes(trim($_POST['message']));

		$dueDate	= trim($_POST['dueDate']);
		$selectedItem = trim($_POST['selectedItem']);
		$description = trim($_POST['description']);
		$itemWidth	= trim($_POST['itemWidth']);
		$itemHeight	= trim($_POST['itemHeight']);
		$quantity	= trim($_POST['quantity']);
		$projectName = trim($_POST['projectName']);
		$event		= trim($_POST['eventRequested']);

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = "andrew@peppergate.com, benjamin@peppergate.com, ".$email;
		$subj = "Marketing Request - ".$firstname." ".$lastname." - ".$projectName;
		$body = '<table width="400" border="0" cellspacing="0" cellpadding="0">
					 <tr>
						<td width="100" valign="top">Date:</td>
						<td width="300" valign="top">'.$date.'</td>
					</tr><br />
					<tr>
						<td valign="top">Due Date:</td>
						<td valign="top">'.$dueDate.'</td>
					</tr><br />
					<tr>
						<td valign="top">Sales Number:</td>
						<td valign="top">'.$salesNum.'</td>
					</tr><br />
					<tr>
						<td valign="top">Contact Info:</td>
						<td valign="top">'.$firstname.' '.$lastname.'<br />
						  '.$email.'</td>
					</tr><br />
					<tr>
						<td valign="top">Selected Item:</td>
						<td valign="top">'.$selectedItem.'</td>
					</tr><br />
					<tr>
						<td valign="top">Item Width:</td>
						<td valign="top">'.$itemWidth.'</td>
					</tr><br />				
					<tr>
						<td valign="top">Item Height:</td>
						<td valign="top">'.$itemHeight.'</td>
					</tr><br />
					<tr>
						<td valign="top">Quantity:</td>
						<td valign="top">'.$quantity.'</td>
					</tr><br />
					<tr>
						<td valign="top">Event:</td>
						<td valign="top">'.$eventRequested.'</td>
					</tr><br />				
					<tr>
						<td valign="top">Descripton:</td>
						<td valign="top">'.$description.'</td>
					</tr><br />
					<tr>
						<td valign="top">Message:</td>
						<td valign="top">'.$message.'</td>
					</tr>
				  
				</table><br><br>';
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// Additional headers
		$headers .= "From: $firstname $lastname <$email>\r\n";
		$headers .= "Reply-To: $email";
		
		mail($emailTo, $subj, $body, $headers);
		$emailSent = true;
		
		$firstname = "";
		$lastname = "";
		$salesNum = "";
		$email = "";
		$message = "";

		$dueDate	= "";
		$selectedItem = "";
		$description = "";
		$itemWidth	= "";
		$itemHeight	= "";
		$quantity	= "";
		$projectName = "";
		$eventRequested = "";
	}
}
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="includes/js/jquery.validate.pack.js" type="text/javascript"></script>
<script src="includes/js/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#contactform").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			salesNum: "required",
			email: {
				required: true,
				email: true
			},
			confirm_email: {
				required: true,
				minlength: 5,
				equalTo: "#email",
				email: true
			},
			dueDate: "required",
			selectedItem: "required",
			description: "required",
			quantity: "required",
			projectName: "required"
		},
		messages: {
			firstname: "Please enter your First Name",
			lastname: "Please enter your Last Name",
			salesNum: "Please enter your Sales Number",
			email: "Please enter a valid Email Address",
			confirm_email: {
				equalTo: "Please enter the same email as above"
			},
			dueDate: "Please enter a Due Date",
			selectedItem: "Please select an item",
			description: "Please enter a description (POP SKU number, specific shoe, specific materials, etc)",
			quantity: "Please enter requested quantity",
			projectName: "Please enter a unique Project Name"
		},

		errorPlacement: function(error, element) {
			if (element.attr("name") == "chain" ){
			   error.insertAfter("#chainNo");
			 }else{
			   error.insertAfter(element);
			 }
		}
		
	});
});
</script>
</head>

<body>

<div id="Container">
		<div id="Outer">
			<div id="Header">
				<?php include("navigation/topNav.php"); ?>
			</div>
            <div id="Wrapper">
                <div class="contentRow">
                    <div class="areaHeader" >Marketing Print/Web Project Request Form</div>
                    <p>Please fill out all necessary information to submit a request for marketing material. To ensure quality work,
                    	please allow at least 2 weeks of lead time for smaller projects, and 6 weeks for larger, time consuming items.
                    	A staff at Peppergate will contact you shortly after your submission to verify all the details or clear up any 
                    	confusion. Please be verbose in your descriptions to hasten the process.
                    </p>
                    <p>
                    	<strong>Current default dimensions for existing items</strong> listed in "Width x Height" (for custom jobs, please enter
                    	the desired "Width" x "Height" [inches for print material, and pixels for web] and we will contact you upon review
                    	of the request.): 
                    </p>
                    <table>
                    	<tr>
                    		<td>Counter Card</td>
                    		<td>8.5" x 11"</td>
                    	</tr>
                    	<tr>
                    		<td>Large Wall Banner</td>
                    		<td><i>Optional Width</i>" x 24"</td>
                    	</tr>
                    	<tr>
                    		<td>Slat Wall Banner</td>
                    		<td>34" x 10.5"</td>
                    	</tr>
                    	<tr>
                    		<td>Wall Poster</td>
                    		<td>24" x 36"</td>
                    	</tr>
                    	<tr>
                    		<td>Window Cling</td>
                    		<td>18" x <i>Optional Height</i>"</td>
                    	</tr>
                    	<tr>
                    		<td>Canvas for Slat Wall</td>
                    		<td>12" x 24"</td>
                    	</tr>
                    	<tr>
                    		<td>Retractable Banner</td>
                    		<td>18" x 12"</td>
                    	</tr>
                    	<tr>
                    		<td>Website Banner</td>
                    		<td>Please fill in dimensions in PIXELS</td>
                    	</tr>
                    </table>
                    <br />
              	</div>
				<div id="contact-wrapper">
					<?php if(isset($hasError)) { //If errors are found ?>
						<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
					<?php } ?>

					<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
						<p class="confirm"><strong>Request Successfully Sent!</strong><br>
						Thank you <strong><?php echo $name;?></strong> for submitting your request! Please look to your submitted email address
						for a confirmation of your request. Our design team will contact you as soon as we can
						if we have any questions. If you'd like to make another request, please fill in the form again below.</p>
					<?php } ?>
					<form method="post" action="marketing_request.php" id="contactform">
				        <div class="catalogCol">
					        <div>
							    <label for="firstname"><strong>First Name *</strong></label>
								<input type="text" size="50" name="firstname" id="firstname" value="<?php echo $firstname?>" class="required" />
							</div>
							<div>
							    <label for="lastname"><strong>Last Name *</strong></label>
								<input type="text" size="50" name="lastname" id="lastname" value="<?php echo $lastname?>" class="required" />
							</div>
					        <div>
							    <label for="salesnum"><strong>Sales Number *</strong></label>
								<input type="text" size="50" name="salesNum" id="salesNum" value="<?php echo $salesNum?>" class="required" />
							</div>
					    	<div>
								<label for="email"><strong>Email *</strong></label>
								<input type="text" size="50" name="email" id="email" value="<?php echo $email?>" class="required email" />
							</div>
					        <div>
								<label for="confirm_email"><strong>Confirm Email *</strong></label>
								<input type="text" size="50" name="confirm_email" id="confirm_email" class="required email" />
							</div>
				       	</div>

				       	<div class="catalogCol">
				       		<div>
				       			<label for="selecteditem"><strong>Select Item *</strong></label>
				       			<select name="selectedItem" id="selectedItem" value="<?php echo $selectedItem?>"
				       				class="required">
				       				      <option value="counterCard">Counter Card</option>
									      <option value="largeWallBanner">Large Wall Banner</option>
									      <option value="slatWallBanner">Slat Wall Banner</option>
									      <option value="wallPoster">Wall Poster</option>
									      <option value="windowCling">Window Cling</option>
									      <option value="retractableBanner">Retractable Banner</option>
									      <option value="lineSheet">Line Sheet</option>
									      <option value="websiteBanner">Website Banner (WxH in pixels)</option>
									      <option value="other">Other</option>
							  	</select>
				       		</div>
				       		<div>
				       			<label for="projectname"><strong>Project Name *</strong></label>
				       			<input type="text" size="50" name="projectName" id="projectName" value="<?php echo $projectName?>" class="required" />
				       		</div>
					        <div>
							    <label for="duedate"><strong>Project Due Date *</strong></label>
								<input type="text" size="50" name="dueDate" id="dueDate" value="<?php echo $dueDate?>" class="required" />
							</div>
				      		<div>
							    <label for="quantity"><strong>Quantity Requested *</strong></label>
								<input type="text" size="50" name="quantity" id="quantity" value="<?php echo $quantity?>" class="required" />
							</div>
				       		<div>
				       			<label for="itemwidth"><strong>Width (inches or pixels based on request)</strong></label>
				       			<input type="text" name="itemWidth" id="itemWidth" value="<?php echo $itemWidth?>" />
				       		</div>
				       		<div>
				       			<label for="itemheight"><strong>Height (inches or pixels based on request)</strong></label>
				       			<input type="text" name="itemHeight" id="itemHeight" value="<?php echo $itemHeight?>" />
				       		</div>
				       		<div>
				       			<label for="eventrequested"><strong>Event/Tradeshow (if applicable)</strong></label>
				       			<input type="text" name="eventRequested" id="eventRequested" value="<?php echo $eventRequested?>" />
				       		</div>
				       	</div>
				       	<div class="catalogCol">
				       		<div>
				       			<label for="description"><strong>Description *</strong></label>
				       			<textarea rows="8" cols="50" name="description" id="description"><?php echo $description?></textarea>
				       		</div>
							<div>
								<label for="message"><strong>Notes: </strong></label>
								<textarea rows="8" cols="50" name="message" id="message" ><?php echo $message?></textarea>
							</div>
				       	</div>
				       	<div>
					    	<input style="display:inline;margin-left:80%" id="submit" type="submit" value="SUBMIT REQUEST" name="submit" />
						</div>
					</form>
				</div>
			</div><!-- EOF Wrapper -->
 		</div><!-- EOf Outer -->
 </div><!-- EOf Container -->
 <?php include("includes/php/google.analytics.php"); ?>
 </body>
</html>