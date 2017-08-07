<style type="text/css">

#contact-wrapper {
	font-family:Arial, Helvetica, sans-serif;
	width:450px;
	background:#f1f1f1;
	padding:5px 0px 50px 20px;
	margin: 20px 0px 0px 0px;
	text-align:left;
}
#contact-wrapper p.error{
	color:#DD0000;
	font-size:12px;
	line-height:120%;
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
	width:450px;
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
form#contactform select.error, 
form#contactform textarea.error{
	
	border:1px solid #DD0000;
}
.catalogCol{
	float:left;width:220px;margin-top:0px;
}
#contact-wrapper div.catalogCol {
	
	margin-top:0px;
}
#catalogAddress label{width:200px;}

#catalogAddress div input{width:200px;}

form#contactform input#submit{width:140px;height:42px;padding:0;margin:0;background:#883878;color:#FFF;font-weight:bold;}

</style>


            
            
  <?php
  
  
  require("../includes/resource/db.php");
  
  

  
//If the form is submitted
if(isset($_POST['submit'])) {
	
	$firstname 	= trim($_POST['firstname']);
		$lastname 	= trim($_POST['lastname']);
		$occupation = trim($_POST['occupation']);
		$location	= trim($_POST['location']);
		$email 		= trim($_POST['email']);
		$date 		= trim($_POST['date']);
		$subject 	= trim($_POST['subject']);
		$phone 		= trim($_POST['phone']);
		$message 	= stripslashes(trim($_POST['message']));
		
	//$phone = trim($_POST['phone']);
	//If there is no error, send the email
	if(!isset($hasError)) {
	//echo $subject;
		//if ( $subject == "Request Catalog"){
			//$emailTo = 'wilson@peppergate.com'; //wilson@peppergate.com
		//} else {
		//	$emailTo = 'wilson@peppergate.com'; 
		//}
		$emailTo[1] = "wilson@peppergate.com";
		$emailTo[2] = "wilson@peppergate.com";
		$emailTo[3] = "wilson@peppergate.com";
		$emailTo[4] = "wilson@peppergate.com";
		
		$subj[1] = "Shoes Issue - Contacted Store";
		$subj[2] = "Shoes Issue - No Store Contact";
		$subj[3] = "Order Assistance";
		$subj[4] = "Feedback";
		
		$emailTo = "$emailTo[$subject]"; //Put your own email address here sofia@peppergate.com
		$body = "Name: $firstname $lastname \n\nStyle: $occupation \n\nPurchase Location: $location \n\nPurchase Date: $date \n\nEmail: $email \n\nPhone: $phone \n\n$message";
		$headers  = "From: $firstname $lastname <$email>\r\n";//"From: $firstname $lastname <$email>\nReply-To: $email";
		$headers .= "Reply-To: $email";
		
		mail($emailTo, $subj[$subject], $body, $headers, "-f".$emailTo[$subject]);
		$emailSent = true;
		
		// Enter data to database //
		$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
		mysql_select_db($database, $linkID) or die("Could not find database."); 
				
		
		
			  $find[] = 'â€œ';  // left side double smart quote
			  $find[] = 'â€';  // right side double smart quote
			  $find[] = 'â€˜';  // left side single smart quote
			  $find[] = 'â€™';  // right side single smart quote
			  $find[] = 'â€¦';  // elipsis
			  $find[] = 'â€”';  // em dash
			  $find[] = 'â€“';  // en dash
			
			  $replace[] = '"';
			  $replace[] = '"';
			  $replace[] = "'";
			  $replace[] = "'";
			  $replace[] = "...";
			  $replace[] = "-";
			  $replace[] = "-";
			
			  $message = str_replace($find, $replace, $message);	
			  
			  $message = addslashes($message);		
		
				
		$query = "INSERT INTO $ctable VALUES ('','$firstname','$lastname', '$occupation','$email', '$location', '$date', '$subj[$subject]', '$address', '$city', '$state', '$zip', '$phone', '$message', '')";
		mysql_query($query);
		//print $query;		
		mysql_close();
		
		$firstname = "";
		$lastname = "";
		$occupation = "";
		$date = "";
		$location ="";
		$email = "";
		$address = "";
		$city = "";
		$state = "";
		$zip = "";
		$phone = "";
		$message = "";
	}
}
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="../includes/js/jquery.validate.pack.js" type="text/javascript"></script>
<script src="../includes/js/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){

	$("#phone").mask("(999) 999-9999");//,{placeholder:" "}

	$("#contactform").validate({
		rules: {
			subject: "required",
			firstname: "required",
			lastname: "required",
			occupation: "required",
			
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
			subject: "Please Answer",	
			firstname: "Please enter your First Name",
			lastname: "Please enter your Last Name",
			occupation: "Please enter your Style",
			phone: "Please enter a valid Phone Number",
			email: "Please enter a valid Email Address",
			
			confirm_email: {
				equalTo: "Please enter the same email as above"
			}
			//agree: "Please accept our policy"
		}
	});
});
</script>
<?php
//define a maxim size for the uploaded images in Kb
 define ("MAX_SIZE","100"); 

//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.
 $errors=0;
//checks if the form has been submitted
 if(isset($_POST['Submit'])) 
 {
 	//reads the name of the file the user submitted for uploading
 	$image=$_FILES['image']['name'];
 	//if it is not empty
 	if ($image) 
 	{
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($_FILES['image']['name']);
 	//get the extension of the file in a lower case format
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		//print error message
 			echo '<h1>Unknown extension!</h1>';
 			$errors=1;
 		}
 		else
 		{
//get the size of the image in bytes
 //$_FILES['image']['tmp_name'] is the temporary filename of the file
 //in which the uploaded file was stored on the server
 $size=filesize($_FILES['image']['tmp_name']);

//compare the size with the maxim size we defined and print error if bigger
if ($size > MAX_SIZE*1024)
{
	echo '<h1>You have exceeded the size limit!</h1>';
	$errors=1;
}

//we will give an unique name, for example the time in unix time format
$image_name=time().'.'.$extension;
//the new name will be containing the full path where will be stored (images folder)
$newname="images/".$image_name;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}}

//If no errors registred, print the success message
 if(isset($_POST['Submit']) && !$errors) 
 {
 	echo "<h1>File Uploaded Successfully! Try again!</h1>";
 }

 ?>

 
	<div id="contact-wrapper">
    <!--next comes the form, you must set the enctype to "multipart/frm-data" and use an input type "file" -->
 <form name="newad" method="post" enctype="multipart/form-data"  action="">
 <table>
 	<tr><td width="238"><input type="file" name="image"></td></tr>
 	<tr><td><input name="Submit" type="submit" value="Upload image"></td></tr>
 </table>	
 </form>

	<?php if(isset($hasError)) { //If errors are found ?>
		<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
	<?php } ?>

	<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
		<p class="confirm"><strong>Email Successfully Sent!</strong><br>
		Thank you <strong><?php echo $name;?></strong> for contacing us! Your email was successfully sent and we will be in touch with you shortly..</p>
	<?php } ?>

	<form method="post" action="main2.php" id="contactform">

        <div>
			<label for="location"><strong>Purchase Location *</strong></label>
		<input type="text" size="50" name="location" id="location" value="<?php echo $location?>" class="required" /> 
		</div>
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
		    <label for="occupation"><strong>Style *</strong></label>
			<input type="text" size="50" name="occupation" id="occupation" value="<?php echo $occupation?>" class="required" />
		</div>
		<div>
			<label for="email"><strong>Email *</strong></label>
			<input type="text" size="50" name="email" id="email" value="<?php echo $email?>" class="required email" />
		</div>
        <div>
			<label for="email"><strong>Confirm Email *</strong></label>
			<input type="text" size="50" name="confirm_email" id="confirm_email" class="required email" />
		</div>
        <div>
                <label for="subject"><strong>Did You Contact Store Purchased From: *</strong></label>
            <select name="subject" id="subject" class="required">
					<option value=''>--</option>
            		<option value='1'>Yes</option>
                    <option value='2'>No</option>
			</select>
		</div>
       </div>
       <div class="catalogCol">
    	<div>
			<label for="phone"><strong>Phone Number</strong></label>
			<input type="text" size="50" name="phone" id="phone" value="<?php echo $phone ?>" />
		</div>
    	<div>
			<label for="date"><strong>Approximate Purchase Date </strong></label>
			<input type="text" size="50" name="date" id="date" value="<?php echo $date ?>" />
		</div>		
		
		<div>
			<label for="message"><strong>Please Tell Us What Is Wrong: *</strong></label>
			<textarea rows="10" cols="50" name="message" id="message" class="required"><?php echo $message?></textarea>
		</div>

        </div>
	    <input id="submit" type="submit" value="SEND MESSAGE" name="submit" />
	</form>
    
    	</div><!-- EOD contact-wrapper -->
