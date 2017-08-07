<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="googlebot" content="noindex, noarchive, nofollow">
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
		<title>Nursing Scholarship Application</title>  
		<!-- <link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/> -->
		<link rel="stylesheet" href="../includes/bootstrap/bootstrap.min.css">
		<script language="javascript" type="text/javascript" src="../includes/bootstrap/bootstrap.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
		<script src="../includes/js/jquery.validate.pack.js" type="text/javascript"></script>
		<script src="../includes/js/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>

		<style type="text/css">
		form#contactform label.error {
			color:#DD0000;
			padding-top:3px;
			font-size:11px;
		}
		form#contactform input.error, 
		form#contactform textarea.error{
			
			border:1px solid #DD0000;
		}
		</style>

		<?php

		require("../includes/resource/db.php");

		//If the form is submitted
		if(isset($_POST['submit'])) {

			$name 		= trim($_POST['name']);
			$address 	= trim($_POST['address']);
			$city 		= trim($_POST['city']);
			$state 		= trim($_POST['state']);
			$zip 		= trim($_POST['zip']);
			$phone 		= trim($_POST['phone']);
			$email 		= trim($_POST['email']);
			$size 		= trim($_POST['size']);
			$college 	= trim($_POST['college']);
			$degree 	= trim($_POST['degree']);
			$gradDateMonth 	= trim($_POST['gradDateMonth']);
			$gradDateYear 	= trim($_POST['gradDateYear']);
			$id 		= trim($_POST['id']);
			$extra1 	= trim($_POST['extra1']);
			$extra2 	= trim($_POST['extra2']);
			$extra3 	= trim($_POST['extra3']);
			$extra4 	= trim($_POST['extra4']);
			$extra5 	= trim($_POST['extra5']);
			$essay 		= stripslashes(trim($_POST['essay']));
			$agreementName 	= trim($_POST['agreementName']);
			$signature 	= trim($_POST['signature']);
			$date	 	= date('m-d-Y');

			//If there is no error, send the email
			if(!isset($hasError)) {
				$emailTo = "andrew@peppergate.com, caitlin@peppergate.com,".$email;
				$subj = "Scholarship Application - ".$name." - ".$date;
				$body = '<table width="400" border="0" cellspacing="0" cellpadding="0">
							 <tr>
								<td width="100" valign="top">Name:</td>
								<td width="300" valign="top">'.$name.'</td>
							</tr><br />
							<tr>
								<td valign="top">Address:</td>
								<td valign="top">'.$address.', '.$city.', '.$state.', '.$zip.'</td>
							</tr><br />
							<tr>
								<td valign="top">Phone Number:</td>
								<td valign="top">'.$phone.'</td>
							</tr><br />
							<tr>
								<td valign="top">E-mail:</td>
								<td valign="top">'.$email.'</td>
							</tr><br />
							<tr>
								<td valign="top">Size:</td>
								<td valign="top">'.$size.'</td>
							</tr><br />
							<tr>
								<td valign="top">College:</td>
								<td valign="top">'.$college.'</td>
							</tr><br />				
							<tr>
								<td valign="top">Degree:</td>
								<td valign="top">'.$degree.'</td>
							</tr><br />
							<tr>
								<td valign="top">Graduation Date:</td>
								<td valign="top">'.$gradDateMonth.'/'.$gradDateYear.'</td>
							</tr><br />
							<tr>
								<td valign="top">Student ID:</td>
								<td valign="top">'.$id.'</td>
							</tr><br />				
							<tr>
								<td valign="top">Extracurricular 1:</td>
								<td valign="top">'.$extra1.'</td>
							</tr><br />
							<tr>
								<td valign="top">Extracurricular 2:</td>
								<td valign="top">'.$extra2.'</td>
							</tr><br />
							<tr>
								<td valign="top">Extracurricular 3:</td>
								<td valign="top">'.$extra3.'</td>
							</tr><br />
							<tr>
								<td valign="top">Extracurricular 4:</td>
								<td valign="top">'.$extra4.'</td>
							</tr><br />
							<tr>
								<td valign="top">Extracurricular 5:</td>
								<td valign="top">'.$extra5.'</td>
							</tr><br />
							<tr>
								<td valign="top">Essay:</td>
								<td valign="top">'.$essay.'</td>
							</tr><br />
							<tr>
								<td valign="top">Agreement Accepted:</td>
								<td valign="top">'.$agreementName.'</td>
							</tr><br />
							<tr>
								<td valign="top">Signature:</td>
								<td valign="top">'.$signature.'</td>
							</tr><br />
							<tr>
								<td valign="top">Date:</td>
								<td valign="top">'.$date.'</td>
							</tr>
						  
						</table><br><br>';
				
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				// Additional headers
				$headers .= "From: $name <$email>\r\n";
				$headers .= "Reply-To: $email";
				
				mail($emailTo, $subj, $body, $headers);
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
				
						
				$query = "INSERT INTO $stable VALUES ('','$name',
														'$address',
														'$city',
														'$state',
														'$zip',
														'$phone',
														'$email',
														'$size',
														'$college',
														'$degree',
														'$gradDateMonth-$gradDateYear',
														'$id',
														'$extraCurricular1',
														'$extraCurricular2',
														'$extraCurricular3',
														'$extraCurricular4',
														'$extraCurricular5',
														'$essay',
														'$signature',
														'$date')";
				mysql_query($query);
				//print $query;		
				mysql_close();

				$name 		= "";
				$address 	= "";
				$city 		= "";
				$state 		= "";
				$zip 		= "";
				$phone 		= "";
				$email 		= "";
				$size 		= "";
				$college 	= "";
				$degree 	= "";
				$gradDateMonth 	= "";
				$gradDateYear 	= "";
				$id 		= "";
				$extra1 	= "";
				$extra2 	= "";
				$extra3 	= "";
				$extra4 	= "";
				$extra5 	= "";
				$essay 		= "";
				$agreementName 	= "";
				$signature 	= "";
				
			}
		}
		?>

<script type="text/javascript">
$(document).ready(function(){
	$("#contactform").validate({
		rules: {
			name: "required",
			address: "required",
			city: "required",
			state:"required",
			zip:"required",
			phone: "required",
			college: "required",
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
			degree: "required",
			id: "required",
			essay: "required",
			agreementName: "required",
			signature: "required"
		},
		messages: {
			name: "Please enter your Full Name",
			address: "Please enter your Address",
			city: "Please enter your City",
			state: "Please enter your State (2 letter abbrv.)",
			zip: "Please enter your zip",
			phone: "Please enter your Phone Number",
			college: "Please enter your current College",
			email: "Please enter a valid Email Address",
			confirm_email: {
				equalTo: "Please enter the same email as above"
			},
			degree: "Please enter your pursuing Degree",
			id: "Please enter your Student ID",
			essay: "Please enter your essay under 1000 words",
			agreementName: "Please enter your Full Name",
			signature: "Please authorize your Electronic Signature"
		}
		
	});
});
</script>

	</head>

	<body>
		<div class="container">
			<div class="row no-border">
				<p><h2 style="text-transform:none">Since 2008, Alegria by PG Lite® has been the shoe of choice 
					for nurses around the country. We are grateful for the love and support of the nurse 
					community and would like to provide a $2,500.00 scholarship fund to an aspiring nurse who 
					has chosen a career dedicated to caring for those in need.</h2></p>
				<p style="color:red"><b>DEADLINE: March 31, 2015</b></p>
			</div>

			<?php if(isset($hasError)) { //If errors are found ?>
				<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
			<?php } ?>


			<form method="post" action="nursing_scholarship_application.php" class="form-horizontal" id="contactform">
				<div class="row">
					<h2>Applicant Information</h2>
					<div class="form-group">
						<label for="fullName" class="col-sm-2 control-label">Full Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control required" id="name" name="name"
							value="<?php echo $name?>" placeholder="Enter Full Name" />
						</div>
					</div>

					<div class="form-group">
						<label for="address" class="col-sm-2 control-label">Address</label>
						<div class="col-sm-10">
							<input type="text" class="form-control required" id="address" name="address"
							value="<?php echo $address?>" placeholder="Enter Address" />
						</div>
					</div>

					<div class="form-group">
						<label for="city" class="col-sm-2 control-label">City</label>
						<div class="col-sm-3">
							<input type="text" class="form-control required" id="city" name="city"
							value="<?php echo $city?>" placeholder="Enter City" />
						</div>
						<label for="city" class="col-sm-1 control-label">State</label>
						<div class="col-sm-2">
							<input type="text" class="form-control required" id="state" name="state"
							value="<?php echo $state?>" placeholder="Enter State" />
						</div>
						<label for="city" class="col-sm-1 control-label">Zip</label>
						<div class="col-sm-2">
							<input type="text" class="form-control required" id="zip" name="zip"
							value="<?php echo $zip?>" placeholder="Enter Zip" />
						</div>
					</div>

					<div class="form-group">
						<label for="phone" class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-10">
							<input type="text" class="form-control required" id="phone" name="phone"
							value="<?php echo $phone?>" placeholder="Enter Phone">
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">E-Mail Address</label>
						<div class="col-sm-10">
							<input type="text" class="form-control required email" id="email" name="email"
							value="<?php echo $email?>" placeholder="Enter e-mail Address" />
						</div>
					</div>
					<div class="form-group">
						<label for="confirm_email" class="col-sm-2 control-label">Confirm E-Mail Address</label>
						<div class="col-sm-10">
							<input type="text" class="form-control required email" id="confirm_email" 
							name="confirm_email" placeholder="ReEnter e-mail Address" />
						</div>
					</div>

					<div class="form-group">
						<label for="size" class="col-sm-2 control-label">Shoe Size</label>
						<div class="col-sm-10">
							<select name="size" id="size" value="<?php echo $size?>" />
								<option value="w34">Women's - Size 34</option>
								<option value="w35">Women's - Size 35</option>
								<option value="w36">Women's - Size 36</option>
								<option value="w37">Women's - Size 37</option>
								<option value="w38">Women's - Size 38</option>
								<option value="w39">Women's - Size 39</option>
								<option value="w40">Women's - Size 40</option>
								<option value="w41">Women's - Size 41</option>
								<option value="w42">Women's - Size 42</option>
								<option value="w43">Women's - Size 43</option>
								<option value="m40">Men's - Size 40</option>
								<option value="m41">Men's - Size 41</option>
								<option value="m42">Men's - Size 42</option>
								<option value="m43">Men's - Size 43</option>
								<option value="m44">Men's - Size 44</option>
								<option value="m45">Men's - Size 45</option>
								<option value="m46">Men's - Size 46</option>
								<option value="m47">Men's - Size 47</option>
								<option value="m48">Men's - Size 48</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<h2>College/University Information</h2>
					<div class="form-group">
						<label for="college" class="col-sm-2 control-label">Current College</label>
						<div class="col-sm-10">
							<input type="text" class="form-control required" id="college" name="college"
							value="<?php echo $college?>" placeholder="Enter Current College" />
						</div>
					</div>

					<div class="form-group">
						<label for="degree" class="col-sm-2 control-label">Degree Pursuing</label>
						<div class="col-sm-10">
							<input type="text" class="form-control required" id="degree" name="degree"
							value="<?php echo $degree?>" placeholder="Enter Current Degree" />
						</div>
					</div>

					<div class="form-group">
						<label for="gradDate" class="col-sm-2 control-label">Expected Graduation Date</label>
						<div class="col-sm-10">
							<select id="gradDateMonth" name="gradDateMonth" value="<?php echo $gradDateMonth?>" />
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">Novemeber</option>
								<option value="12">December</option>
							</select>
			<!-- 				<select>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select> -->
							<select id="gradDateYear" name="gradDateYear" value="<?php echo $gradDateYear?>">
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="id" class="col-sm-2 control-label">School ID</label>
						<div class="col-sm-10">
							<input type="text" class="form-control required" id="id" name="id"
							value="<?php echo $id?>" placeholder="Enter ID Number" />
						</div>
					</div>
				</div>

				<div class="row">
					<h2>Extracurricular</h2>
					<p>Please list up to your top five professional leadership activities/organizations, Honors/Awards, 
						and community or volunteer events you have participated in.</p>
					<div class="form-group col-sm-12">
						<input type="text" class="form-control" id="extra1" name="extra1" />
						<br />
						<input type="text" class="form-control" id="extra2" name="extra2" />
						<br />
						<input type="text" class="form-control" id="extra3" name="extra3" />
						<br />
						<input type="text" class="form-control" id="extra4" name="extra4" />
						<br />
						<input type="text" class="form-control" id="extra5" name="extra5" />
					</div>
				</div>


				<div class="row">
					<h2>Essay</h2>
					<p>In the space allotted, please answer in <strong>1000 words or less</strong>: Why would becoming a nurse make you happy?</p>
					<textarea rows="20" cols="100" id="essay" class="required" value="<?php echo $essay?>" name="essay" />
						Enter essay here. We recommend writing it in a word processor and pasting it into this field when 
						you are finished to prevent losing your work on accident.</textarea>
				</div>
				<div class="row">
					<h2>Judges' Criteria</h2>
					<ul>
						<li>Overall applicant profile</li>
						<li>Original content, creativity, thoughtfulness, and insight of essay</li>
						<li>Essays with poor grammar, spelling, and lack of proofreading will not be considered.
							Plagiarism will not be tolerated and will result in immediate disqualification.</li>
					</ul>
				</div>
				<div class="row">
					<h2>Our Policy</h2>
					<div style="margin: auto; height: 400px; max-width: 920px; border: 1px solid #ccc; overflow: auto;"><img style="max-width: 800px; max-height: 100px; display: block; margin-left: auto; margin-right: auto;" src="http://dealer.alegriashoes.com/images/letterhead.jpg" alt="" /> <br /><br />
					<h2 style="text-align: center;">ALEGRIA BY PG LITE&reg;</h2>
					<h3 style="text-align: center;">NURSING SCHOLARSHIP CONTEST RULES, TERMS &amp; CONDITIONS</h3>
					<p>&nbsp;</p>
					<p style="text-align: justify;">IMPORTANT:&nbsp; Please read these Rules, Terms &amp; Conditions (collectively, &ldquo;Rules&rdquo;) before uploading a submission for the Alegria by PG Lite&reg; Nursing Scholarship Contest ("Contest"). By uploading the submission for the Contest, entrant agrees to be bound by these Rules and represents that entrant satisfies all of the eligibility requirements below.&nbsp;</p>
					<p style="text-align: justify;">NO PURCHASE NECESSARY. VOID WHERE PROHIBITED. ALL SCHOLARSHIPS ARE AWARDED SUBJECT TO RESTRICTIONS AND CRITERIA, AND THE WINNERS&rsquo; MAINTAINING ELIGIBILITY REQUIREMENTS, AS DEFINED HEREIN.&nbsp;</p>
					<p style="text-align: justify;">1. Eligibility.&nbsp;&nbsp;Purchase will not increase odds of winning.&nbsp; The Contest is open only to legal residents of the fifty (50) United States and the District of Columbia who are: (1) at least eighteen (18) years of age; (2) currently enrolled at an accredited college or university in the United States; and (3) pursuing a degree in nursing.&nbsp; If entrant does not meet any of these requirements or any other eligibility requirements in these Rules, entrant is not eligible to win the Contest, and Pepper Gate Footwear, Inc. ("PEPPER GATE&rdquo;) reserves the right not to award any scholarship or prize to entrant.&nbsp;&nbsp; If entrant has an APO or FPO mailing address, entrant must identify his/her state of permanent residence. Submissions must be from individuals only; groups, organizations and multiple-party submissions are not eligible. To be eligible to win the scholarship, submissions must be completed and received by PEPPER GATE in the manner and format designated below.&nbsp; Directors, officers and employees of PEPPER GATE and any of their respective affiliate companies, subsidiaries, agents, professional advisors, advertising and promotional agencies, and immediate families of each are not eligible to win any prizes.&nbsp; All applicable U.S. federal, state, and local laws and regulations apply.&nbsp; Offer void where prohibited by law.</p>
					<p style="text-align: justify;">2. Disclaimer.&nbsp;&nbsp;PEPPER GATE, Facebook, Inc., any participating sponsors, and any of their respective parent companies, subsidiaries, affiliates, directors, officers, professional advisors, employees and agencies (collectively, the "Released Parties") will not be responsible for: (a) any late, lost, misrouted, garbled or distorted or damaged transmissions, submissions or entries; (b) telephone, electronic, hardware, software, network, Internet, or other computer- or communications-related malfunctions or failures; (c) any Contest disruptions, injuries, losses or damages caused by events beyond the control of PEPPER GATE or by non-authorized human intervention; or (d) any printing or typographical errors in any materials associated with the Contest.</p>
					<p style="text-align: justify;">3. Contest Period.&nbsp;&nbsp;The Contest starts on February 16, 2015 at 12:00 A.M. Pacific Standard Time (&ldquo;PST&rdquo;) and ends on March 31, 2015 at 11:59 P.M. PST ("Contest Period").&nbsp; All submissions must be received during the Contest Period to be eligible to win a prize.&nbsp; PEPPER GATE&rsquo;s computer is the official time-keeping device for the Contest.</p>
					<p style="text-align: justify;">4. How to Enter. &nbsp;During the Contest Period, visit the Alegria by PG Lite&reg; website Contest page at www.alegriashoes.com/scholarship and follow the instructions on how to complete and upload your submission.&nbsp; PEPPER GATE has the right to display all submissions, and any information contained therein, on any Alegria by PG Lite&reg;-associated social media, including but not limited to the Alegria by PG Lite&reg; website at www.alegriashoes.com and the Alegria by PG Lite&reg; Facebook page at www.facebook.com/alegriashoes. By uploading his/her submission, entrant agrees that his/her submission conforms to the Submission Guidelines and Content Restrictions listed below (collectively, the &ldquo;Guidelines and Restrictions&rdquo;) and that PEPPER GATE, in its sole discretion, may remove entrant&rsquo;s submission and disqualify entrant from the Contest if it believes, in its sole discretion, that entrant&rsquo;s submission fails to conform to the Guidelines and Restrictions.&nbsp; By uploading his/her submission, in addition to rights granted below, entrant: (a)&nbsp;grants to PEPPER GATE all rights necessary to display entrant&rsquo;s submission, and any information contained therein, on any Alegria by PG Lite&reg;-associated social media, including but not limited to the Alegria by PG Lite&reg; website at www.alegriashoes.com and the Alegria by PG Lite&reg; Facebook page at www.facebook.com/alegriashoes; (b)&nbsp;hereby waives any so-called moral (e.g., creative rights) in entrant&rsquo;s submission; (c)&nbsp;represents and warrants that entrant has the right to grant the rights granted in these Rules; and (d)&nbsp;represents and warrants that entrant&rsquo;s submission and its use as contemplated in these Rules does not and will not violate, misappropriate, or infringe upon any law or regulation or the rights of any third party, including any copyright, trademark, or any rights of publicity or privacy, or any other intellectual property or proprietary rights.</p>
					<p style="text-align: justify;">5. Submission Guidelines. A submission is an application, available at www.alegriashoes.com/scholarship, completed, electronically signed, and comprised of the following information: (1) the applicant&rsquo;s name, street address, city, state, zip code, phone, and e-mail address; (2) current college or university, degree pursued, and expected graduation date; (3) extracurricular activities; and (4) an essay, in the space allotted, on the question of &ldquo;Why would becoming a nurse make you happy?&rdquo; The submission must be the entrant&rsquo;s original creation and one-hundred percent (100%) owned by the entrant. The submission must not have been submitted previously in a promotion or contest of any kind or exhibited or displayed publicly through any means. Limit one (1) submission per entrant during the Contest Period; submissions received from any person or e-mail address in excess of the stated limit will be void.&nbsp; By uploading a submission, entrant grants to PEPPER GATE, its licensees, and assigns a royalty-free, irrevocable, perpetual, and non-exclusive license to use, reproduce, modify, publish, create derivative works from, and display such submissions, in whole or in part, and otherwise exploit the submission in all media now known or hereafter devised, throughout the universe, in any way PEPPER GATE sees fit including, but not limited to, entertainment, instruction/education, promotional, advertising and/or marketing purposes.&nbsp; In connection with all rights granted herein, PEPPER GATE, its licensees, and assigns shall also have the irrevocable right to incorporate submissions, in whole or in part, into other works, in any form, media or technology now known or hereafter developed.&nbsp; If necessary, entrant will sign any necessary documentation that may be required for PEPPER GATE or its designees to make use of the non-exclusive rights entrant is granting to use the submission.&nbsp; Proof of submission will not be deemed proof of receipt by PEPPER GATE.</p>
					<p style="text-align: justify;">6. Content Restrictions. The submission must not: (1) contain material that violates, misappropriates, or infringes upon any law or regulation, or the rights of any third party, including any copyright, trademark, or any rights of publicity or privacy, or any other intellectual property or proprietary rights; (2) disparage any person or entity, to be determined at PEPPER GATE&rsquo;s sole and absolute discretion; (3) contain any material that is inappropriate, indecent, obscene, hateful, tortious, and/or defamatory, to be determined at PEPPER GATE&rsquo;s sole and absolute discretion; (4) contain material that promotes bigotry, racism, hatred or harm against any group or individual or promotes discrimination based on race, gender, religion, nationality, disability, sexual orientation or age, to be determined at PEPPER GATE&rsquo;s sole and absolute discretion; or (5) contain material that is unlawful, in violation of or contrary to the laws or regulations in any jurisdiction where the submission is created.</p>
					<p style="text-align: justify;">7. Selection and Notification of Winner.&nbsp; PEPPER GATE reserves the absolute right, in its sole discretion, to determine which submission will win.&nbsp; Selection of the winning submission by PEPPER GATE will be based on the following criteria (&ldquo;Judging Criteria&rdquo;): (a)&nbsp;overall applicant profile; and (b)&nbsp;original content, creativity, thoughtfulness, and insightfulness of essay.&nbsp; The winner will be notified on or about April 15, 2015 via e-mail and/or telephone.&nbsp; To claim the prize, the winner must follow the instructions contained in his/her notification e-mail and/or telephone.</p>
					<p style="text-align: justify;">8. Identity of Entrant.&nbsp;If a dispute arises about the identity of the entrant, entries will be declared made by the authorized account holder of the e-mail account associated with the submission at time of entry, and only the authorized account holder shall be deemed the winner of the Contest if his/her submission is deemed a winning submission.&nbsp; An authorized account holder is defined as the natural person who is assigned to an e-mail account by the associated e-mail address provider.&nbsp; The potential winner may be required to provide PEPPER GATE with proof that the potential winner is the authorized account holder of the e-mail account associated with the winning submission.</p>
					<p style="text-align: justify;">9. Prize. &nbsp;For the winning submission, the prize consists of the following: (1) a one-time, two-thousand and five-hundred dollar ($2,500) nursing scholarship; and (2) one (1) free pair of Alegria by PG Lite&reg; shoes (total approximate retail value $129.95) (collectively &ldquo;Prize&rdquo;). &nbsp;If his/her submission wins, entrant acknowledges and agrees that the scholarship monies must be: (a) expended in the then-current school calendar period (i.e., semester or quarter) in which they are awarded; (b) issued solely in the form of a check made payable to the college or university listed on entrant&rsquo;s application; and (c) applied to qualified educational expenses only (tuition, school fees, books, on-campus housing). ALL FEDERAL, STATE AND LOCAL TAXES ASSOCIATED WITH THE RECEIPT AND/OR USE OF THE PRIZE ARE THE SOLE RESPONSIBILITY OF THE WINNER.&nbsp;&nbsp;The Prize will be awarded.&nbsp; If the Prize is returned as undeliverable or otherwise not claimed within ten (10) days after delivery of notification, the Prize will be forfeited and awarded to an alternate winner.&nbsp; The Prize is not transferable and may not be used with any other promotional discount.&nbsp; No substitutions or exchanges (including for cash) of the Prize will be permitted, except that PEPPER GATE reserves the right to substitute a Prize of comparable or greater value for the Prize.&nbsp; THE PRIZE IS AWARDED "AS IS" AND WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, (INCLUDING, WITHOUT LIMITATION, ANY IMPLIED WARRANTY OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE). &nbsp;</p>
					<p style="text-align: justify;">10. No Facebook Endorsement.&nbsp;&nbsp;This Contest is in no way sponsored, endorsed, or administered by, or associated with Facebook, Inc. &nbsp;Any information you provide in connection with the Contest is to PEPPER GATE and/or its sponsors/administrators and not to Facebook.&nbsp; You understand that by using and interacting with&nbsp;www.facebook.com, you are subject to the terms, conditions, and policies that govern the use of www.facebook.com.&nbsp; You should therefore review the applicable terms and policies for www.facebook.com, including privacy and data gathering practices, before using or interacting with Facebook.&nbsp;</p>
					<p style="text-align: justify;">11. General Release.&nbsp; By entering the Contest, you release PEPPER GATE and all Released Parties from any liability whatsoever, and waive any and all causes of action, for any claims, costs, injuries, losses, or damages of any kind arising out of or in connection with the Contest or delivery, mis-delivery, acceptance, possession, or use of or inability to use any Prize (including, without limitation, claims, costs, injuries, losses and damages related to personal injuries, death, damage to or destruction of property, rights of publicity or privacy, defamation or portrayal in a false light, whether intentional or unintentional), whether under a theory of contract, tort (including negligence), warranty or other theory.</p>
					<p style="text-align: justify;">12. Publicity Rights.&nbsp;&nbsp;Except where prohibited by law, entrant acknowledges and agrees that by uploading a submission for the Contest, entrant grants PEPPER GATE the permission and consent to use entrant&rsquo;s name, Facebook name, likeness, biographical data, and/or any information contained in his/her submission in all media now known or later devised throughout the universe in perpetuity for all purposes PEPPER GATE deems appropriate - including, without limitation, for promotional, advertising, marketing and publicity purposes without further permission, notice, review, approval or compensation.&nbsp; Nothing contained in these Rules obligates PEPPER GATE to make use of any of the rights granted herein, and entrant waives any right to inspect or approve any such use.</p>
					<p style="text-align: justify;">13. Affidavit and Release.&nbsp; As a condition of being awarded any Prize, entrant may (in PEPPER GATE's sole discretion) be required to execute and deliver to PEPPER GATE a signed affidavit of eligibility, acceptance of these Rules, release of liability, and any other legal, regulatory, or tax-related documents required by PEPPER GATE in its sole discretion.</p>
					<p style="text-align: justify;">14. Winner List; Rules Request.&nbsp;&nbsp;For the Winner List, entrant is to send an email with subject line: &ldquo;ALEGRIA BY PG LITE&reg; Nursing Scholarship Winner List Request&rdquo; to Caitlin@peppergate.com, specifying entrant&rsquo;s name and date of submission.&nbsp; To obtain a copy of these Rules, send an email with subject line: &ldquo;ALEGRIA BY PG LITE&reg; Nursing Scholarship Rules Request&rdquo; to Caitlin@peppergate.com.</p>
					<p style="text-align: justify;">15. Intellectual Property Notice.&nbsp;&nbsp;PEPPER GATE&reg;, ALEGRIA BY PG LITE&reg;, and THIS IS WHAT HAPPY LOOKS LIKE&reg; are trademarks of&nbsp;PEPPER GATE. All rights reserved.</p>
					<p style="text-align: justify;">16. Miscellaneous.&nbsp;&nbsp;The Contest and these Rules will be governed, construed, and interpreted under the laws of the State of California, U.S.A.&nbsp; Any legal action, suit, proceeding or dispute in connection with this Contest will be brought and resolved exclusively in the state or federal courts of San Bernardino County in the State of California and each entrant accepts and submits to the personal jurisdiction of these courts with respect to any legal actions, suits, proceedings or disputes arising out of or related to the Contest. Entrants agree to be bound by these Rules and by the decisions of PEPPER GATE, which are final and binding in all respects.&nbsp; PEPPER GATE reserves the right to change these Rules at any time, in its sole discretion, and to suspend or cancel the Contest or any entrant's participation in the Contest should viruses, bugs, unauthorized human intervention, or other causes beyond PEPPER GATE's control affect the administration, security or proper play of the Contest, or PEPPER GATE otherwise becomes (as determined in its sole and absolute discretion) incapable of running the Contest as planned, in which event the Prize will be awarded via the judging process outlined in these Rules, from among all eligible entries received prior to cancellation.&nbsp; Notwithstanding the foregoing, PEPPER GATE reserves the right to amend, modify, or cancel the Contest at any time without notice.&nbsp; Entrants who violate these Rules; violate any law, rule, or regulation in connection with participation in the Contest; tamper with the operation of the Contest or engage in any conduct that is detrimental or unfair to PEPPER GATE, the Contest, or any other entrant (in each case as determined in PEPPER GATE's sole and absolute discretion) are subject to disqualification from entry into the Contest.&nbsp; PEPPER GATE reserves the right to lock out persons whose eligibility is in question or who have been disqualified or are otherwise ineligible to enter the Contest.&nbsp; Any provision of these Rules deemed unenforceable will be enforced to the extent permissible, and the remainder of these Rules will remain in effect.&nbsp; If you have any questions about these Rules or the Contest, please email them to Caitlin@peppergate.com or send written questions to&nbsp;ALEGRIA BY PG LITE&reg; Nursing Scholarship Contest Questions, Pepper Gate Footwear, Inc., 910 S. Wanamaker Avenue, Ontario, CA&nbsp; 91761.&nbsp;</p>
					<p style="text-align: justify;">17. Contest Sponsor:&nbsp;Pepper Gate Footwear, Inc., 910 S. Wanamaker Avenue, Ontario, CA&nbsp; 91761.&nbsp; PEPPER GATE is a distributor of quality comfort footwear.</p>
				</div>

				<div class="row">
					<h2>Agreement and Signature</h2>
					<p>By submitting this application, I affirm that the facts set forth in it are true and complete. I understand that
						if I am accepted as an applicant, any false statements, omissions, or other misrepresentations made by me on
						this application may result in my immediate disqualification.</p>

					<div class="form-group">
						<label for="agreementName" class="col-sm-2 control-label">Full Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control required" id="agreementName" name="agreementName"
							value="<?php echo $agreementName?>" placeholder="Enter Full Name" />
						</div>
					</div>
					<div class="form-group">
						<label for="signature" class="col-sm-2 control-label">Electronic Signature</label>
						<div class="col-sm-10">
							<input type="text" class="form-control required" id="signature" name="signature"
							value="<?php echo $signature?>" placeholder="Enter Full Name" />
						</div>
					</div>
					<div class="form-group">
						<label for="date" class="col-sm-2 control-label">Date</label>
						<div class="col-sm-10">
							<select>
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">Novemeber</option>
								<option value="12">December</option>
							</select>
							<select>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select>
							<select>
								<option value="2015">2015</option>
							</select>
						</div>
					</div>
					<input type="submit" value="SUBMIT APPLICATION" name="submit" id="submit" class="btn-primary btn-lg btn-block" />
					<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
						<p class="confirm"><strong>Application Successfully Sent!</strong><br>
						Thank you <strong><?php echo $name;?></strong> for submitting your application! Please look to your submitted email address
						for a confirmation of your application. The review process will start after the March 31st deadline, whereby more
						information will be provided to all applicants.</p>
					<?php } ?>
				</div>
			</form>	

		</div>
	</body>

</html>