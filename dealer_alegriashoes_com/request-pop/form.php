
<style type="text/css">

#contact-wrapper {
	font-family:Arial, Helvetica, sans-serif;
	width:750px;
	
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
	width:750px;
}
form#contactform input.text {
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

#catalogAddress div input.text{width:200px;}

#catalogAddress div input.checkbox{width:20px;}

.menuTable{padding-top:5px;font-size:12px;border:1px solid #ee2375;padding:10px;width:300px;}
.menuTable td{padding-bottom:5px;}
.fineprint{font-size:10px;}
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
	$date	 		= date('m-d-Y');
	
	$firstname 	= trim($_POST['firstname']);
	//$lastname 	= trim($_POST['lastname']);
	$customerID = trim($_POST['customerID']);
	$business	= $_POST['business'];
	$address	= $_POST['address'];
	$city		= $_POST['city'];
	$state		= $_POST['state'];
	$zip		= $_POST['zip'];
	$email 		= trim($_POST['email']);
	//$subject 	= trim($_POST['subject']);
	$phone 		= trim($_POST['phone']);
	//$message 	= stripslashes(trim($_POST['message']));
	
	$subject = "Request POP";
	
	if($_POST['pop1'] != "" and $_POST['pop1'] != "0"){$pop1 = "POP Tent Card - ".$_POST['pop1']." Set(s) of 4<br>";}
	if($_POST['pop2'] != "" and $_POST['pop2'] != "0"){$pop2 = "Floor Sticker - ".$_POST['pop2']."<br>";}
	if($_POST['pop3'] != "" and $_POST['pop3'] != "0"){$pop3 = "Hanging Sign - ".$_POST['pop3']."<br>";}
	if($_POST['pop4'] != "" and $_POST['pop4'] != "0"){$pop4 = "LED Light Box - ".$_POST['pop4']."<br>";}
	if($_POST['pop5'] != "" and $_POST['pop5'] != "0"){$pop5 = "Catalogs - ".$_POST['pop5']."<br>";}
	
	$message = $pop1.$pop2.$pop3.$pop4.$pop5;
/*	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}*/
	//if () {	
	
	//If there is no error, send the email
	
	//echo $subject;
		//if ( $subject == "Request Catalog"){
			//$emailTo = 'leok@lexi-solutions.com'; //sandra@peppergate.com
		//} else {
		//	$emailTo = 'test@happylookslike.com'; 
		//}
		$name_1 = "Susana Garcia";//Susana Garcia
		$name_2 = "Leo Ko";
		
		$email_1 = "susana@peppergate.com";//
		$email_2 = "leo@peppergate.com";
		
		$emailTo = $email_1.",";
		$emailTo .= $email_2; //Put your own email address here info@alegrishoes.com
		
		$body = '<html><body style="font-family:Arial, Helvetica, sans-serif;font-size:10px;text-align:center;">';
		
		$body .= '<table width="500" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif;font-size:11px;text-align:left;">
						<tr style="background-color: #ee2375;height: 70px;">
						<td colspan="2"><img src="http://assets.alegriashoes.com/images/logo_dealer.gif" alt="Alegria Shoes" /></td>
					</tr>
					
					<tr>
					  <td colspan="2"><br />
					    <h2 style="font-size:16px;color:#000;">
					    Thank you for your P.O.P order</h2>

				        <p>Your P.O.P. order has been received and is being processed by our customer service team.  A customer service representative will contact you shortly to confirm availability and shipping status of this order.<br />
<br />

				        Do <strong><u>NOT</u></strong> reply to this email. If you have questions regarding this order, please call us at 1-800-468-5191 Mon - Fri 9 a.m - 5 p.m. PST for assistance.<br />
<br />
						Thank you for your business!<br /><br />

                        </p></td>
					</tr>	 

 					<tr>
                    	<td width="47%" valign="top">
                        	<table style="font-family:Arial, Helvetica, sans-serif;font-size:11px;" valign="top">	
                                
                               <tr>
                                    <td width="110" height="37" valign="top"><strong>Date</strong></td>
                                    <td width="142" valign="top">'.$date.'</td>
                              </tr>
                                 
                                  <tr>
                                    <td valign="top" height="20"><strong>Customer #</strong></td>
                                    <td valign="top"><strong>'.$customerID.'</strong></td>
                                  </tr>
								  
								  <tr>
                                    <td valign="top" height="20"><strong>Business Name</strong></td>
                                    <td valign="top">'.$business.'</td>
                                  </tr>
								  
								  <tr>
                                    <td valign="top" height="20"><strong>Shipping Address</strong></td>
                                    <td valign="top">'.$address.'<br />'.$city.', '.$state.' '.$zip.'</td>
                                  </tr>
                                  
							</table>						
                        
                        </td>
                        <td valign="top" width="53%">
                        		<table width="100%" style="font-family:Arial, Helvetica, sans-serif;font-size:11px;v-align:top;">	
                        			  <tr>
                                        <td width="37%" height="65" valign="top"><strong>Contact Info</strong></td>
                                        <td width="63%" valign="top">'.$firstname.'<br>
                                          '.$phone.'<br>
                                          '.$email.'</td>
                                  </tr>
                                      <tr>
                                        <td valign="top"><strong>P.O.P Materials:</strong></td>
                                        <td valign="top">'.$message.'</td>
                                      </tr>
                                 </table>     
                        
                        </td>
                     </tr>
						<td colspan="2"><br>';
		
		$body .= '</td></tr>
				</table><br><br>';
		$body .= '</body></html>';
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// Additional headers
		
		$headers .= "From: Alegria Shoes <noreply@alegriashoes.com>\r\n";//"From: $firstname $lastname <$email>\nReply-To: $email";
		//$headers .= "Cc: $name_2 <$email_2>\r\n";
		$headers .= "Bcc: $emailTo";
		//$headers .= "Reply-To: $dealerEmail";
		
		
		mail($email, "Alegria P.O.P Order Confirmation", $body, $headers, "-f".$emailTo);
		$emailSent = true;
		// Enter data to database //
		//$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
		//mysql_select_db($database, $linkID) or die("Could not find database."); 
				
		
		
		
				
		//$query = "INSERT INTO $ctable VALUES ('','$firstname','$lastname', '$occupation','$email', '$subject', '$address', '$city', '$state', '$zip', '$phone', '$message', '')";
		//mysql_query($query);
		//print $query;		
		//mysql_close();
		
		$firstname = "";
		$lastname = "";
		$customerID = "";
		$business = "";
		$email = "";
		$address = "";
		$city = "";
		$state = "";
		$zip = "";
		$phone = "";
		$message = "";
	
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
			customerID: "required",
			business: "required",
			firstname: "required",
			//lastname: "required",
			//occupation: "required",
			address: "required",
			city: "required",
			state: "required",
			zip: "required",
			phone: "required",
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
			customerID: "Please enter your Account Number.",
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
	<div class="techText_title"><b>P.O.P. Order Form</b></div>
	<?php if(isset($hasError)) { //If errors are found ?>
		<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
	<?php } ?>

	<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
		<p class="confirm"><strong>Email Successfully Sent!</strong><br>
		Thank you for requesting Alegria P.O.P! Your email was successfully sent and we will process your request shortly. Please check your spam folder for the confirmation email if you don't see it in your inbox.</p>
	<?php } ?>

	<form method="post" action="index.php" id="contactform">
		<div class="catalogCol">
        <div>
		    <label for="name"><strong>Contact Person *</strong></label>
			<input type="text" size="50" name="firstname" id="firstname" value="<?php echo $firstname?>" class="text required" />
		</div>
		
       <div>
		    <label for="account"><strong>Customer ID *</strong></label>
			<input type="text" size="50" name="customerID" id="customerID" value="<?php echo $customerID?>" class="text required" />
		</div>
        <div>
		    <label for="account"><strong>Business Name *</strong></label>
			<input type="text" size="50" name="business" id="business" value="<?php echo $business?>" class="text required" />
		</div>
		<div>
			<label for="email"><strong>Email *</strong></label>
			<input type="text" size="50" name="email" id="email" value="<?php echo $email?>" class="text required email" />
		</div>
        <div>
			<label for="email"><strong>Confirm Email *</strong></label>
			<input type="text" size="50" name="confirm_email" id="confirm_email" class="text required email" />
		</div>
       </div>

        <div class="catalogCol">
           
            <div>
                <label for="address"><strong>Shipping Address *</strong></label>
                <input type="text" size="50" name="address" id="address" value="<?php echo $address ?>" class="text required"/>
            </div>
            <div>
                <label for="city"><strong>City *</strong></label>
                <input type="text" size="50" name="city" id="city" value="<?php echo $city ?>" class="text required"/>
            </div>
             <div>
                <label for="state"><strong>State *</strong></label>
                <select class="select required text" id="state" name="state">
                    <option value="" selected> Select a State</option><option value="AK">AK - Alaska</option><option value="AL">AL - Alabama</option><option value="AR">AR - Arkansas</option><option value="AZ">AZ - Arizona</option><option value="CA">CA - California</option><option value="CO">CO - Colorado</option><option value="CT">CT - Connecticut</option><option value="DC">DC - District of Columbia</option><option value="DE">DE - Delaware</option><option value="FL">FL - Florida</option><option value="GA">GA - Georgia</option><option value="HI">HI - Hawaii</option><option value="IA">IA - Iowa</option><option value="ID">ID - Idaho</option><option value="IL">IL - Illinois</option><option value="IN">IN - Indiana</option><option value="KS">KS - Kansas</option><option value="KY">KY - Kentucky</option><option value="LA">LA - Louisiana</option><option value="MA">MA - Massachusetts</option><option value="MD">MD - Maryland</option><option value="ME">ME - Maine</option><option value="MI">MI - Michigan</option><option value="MN">MN - Minnesota</option><option value="MO">MO - Missouri</option><option value="MS">MS - Mississippi</option><option value="MT">MT - Montana</option><option value="NC">NC - North Carolina</option><option value="ND">ND - North Dakota</option><option value="NE">NE - Nebraska</option><option value="NH">NH - New Hampshire</option><option value="NJ">NJ - New Jersey</option><option value="NM">NM - New Mexico</option><option value="NV">NV - Nevada</option><option value="NY">NY - New York</option><option value="OH">OH - Ohio</option><option value="OK">OK - Oklahoma</option><option value="OR">OR - Oregon</option><option value="PA">PA - Pennsylvania</option><option value="RI">RI - Rhode Island</option><option value="SC">SC - South Carolina</option><option value="SD">SD - South Dakota</option><option value="TN">TN - Tennessee</option><option value="TX">TX - Texas</option><option value="UT">UT - Utah</option><option value="VA">VA - Virginia</option><option value="VT">VT - Vermont</option><option value="WA">WA - Washington</option><option value="WI">WI - Wisconsin</option><option value="WV">WV - West Virginia</option><option value="WY">WY - Wyoming</option>
               
                </select>
            </div>
             <div>
                <label for="zip"><strong>Zip *</strong></label>
                <input type="text" size="50" name="zip" id="zip" value="<?php echo $zip ?>" class="text required"/>
            </div>
        
        <div>
			<label for="phone"><strong>Phone Number *</strong></label>
			<input type="text" size="50" name="phone" id="phone" value="<?php echo $phone ?>" class="text required"/>
		</div>
        
        
        
       
        
        
        </div><!-- EOF catalogaddress -->
    
  <div class="catalogCol" style="width:300px">
           
            
        
        <div>
			
          <table width="214" border="0" cellspacing="0" cellpadding="0" class="menuTable">
  <tr>
  	<td height="34" colspan="2"><label><strong>P.O.P Materials *</strong> <span class="fineprint">(scroll down to see image)</span></label>
    </td>
  </tr>          
  <tr>
  <td><strong style="color:#666;">Item</strong></td>
    <td><strong style="color:#666;">Qty</strong></td>
  </tr>
  <tr>
    <td width="129">POP Tent Card</td>
    <td width="169">
      <select name="pop1" id="pop1">
      		<option value="0" selected>-</option>
      		<option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
      </select> Set(s) of 4    </td>
  </tr>
  <tr>
    <td>Floor Sticker</td>
    <td><select name="pop2" id="pop2">
    		<option value="0" selected>-</option>
      		<option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
      </select></td>
  </tr>
  <tr>
    <td>Hanging Sign</td>
    <td><select name="pop3" id="pop3">
      		<option value="0" selected>-</option>
      		<option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
      </select></td>
  </tr>
  <tr>
    <td>LED Light Box</td>
    <td><select name="pop4" id="pop4">
      		<option value="0" selected>-</option>
      		<option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
      </select></td>
  </tr>
  <tr>
    <td height="27">Catalogs</td>
    <td><input name="pop5" id="pop5" type="text" size="5"/></td>
  </tr>
  <tr>
  <td height="47" colspan="2" valign="bottom" class="fineprint">
<br />
If you'd like to order more than 3 of the tent cards, floor stickers, hanging sign and light box, please contact your sales.</td>
  </tr>
</table>

		

		</div>
        
        <div>
        <input type="submit" value="Submit" name="submit" class="text"/>
        </div>
        
        
        </div>
		

		
	    
	</form>
	</div><!-- EOD contact-wrapper -->
