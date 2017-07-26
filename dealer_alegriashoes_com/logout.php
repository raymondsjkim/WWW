<?php 
$past = time() - 100; 
//this makes the time in the past to destroy the cookie 
if (isset($_COOKIE['ID_my_site'])) {
	setcookie(ID_my_site, '', $past); 
	unset($_COOKIE['ID_my_site']); 
	setcookie(Key_my_site, '', $past);
	unset($_COOKIE['Key_my_site']); 
}

if (isset($_COOKIE['new_ID'])) {
	setcookie(new_ID, '', $past); 
	unset($_COOKIE['new_ID']); 
	setcookie(new_Key, '', $past);
	unset($_COOKIE['new_Key']); 
}


if (isset($_COOKIE['agreement_ID'])) {
	setcookie(agreement_ID, '', $past); 
	unset($_COOKIE['agreement_ID']); 
	setcookie(agreement_Key, '', $past); 
	unset($_COOKIE['agreement_Key']); 
}
?> 
<script type="text/javascript">
			<!--
			window.location = "login.php";
			//-->
</script>