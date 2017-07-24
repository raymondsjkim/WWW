<?php 
// Connects to your Database 
include ("includes/resource/db.php");
$linkID = mysql_connect($inhost, $inuser, $inpass) or die("Could not connect to host."); 
mysql_select_db($indatabase, $linkID) or die("Could not find database."); 

//Checks if there is a login cookie
if(isset($_COOKIE['ID_sales'])){ 
	
	//if there is, it logs you in and directes you to the members page
	
	$username = $_COOKIE['ID_sales']; 
	$pass = $_COOKIE['Key_sales'];
	$query = "SELECT * FROM $inaccount WHERE USR = '$username'";
	$resultID = mysql_query($query, $linkID) or die("Data not found."); 

	while($info = mysql_fetch_array( $resultID )) {
		if ($pass != $info['PW']) {
		
		}else{
			mysql_close();
			echo "password login match";
			header("Location: index.php"); 


		}
	}
}

//if the login form is submitted
if (isset($_POST['submit'])) { // if form has been submitted
$username 	= $_POST['username'];
$pw 		= $_POST['pass'];
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
	}  else if (strlen($pw) < 1 ){
		$failMess2 = "MISSING";
	} else {
		$goodPw = $pw;
	}
// checks it against the database

	if (!get_magic_quotes_gpc()) {
		$_POST['email'] = addslashes($_POST['email']);
	}
	if ($goodUsername and $goodPw){
	
		$query = "SELECT * FROM $inaccount WHERE USR = '".$goodUsername."'";
		$resultID = mysql_query($query, $linkID) or die("after submit Data not found."); 
		//Gives error if user dosen't exist
		$check2 = mysql_num_rows($resultID);
		if ($check2 == 0) {
			//die('That user does not exist in our database. <a href=register.php>Click Here to Register</a>');
			$failMess0 = "The user does not exist in our database. Click Here to Register";
			mysql_close();
		}
		
		while($info = mysql_fetch_array( $resultID )) {
			$goodPw = stripslashes($goodPw);
			$info['PW'] = md5(stripslashes($info['PW']));
			$goodPw = md5($goodPw);
				
				
		//gives error if the password is wrong
			if ($goodPw != $info['PW']) {
				$failMess0 = "The password and username combination was not found. Please try again.";
				//die('Incorrect password, please try again.');
			}else { 
	
				// if login is ok then we add a cookie 
				$_POST['username'] = stripslashes($_POST['username']); 
				
				$hour = time() + 3600; 
				
				setcookie(ID_sales, $goodUsername, $hour); 
				setcookie(Key_sales, $goodPw, $hour); 
				setcookie(Name_sales, $info['COMP_NM'], $hour); 
				setcookie(Num_sales, $info['SALES_NUM'], $hour); 
				setcookie(Adm_sales, $info['ADM'], $hour); 
				setcookie(Lvl_sales, $info['LVL'], $hour); 
		
				mysql_close();
				//then redirect them to the members area 
				
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
<title>Alegria Sales Center Login</title>
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
                		<div class="contentRow" style="margin-top:0px;padding-top:0px;border:none;">
                            <p class="error">
                            
                            
                            </p>
                        </div>
                		<div class="contentRow" style="margin-top:0px;padding-top:0px;border:none;">
                            <div class="areaHeader" >Alegria Sales Center</div>
                            <p>Check your daily invoice report and year to date sales report.</p>
                            <p><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" target="_blank">Internet Explorer 8</a> Or <a href="http://www.mozilla.com/en-US/firefox/ie.html" target="_blank">FireFox 3.6</a> is recommended.</p>
                  </div>
                		
                </div>
                <div class="Right">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 
                    <div id="login" class="box">
                     <br />
                    
                    <div id="loginForm">
                        
                        <div class="fieldContent title" style="height:20px;">
                            <h1>Sales Log In Here</h1>
                        </div> 
                        <div class="errorMsg">									
                            <?php if ($failMess0) {
                                    echo "<span class='alertText'>$failMess0</span>";
                                } 
                            ?>
                        </div>
                        <div class="fieldContent">
                            <label for="name">Username:</label> 
                            <input type="text" value='<?php echo $username?>' name="username" maxlength="40" class='<?php if ($failMess1) {echo "alertField";}else{echo "formfield";}?>'>	<?php if ($failMess1) {echo "<span class='alertText'>$failMess1</span>";}?>
                            
                        </div>
                        <div class="fieldContent">
                            <label for="password">Password:</label>
                            <input type="password" value='<?php echo $pw?>' name="pass" maxlength="50" class='<?php if ($failMess2) {echo "alertField";}else{echo "formfield";}?>'>	 <?php if ($failMess2) {echo "<span class='alertText'>$failMess2</span>";}?> 
                            
                        </div>
                        <div class="fieldContent">
                            <label>&nbsp;</label>
                            <input type="submit" name="submit" value="Login"> 
                        </div>
                        <div class="fieldContent">
                            Having trouble logging in? <a href="mailto:luke@peppergate.com">Email Support</a>
                            
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
