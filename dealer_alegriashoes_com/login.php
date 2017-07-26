<?php 
// Connects to your Database 
include ("includes/resource/db.php");
$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
mysql_select_db($database, $linkID) or die("Could not find database."); 

if (isset($_COOKIE['pw_change'])) {
	$pwsuccess = $_COOKIE['pw_change'];
}

//Checks if there is a login cookie
if(isset($_COOKIE['ID_my_site'])){ 
	
	//if there is, it logs you in and directes you to the members page
	
	$username = $_COOKIE['ID_my_site']; 
	$pass = $_COOKIE['Key_my_site'];
	$query = "SELECT * FROM accounts WHERE username = '$username'";
	$resultID = mysql_query($query, $linkID) or die("Data not found."); 

	while($info = mysql_fetch_array( $resultID )) {
		if ($pass != $info['password']) {
		}else{
			mysql_close();
			
			header("Location: index.php"); 


		}
	}
}

//if the login form is submitted
if (isset($_POST['submit'])) { // if form has been submitted
$username = $_POST['username'];
$pw = $_POST['pass'];
// makes sure they filled it in
	if(strlen($username) > 0 and !preg_match("/^[a-zA-Z0-9\_]+$/D", $username )) {
		//die('You did not fill in a required field.');
		$failMess1= "INVALID VALUE";
	} else if (strlen($username) < 1 ){
		$failMess1 = "MISSING";
	} else {
		$goodUsername = $username;
	}

	if(strlen($pw) > 0 and !preg_match("/^[a-zA-Z0-9\_\!]+$/D", $pw )) {
		//die('You did not fill in a required field.');
		$failMess2= "INVALID VALUE";
	} else if (strlen($pw) > 0 and strlen($pw) < 4 ){
		$failMess2 = "PASSWORD TOO SHORT";
	} else if (strlen($pw) > 14 ){
		$failMess2 = "PASSWORD TOO LONG";
	} else if (strlen($pw) < 1 ){
		$failMess2 = "MISSING";
	} else {
		$goodPw = stripslashes($pw);
	}

// checks it against the database

	if (!get_magic_quotes_gpc()) {
		$_POST['email'] = addslashes($_POST['email']);
	}

	if ($goodUsername and $goodPw){
		$query = "SELECT * FROM accounts WHERE username = '".$goodUsername."'";
		$resultID = mysql_query($query, $linkID) or die("after submit Data not found."); 
		
		//Gives error if user dosen't exist
		$usercheck = mysql_num_rows($resultID);
		if ($usercheck == 0) {
			$failMess0 = "The user does not exist in our database. Please contact Peppergate if you believe it to be a mistake.";
			mysql_close();
		}
		
		while($info = mysql_fetch_array( $resultID )) {
			$hashPw = md5("$goodPw");
			$password = $info['password'];
			$hour = time() + 10800; 
			
			if ($goodUsername == "alegriamedia" && $goodPw == "Newyork1!") {
				$failMess0 = "This account is no longer active. Please log in with your Peppergate Customer ID!";
			}
		//set cookie, route to change_pw if new user
			elseif ($goodPw == $password && $info['loggedin'] == 0) {
				$newhash = md5("welcome");
				setcookie(new_ID, $goodUsername, $hour); 
				setcookie(new_Key, $newhash, $hour); 
				mysql_close();
				header("Location: change_pw.php");

			}
		//gives error if the password is wrong
			elseif ($hashPw != $password) {
				$failMess0 = "The password and email address combination was not found. Please try again.";
			}
			elseif ($hashPw == $password && $info['agreement'] == 0) {
				setcookie(agreement_ID, $goodUsername, $hour); 
				setcookie(agreement_Key, $hashPw, $hour); 
				mysql_close();
				header("Location: agreement.php");
			}
			else { 
		//set cookie, route to dealer center 
				setcookie(ID_my_site, $goodUsername, $hour); 
				setcookie(Key_my_site, $hashPw, $hour); 
				mysql_close();
				header("Location: index.php"); 
			} 
		}
	} 
} else { 

// if they are not logged in 

} 

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>Alegria Dealer Center Login</title>
<noscript><meta http-equiv="refresh" content="0; URL=enableJavaScript.php"></noscript>
<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>

<style type="text/css">
.Left{float:left;width:650px;}
.Right{float:right;width:300px;}
#login { width:300px; height:auto;text-align:center;padding:0px; margin: 10px auto;border:1px solid #777;}
#loginForm h1{font-size:16px; padding:0px;}

p.error {color:red;font-weight:bold;font-size:14px;}
.contentRow .areaHeader{padding-top:20px;margin-top:20px;}
</style>
</head>

<body>

<div id="Container">
	
		
        
		<div id="Outer">
			<div id="Header">
				<?php include("navigation/topNav.php"); ?>
			</div>
						
		
            <div id="Wrapper">

				<div class="Left">
                		<div class="contentRow" style="margin-top:0px;padding-top:0px;">
                           
                            <p class="error">
                            	<?php if($_GET['error'] == 1 ){ ?>
                           
                            	Your session has expired. Please login again.
                            	
                           
                            
                            <?php } ?>
                            	
                            </p>
                            <div class="areaHeader" >Welcome to the Alegria Dealer Center!</div>
                            <p><small><i>updated: 2/22/14</i></small>
                            	<br />
                            	<b>Our user accounts system has been changed and is now personalized to you!</b> Please log in with the following:
                            	<br /><br />
                            	Username: [Your Peppergate Customer ID#]<br />
                            	<small><i>*username is case sensitive, please use uppercase "A" (A####)</i></small><br />
                            	Password: welcome
                            	<br /><br />
                            	Look forward to many improvments in the coming months to your Dealer Center experience.
                            </p>
                            <div class="areaHeader" >Tools to grow your business</div>
                            <p>Alegria Dealer Center consists of an order form, company updates, marketing assets, and legal documents and applications for all your needs as an Alegria partner.<br /></p>
                        </div>
                        <?php if($_GET['error'] == 1 ){ ?>
                        
                        <?php } else { ?>
                		<div class="contentRow" style="margin-top:0px;padding-top:0px;">
                            <div class="areaHeader" >Are you interested in becoming an Alegria Dealer?</div>
                            <p>Use the <a href="salesmap.php">Sales Map</a> to locate the right person to contact with.</p>
                        </div>
                		<div class="contentRow">
                            <div class="areaHeader" >Are you a New/Existing Dealer need access to the Dealer Center?</div>
                            <p><a href="access-request.php">Click here</a> to request login information (have your Customer ID handy)
</p>
                        </div>
                        <div class="contentRow">
                          	<div class="areaHeader" >&nbsp;</div>
                            <p>If you need further assistance, please call us at 1-800-468-5191 Monday - Friday 8 a.m - 4 p.m. PST. Our Customer Service Team is here to assist you. 
</p>
                        </div>
                        <?php } ?>
                </div>
                <div class="Right">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 
                    <div id="login" class="box">
                     <br />
                    
                    <div id="loginForm">
                        
                        <div class="fieldContent title" style="height:20px;">
                            <h1>Existing Dealer Log In Here</h1>
                        </div> 
                        <div class="errorMsg">									
                            <?php 
                            if ($failMess0) {
                                echo "<span class='alertText'>$failMess0</span>";
                            }
                            elseif ($pwsuccess) {
                                echo "<span class='alertText'>$pwsuccess</span>";
                            }
                            ?>
                        </div>
                        <div class="fieldContent">
                            <label style="float:none;display:inline" for="name">Username:</label> 
                            <input type="text" value='<?php echo $username?>' name="username" maxlength="40" class='<?php if ($failMess1) {echo "alertField";}else{echo "formfield";}?>'>	<?php if ($failMess1) {echo "<span class='alertText'>$failMess1</span>";}?>
                            
                        </div>
                        <div class="fieldContent">
                            <label style="float:none;display:inline" for="password">Password:</label>
                            <input type="password" value='<?php echo $pw?>' name="pass" maxlength="50" class='<?php if ($failMess2) {echo "alertField";}else{echo "formfield";}?>'>	 <?php if ($failMess2) {echo "<span class='alertText'>$failMess2</span>";}?> 
                            
                        </div>
                        <div class="fieldContent">
                            <label style="float:none;display:inline">&nbsp;</label>
                            <input type="submit" name="submit" value="Login"> 
                        </div>
                        <div class="fieldContent">
                            Having trouble logging in? <SCRIPT TYPE="text/javascript">
<!-- 

emailE='peppergate.com'
emailE=('benjamin' + '@' + emailE)


document.write('<A href="mailto:' + emailE + '">Email Support</a>')

 //-->
</script>
                            
                        </div>
                     </div>
                    </div>
                    </form> 
                    
                 </div><!-- EOF Right -->
		 	</div><!-- EOF Wrapper -->
 		</div><!-- EOf Outer -->
 </div><!-- EOf Container -->
 <?php include("includes/php/google.analytics.php"); ?>
</body>
</html>
