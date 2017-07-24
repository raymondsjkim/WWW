<?php 
$past = time() - 100; 
//this makes the time in the past to destroy the cookie 
setcookie(ID_sales, '', $past); 
setcookie(Key_sales, '', $past);
setcookie(Name_sales, '', $past); 
setcookie(Adm_sales, '', $past); 
setcookie(Lvl_sales, '', $past); 

unset($_COOKIE['ID_sales']); 
unset($_COOKIE['Key_sales']); 
unset($_COOKIE['Name_sales']);
unset($_COOKIE['Adm_sales']);
unset($_COOKIE['Lvl_sales']);

header("Location: login.php"); 

?> 
<script type="text/javascript">
			<!--
			window.location = "login.php";
			//-->
</script>