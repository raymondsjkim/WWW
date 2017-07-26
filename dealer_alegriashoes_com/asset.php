<?php require_once ("includes/php/checkCookie.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="googlebot" content="noindex, noarchive, nofollow">
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
		<title>Asset Download</title>  
		<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	</head>

	<body>
		<div id="Container">
			<div id="Outer">
				<div id="Header">
					<?php include("navigation/topNav.php"); ?>
				</div>
				<div class="Wrapper">
				<p>
				<h2>Asset Download</h2>
				Find your essential Alegria digital materials here. Click an option for more information.
				</p>
				<?php 
					include("content/price_sheet.php");
					include("content/ftpInstruction.php");
					include("content/logo.php");
					include("content/catalog.php");      
					include("content/marketingAssets_raw.php");
					include("content/marketingAssets_pop.php");
					include("content/video.php"); 
				?>
				</div>
				<br /><br />
			</div>
		</div>

		<?php include("includes/php/google.analytics.php"); ?>
		<script type="text/javascript">
		$(document).ready(function(){
			$(".areaHeader").click(function() {
				$(this).next('.areaContent').slideToggle("fast");
			});
		});
		</script>
	</body>

</html>