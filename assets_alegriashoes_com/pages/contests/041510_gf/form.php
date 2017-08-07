
 <?php

  require("../../includes/resource/db.php");

#########################################################################################################
# CONSTANTS																								#
# You can alter the options below																		#
#########################################################################################################
$upload_dir = "upload_pic"; 				// The directory for the images to be saved in
$upload_path = $upload_dir."/";				// The path to where the image will be saved
$large_image_prefix = ""; 			// The prefix name to large image
$thumb_image_prefix = "thumbnail_";			// The prefix name to the thumb image

$max_file = "0.5"; 							// Maximum file size in MB = 200kb
$max_width = "1000";							// Max width allowed for the large image
$thumb_width = "100";						// Width of thumbnail image
$thumb_height = "100";						// Height of thumbnail image
// Only one of these image types should be allowed for upload
$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg");
$allowed_image_ext = array_unique($allowed_image_types); // do not change this
$image_ext = "";	// initialise variable, do not change this.
foreach ($allowed_image_ext as $mime_type => $ext) {
    $image_ext.= strtoupper($ext)." ";
}

if(!is_dir($upload_dir)){
	mkdir($upload_dir, 0777);
	chmod($upload_dir, 0777);
}

$upload = "";

##########################################################################################################
# IMAGE FUNCTIONS																						 #
# You do not need to alter these functions																 #
##########################################################################################################
function resizeImage($image,$width,$height,$scale) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$image); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
    }
	
	chmod($image, 0777);
	return $image;
}


//You do not need to alter these functions
function getHeight($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}
//You do not need to alter these functions
function getWidth($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}




//If the form is submitted
if(isset($_POST['submit'])) {

		$option		= trim($_POST['option']);
		
		$firstname 	= trim($_POST['firstname']);
		$lastname 	= trim($_POST['lastname']);
		$email 		= trim($_POST['email']);
		$address 	= trim($_POST['address']);
		$city 		= trim($_POST['city']);
		$state 		= trim($_POST['state']);
		$zip		= trim($_POST['zip']);
		$phone 		= trim($_POST['phone']);
		
		if ( $_POST['postDate'] != ""){
			$postDate	= date('Y-m-d', strtotime(trim($_POST['postDate'])));
		}
		$entryDate	= date('Y-m-d H:i:s');//YYYY-MM-DD HH:MM:SS
		$message	= trim($_POST['message']);
		$fbName		= trim($_POST['fbName']);
		
		
		
		
		$userfile_name 	= $_FILES['image']['name'];
		$userfile_tmp 	= $_FILES['image']['tmp_name'];
		$userfile_size 	= $_FILES['image']['size'];
		$userfile_type 	= $_FILES['image']['type'];
		$filename 		= basename($_FILES['image']['name']);
		$file_ext 		= strtolower(substr($filename, strrpos($filename, '.') + 1));
	
		if($option == ""){
			$hasError = "";
			$errorMsg = "Please select one of the following two options to share your Photo.";			
		} else {
			unset ($hasError);
		}
	
       
		
		if ($option =="upload"){
			if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0) ) {
			  
				foreach ($allowed_image_types as $mime_type => $ext) {
					//loop through the specified image types and if they match the extension then break out
					//everything is ok so go and check file size
					if($file_ext==$ext && $userfile_type==$mime_type){
						$error = "";
						break;
					}else{
						$error = "Only <strong>".$image_ext."</strong> images accepted for upload<br />";
					}
				}
			//check if the file size is above the allowed limit
				if ($userfile_size > ($max_file*1048576)) {
					$error.= "Images must be under ".$max_file."MB in size";
				}
			
			}else{
				$error= "Select an image for upload";
			}
		}
		//Everything is ok, so we can upload the image.
		
		if(!isset($hasError) && strlen($error)==0) {//!isset($error)
		
			if (isset($_FILES['image']['name'])  && $option =="upload" ){
				
				#########################################################################################################
				$large_image_name = $large_image_prefix.$_SESSION['random_key']; // New name of the large image (append the timestamp to the filename)
				$thumb_image_name = $thumb_image_prefix.$_SESSION['random_key'];     // New name of the thumbnail image (append the timestamp to the filename)
				#########################################################################################################
				$large_image_name = $lastname."_".$large_image_name;
				//Image Locations
				$large_image_location = $upload_path.$large_image_name.$_SESSION['user_file_ext'];
				//this file could now has an unknown file extension (we hope it's one of the ones set above!)
				$large_image_location = $large_image_location.".".$file_ext;
				$thumb_image_location = $thumb_image_location.".".$file_ext;
				
				//put the file ext in the session so we know what file to look for once its uploaded
				$_SESSION['user_file_ext']=".".$file_ext;
				
				move_uploaded_file($userfile_tmp, $large_image_location);
				chmod($large_image_location, 0777);
				
				$width = getWidth($large_image_location);
				$height = getHeight($large_image_location);
				//Scale the image if it is greater than the width set above
				if ($width > $max_width){
					$scale = $max_width/$width;
					$uploaded = resizeImage($large_image_location,$width,$height,$scale);
				}else{
					$scale = 1;
					$uploaded = resizeImage($large_image_location,$width,$height,$scale);
				}
				//Delete the thumbnail file so the user can create a new one
				//if (file_exists($thumb_image_location)) {
					//unlink($thumb_image_location);
				//}
			}
		
			
		// Enter data to database //
		$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
		mysql_select_db($database, $linkID) or die("Could not find database."); 
		
		$query = "INSERT INTO contest_041510_gf VALUES ('','$firstname','$lastname','$email', '$address', '$city', '$state', '$zip', '$phone', '$option', '$message', '$large_image_name', '$fbName', '$postDate', '$entryDate')";
		mysql_query($query);
		//print $query;		
		//mysql_close();
		
		$subject = "Contest Entry - Girlfriend Getaway Contest";
		$emailTo = "leo@peppergate.com"; //Put your own email address here info@alegrishoes.com
		$body = "Name: $firstname $lastname \n\nEmail: $email \n\nPhone: $phone \n\n$option \n\n$message";
		$headers  = "From: $firstname $lastname <$email>\r\n";//"From: $firstname $lastname <$email>\nReply-To: $email";
		$headers .= "Reply-To: $email";
		
		//echo $headers;
		//echo $body;
		//echo $emailTo;
		
		mail($emailTo, $subject, $body, $headers, "-fleo@peppergate.com");
		
		$emailSent = true;
		
		$firstname 		= "";
		$lastname 		= "";
		
		$email 			= "";
		$address 		= "";
		$city 			= "";
		$state 			= "";
		$zip 			= "";
		$phone 			= "";
		$message 		= "";
		$option 		= "";
		$large_image_name = "";
		$fbName 		= "";
		$postDate		= "";
		$entryDate		= "";
		
		$_SESSION['random_key']= "";
		$_SESSION['user_file_ext']= "";
	}
}
?>


<style type="text/css">

#contact-wrapper {
	font-family:Arial, Helvetica, sans-serif;
	width:745px;
	background:#f1f1f1;
	text-align:left;
	height:auto;
	display:table;
	margin-left:110px;
	padding:0 0 0 20px;
}
#contact-wrapper p.error{
	color:#DD0000;
	font-size:12px;
	line-height:140%;
}
#contact-wrapper p.confirm{
	background:#ee2375;
	font-size:12px;
	line-height:140%;
	text-align:center;
	width:735px;
	color:#FFF;
	padding:10px 0;
	margin-top:10px;
}
#contact-wrapper p.confirm a{color:#FFF;text-decoration:underline;}
#contact-wrapper p.confirm a:hover{color:#ee2375;text-decoration:none;background:#FFF;}
p.confirm strong{font-size:16px;}

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
	width:700px;
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
	width:450px;
	height:100px;
	font-size:13px;
}
form#contactform select {
	font-size:12px;
	padding:3px;
}

form#contactform label.error {
	color:#DD0000;
	padding-top:3px;
	font-size:10px;
	line-height:110%;
}
form#contactform input.error, 
form#contactform textarea.error{
	border:1px solid #DD0000;
}


#catalogAddress div input{width:200px;}
#uploadPhoto{clear:both;float:none;}

form#contactform input#agree{width:20px;}
form#contactform input#submit{width:140px;height:42px;padding:0;margin:0;background:#883878;color:#FFF;font-weight:bold;}

input#agree span{float:left;}

#agreement label{float:left;}
</style>
<link href="../../includes/css/jquery-ui-1.8.custom.css" type="text/css" rel="stylesheet" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="../../includes/js/jquery.validate.pack.js" type="text/javascript"></script>
<script src="../../includes/js/jquery-ui-1.8.custom.min.js" type="text/javascript"></script>  
<script src="../../includes/js/jquery.MultiFile.pack.js" type="text/javascript"></script>
<script src="../../includes/js/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>

          
        
 

<script type="text/javascript">
$(document).ready(function(){
	/*jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
		phone_number = phone_number.replace(/\s+/g, ""); 
		return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
	}, "Please specify a valid phone number");*/
	
	 $("#phone").mask("(999) 999-9999");//,{placeholder:" "}



	$("#contactform").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			city: "required",
			state: "required",
			zip: {
				required: true,
				minlength: 5,
				number: true
			},
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
			phone: {
				required: true
    		},
			agree:"required"

		},
		messages: {
			firstname: "Please enter your First Name",
			lastname: "Please enter your Last Name",
			email: "Please enter a valid Email Address",
			city: "Please enter your City",
			state: "Please select a State",
			zip: "Please enter a valid Zip Code",
			confirm_email: {
				equalTo: "Please enter the same email as above"
			},
			agree: "Please accept our policy"
		}
	});
	
});




function showUpload(){
	
	$('#sharePhoto').css('display', 'none');
	$('#uploadPhoto').css('display', 'block');
	$('#uploadPhotoButton').css('display', 'none');
	$('#sharePhotoButton').css('display', 'block');
	
	$('#fbName').removeClass('required');
	$('#datepicker').removeClass('required');
	$('#photoError').css('display', 'none');
	
	$('#option').val('upload');
	
	
	
}

function showShare(){
	
	$('#sharePhoto').css('display', 'block');
	$('#uploadPhoto').css('display', 'none');
	$('#uploadPhotoButton').css('display', 'block');
	$('#sharePhotoButton').css('display', 'none');
	
	$('#fbName').addClass('required');
	$('#datepicker').addClass('required');
	
	$('#option').val('facebook');
	
	
	
	
}


</script>



<div id="contact-wrapper">
	
		<?php if(isset($errorMsg)) { //If errors are found ?>
            <p class="error"><br />
  <?= $errorMsg ?></p>
        <?php } ?>
    
        <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
            <p class="confirm">
<strong>Contest   Submitted Successfully!</strong><br>
            Thank you for entering the contest! Click <a href="http://www.alegriashoes.com/" target="_parent">here</a> to continue shopping.</p>
<?php } ?>

	<form method="post" action="http://assets.alegriashoes.com<?= $_SERVER["PHP_SELF"]?>" id="contactform" enctype="multipart/form-data" >
    			<input type="hidden" name="option" id="option" value="" />
		<div class="FloatLeft Wide">
          <div>
                <label for="name"><strong>First Name *</strong></label>
                <input type="text" size="50" name="firstname" id="firstname" value="<?php echo $firstname?>" class="required" />
          </div>
            <div>
                <label for="name"><strong>Last Name *</strong></label>
                <input type="text" size="50" name="lastname" id="lastname" value="<?php echo $lastname?>" class="required" />
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
                <label for="address"><strong>Address</strong></label>
                <input type="text" size="50" name="address" id="address" value="<?php echo $address ?>"/>
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
                <label for="phone"><strong>Phone Number *</strong></label>
                <input type="text" size="50" name="phone" id="phone" value="<?php echo $phone ?>" />
            </div>
        
        
       </div>
       <div class="FloatLeft Wider">
          <div class="FloatLeft Wide">
                   <p><img src="<?= $imgPath ?>option1_contest_041510_gf.gif" /></p>
                   
                   <p>Upload your photo directly from your computer to our website.</p>
                   <p>File Format: JPEG<br/>
                   File size: < 500 Kb<br />
                   Image Width: < 1000 px 
                   </p>
                   <p><a href="" onClick="showUpload();return false;" id="uploadPhotoButton" class="NoBg"><img src="<?= $imgPath ?>btnGo_contest_041510_gf.gif"  border=0/></a></p>
                
               <?  if(strlen($error)>0 ){
            echo "<p id='photoError' class='error'>Error! ".$option.$error."</p>";
        }?>
                   
                <span id="uploadPhoto" style="display:none;">
                      <label for=""><strong>Upload Photo</strong></label>
                      <input type="file" name="image" id="image" class="multi max-1"><!--  -->
                </span>
                    
                    
                    
        </div>
        <!-- EOF catalogaddress -->
    
        <div class="FloatLeft Wide">
           <p><img src="<?= $imgPath ?>option2_contest_041510_gf.gif" /></p>
           
           <p>Facebook Fans can share your photo on AlegriaShoes' facebook <a href="http://www.facebook.com/alegriashoes" target="_blank">fan page</a>. Then fill out the rest of this form by telling us your facebook name and the day that you shared your photo on our facebook page.</p>
         
          <p><a href="" onClick="showShare();return false;" id="sharePhotoButton" class="NoBg"><img src="<?= $imgPath ?>btnGo_contest_041510_gf.gif" border=0/></a></p>
         
       <span id="sharePhoto" style="display:none;">
           <div>
                <label for="name"><strong>Your Facebook Name*</strong></label>
                <input type="text" size="50" name="fbName" id="fbName" value="<?php echo $firstname?>"/>
           </div>
           <div>
        			<script type="text/javascript">
                        $(function() {
                            $("#datepicker").datepicker();
                        });
						
						
						
                        </script>
                    
                    
                    
                   
                    <label for="name"><strong>Date posted on Alegria fan page*</strong></label>
                    <input type="text" name="postDate" id="datepicker" value="<?php echo $postDate?>">
                    
                    <!-- End demo -->
			</div>
           </span>
           
        </div>
      <!-- EOF catalogaddress -->
      
		
			<div class="FloatLeft">
                <label for="name"><strong>Your Alegria Moment*</strong></label>
		
                  <textarea type="text" name="message" id="message" class="required"><?php echo $message?></textarea>
            
            	<div id="agreement"><label><input type="checkbox" name="agree" id="agree" /></label><p>I am over 18 years old and have read and agree to the <a href="" onclick="window.open('officialRules.php','Window1',
'menubar=no,width=430,height=360,toolbar=no,scrollbars=yes');return false;">Official Rules</a> and Alegria Shoes' <a href="http://www.alegriashoes.com/pages/Privacy-Policy.html" target="_parent">Privacy Policy</a>.</p></div>
                <div align="center">
            	<input type="submit" name="submit" value="SUBMIT" id="submit"/>
               
              </div>
                
            </div>  
        </div> <!-- eof wider -->         
	</form>
	</div><!-- EOD contact-wrapper -->

<script type="text/javascript">
$(function(){ // wait for document to load
$('#image').MultiFile(1 /*limit will be set to 5*/);
});
</script>