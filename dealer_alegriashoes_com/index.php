<?php 
require_once ("includes/php/checkCookie.php"); \
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="googlebot" content="noindex, noarchive, nofollow">
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
		<title>Alegria Dealer Center</title>
		<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
		<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/cupertino/jquery-ui.css" rel="stylesheet" />
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
		<script src="includes/js/jquery.youtubepopup.min.js" type="text/javascript"></script>

	</head>
	<body>
		<div id="Container">
			<div id="Outer">
				<div id="Header">
					<?php include("navigation/topNav.php"); ?>
				</div>
            	<div id="Wrapper">
				<?php 
					include("content/headerMessage.php");
				echo "</div>";
				?>
				<br /><br />

			</div>
		</div>
	<?php include("includes/php/google.analytics.php"); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".areaHeader").click(function() {
			$(this).next('.areaContent').slideToggle("fast");
		});
		// $(".areaHeader").toggle(function(){
		// 		$(this).children().attr("src", "http://assets.alegriashoes.com/images/Arrow_down.gif");
		// 		}, function () {
		// 		$(this).children().attr("src", "http://assets.alegriashoes.com/images/Arrow_right.gif");
		// });
		$(function () {
			$("a.youtube").YouTubePopup({ autoplay: 0, hideTitleBar: true, autohide: 1, controls: 0, showinfo: 1 });
		});
	});

	</script>
	</body>

</html>
