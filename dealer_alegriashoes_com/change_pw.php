<?php 
require_once ("includes/php/checkCookieNew.php");
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

if (isset($_POST['submit'])) {
	$username = $_COOKIE['new_ID'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
	$email = $_POST['email'];


	if ($password == $confirm) {
		//check valid email format
		if (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
			if (!preg_match("/^[a-zA-Z0-9\.\_\-]+$/D", $email)) {
				//check valid pw
				if(strlen($password) > 0 and !preg_match("/^[a-zA-Z0-9\_\!]+$/D", $password )) {
					$failMess2 = "Invalid characters. Alphanumeric and \"!\" or \"_\" only.";
				} else if (strlen($password) > 0 and strlen($password) < 4 ){
					$failMess2 = "Password must be between 5-15 characters";
				} else if (strlen($password) > 14 ){
					$failMess2 = "Password must be between 5-15 characters";
				} else if (strlen($password) < 1 ){
					$failMess2 = "No password entered";
				} else {
					//verification success, update pw in database
					$hashPw = md5($password);
					$query = mysql_query("UPDATE accounts SET password='$hashPw', loggedin='1', email='$email' WHERE username='$username'", $linkID)
						or die(mysql_error());
					mysql_close();
					$pwsuccess = "Password successfully changed! Please log in again.";
					setcookie(pw_change, $pwsuccess, time() + 30); 
					setcookie(agreement_ID, $username, $hour); 
					setcookie(agreement_Key, $hashPw, $hour); 
					header("Location: agreement.php");
				}			
			}
			else {$failMess3 = "Email cannot contain quotes!";}
		}
		else {$failMess3 = "Email format incorrect! Email cannot contain quotes!";}
	}
	else {$failMess0 = "Passwords do not match!";}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="googlebot" content="noindex, noarchive, nofollow">
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">

		<title>Alegria Welcome Password Change</title>

		<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="btt" style="position:absolute;right:10px;top:-100px;z-index:999;border:none;">
    		<div><a href="#top"><img src="images/backtotop.png" border="none"></a></div>
		</div>
		<div id="Container">
			<div id="Outer">
				<div id="Header">
					<?php include("navigation/topNav.php"); ?>
				</div>
				<div id="Wrapper">
					<!-- Change password & add email form-->
					<div id="loginForm" style="width:400px;height:450px;">
						<form method="post" type="password" name="New Password" action="<?php echo $_SERVER['PHP_SELF']?>">
							<div class="fieldContent title" style="float:center">
								<h1>Please change your password* and enter your email to complete registration</h1>
							</div>
		                    <div class="errorMsg">									
		                    <?php if ($failMess0) {echo "<span class='alertText'>$failMess0</span>";}?>
		                    </div>
		                    <div class="fieldContent" style="float:center">
		                        <label for="password" style="width:220px">New Password:</label> 
		                        <input style="width:inherit" type="password" value='<?php echo $password?>' name="password" maxlength="50" 
		                        	class='<?php if ($failMess2) {echo "alertField";}else{echo "formfield";}?>'>
		                    </div>
		                    <div class="fieldContent" style="float:center">
		                        <label for="confirm" style="width:220px">Confirm Password:</label>
		                        <input style="width:inherit" type="password" value='<?php echo $confirm?>' name="confirm" maxlength="50" 
		                        	class='<?php if ($failMess2) {echo "alertField";}else{echo "formfield";}?>'>
		                        <?php if ($failMess2) {echo "<br /><br /><span class='alertText'>$failMess2</span>";}?>
		                    </div>
		                    <div class="fieldContent" style="float:center">
		                        <label for="email" style="width:220px">Enter email:</label>
		                        <input style="width:inherit" type="text" value='<?php echo $email?>' name="email" maxlength="50" 
		                        	class='<?php if ($failMess3) {echo "alertField";}else{echo "formfield";}?>'>
		                        <?php if ($failMess3) {echo "<br /><br /><span class='alertText'>$failMess3</span>";}?>
		                    </div>
		                    <div class="fieldContent" style="float:center">
		                        <label style="width:220px">&nbsp;</label>
		                        <input style="width:inherit" type="submit" name="submit" value="Complete Registration"> 
		                    </div>
	                    	<p><small><i>*Password must be between 5-15 characters 
	                    		and contain alphanumeric characters and "!"" or "_" only.</i></small></p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>