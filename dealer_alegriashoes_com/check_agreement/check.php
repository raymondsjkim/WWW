<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("../includes/resource/db.php");
$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
mysql_select_db($database, $linkID) or die("Could not find database."); 

$query_agreed = 	"SELECT username, businessName, email 
					FROM accounts 
					WHERE loggedin='1' 
					AND username LIKE 'A%'
					ORDER BY username ASC";
$result_agreed = 	mysql_query($query_agreed, $linkID) or die("after submit Data not found.");

$query_notagreed = 	"SELECT username, businessName, email 
					FROM accounts 
					WHERE loggedin='0' 
					AND username LIKE 'A%'
					ORDER BY username ASC";
$result_notagreed = mysql_query($query_notagreed, $linkID) or die("after submit Data not found.");

$unauthed_count = mysql_num_rows($result_notagreed);
$authed_count = mysql_num_rows($result_agreed);
$authed_percent = round($authed_count / $unauthed_count * 100, 2);

$row = array('username', 'businessName', 'email');

?>

<html>
	<head>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
		<script language="javascript" type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="googlebot" content="noindex, noarchive, nofollow">
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
		<style>
		#title {
		  display: block;
		  margin-left: auto;
		  margin-right: auto;
		}
		</style>
	</head>

	<body>
		<div class="container-fluid">
			<div class="row">
				<form id="myform" class="myform" method="post" name="myform">
					<div class="span5 container-fluid">
						<h3><p class="text-center">Not Accepted<p></h3>
						<small><p class="text-center">Total: <?php echo $unauthed_count ?></p></small>
						<small style='font-wieght'><i>*Click each row for the corresponding E-Mail contact</i></small>
						<table class="table table-striped table-hover table-bordered" style="margin-top:10px" id="report2">
							<tr>
								<th colspan="1">Peppergate Cust ID</th>
								<th colspan="1">Business Name</th>
								<th colspan="1">Authorize</th>
								<!-- <th colspan="1">E-Mail</th> -->
							</tr>
							<?php
							while ($info = mysql_fetch_assoc($result_notagreed)) {
								echo 	"<tr>
											<td colspan='1'>".$info['username']."</td>
											<td colspan='1'>".$info['businessName']."</td>
											<td colspan='1'>
												<input type='checkbox' name='auth[]' value='".$info['username']."' onclick='submitForm()'>
												<small>auth</small>
												</input>
											</td>
										</tr>
										 <tr>
										 	<td colspan='1'><p class='text-right'><b>E-Mail: </b></p> </td>
										 	<td colspan='2'><a href='mailto:".$info['email']."'>".$info['email']."</a></td>
										 </tr>";
								}
							?>

						</table>
					</div>


					<div class="span5 container-fluid">
						<h3><p class="text-center">Logged in and Accepted Terms</p></h3>
						<small><p class="text-center">Total: <?php echo $authed_count ?></p></small>
						<small style='font-wieght'><i>*Click each row for the corresponding E-Mail contact</i></small>
						<table class="table table-striped table-hover table-bordered" style="margin-top:10px" id="report">
							<tr>
								<th colspan="1">Peppergate Cust ID</th>
								<th colspan="1">Business Name</th>
								<th colspan="1">Unauth</th>
								<!-- <th colspan="1">E-Mail</th> -->
							</tr>

							<?php
							while ($info = mysql_fetch_assoc($result_agreed)) {
								echo 	"<tr>
											<td colspan='1'>".$info['username']."</td>
											<td colspan='1'>".$info['businessName']."</td>
											<td colspan='1'>
												<input type='checkbox' name='deauth[]' value='".$info['username']."' onclick='submitForm()'>
												<small>undo</small>
												</input>
											</td>
										 </tr>
										 <tr>
										 	<td colspan='1'><p class='text-right'><b>E-Mail: </b></p> </td>
										 	<td colspan='2'><a href='mailto:".$info['email']."'>".$info['email']."</a></td>
										 </tr>";
								}
							?>
						</table>
					</div>			
					<div class="span2 container-fluid">
						<h3><p class="text-center">Changes<p></h3>
						<small><p class="text-center">Accounts you check will show up here</p></small>
						<small style='font-wieght'><i>*Check all accounts that apply and hit submit to update the database.</i></small>
						<br /><br />
						<div class="row">
							<div id="myResponse"></div>
						</div><br />
						<small style='font-wieght'><i>Review your work before submitting!</i></small><br />
						<input name="submit" type="hidden" value="Submit" onclick="submitForm()">
							<input type="submit" />
						</input>
					</div>
					<br /><br />
					<div class="span2 container-fluid">
						<p class="text-center">
							<h1><? echo $authed_percent ?>%</h1> there!
						</p>
					</div>
				</form>
			</div>
		</div>

		<script type="text/javascript">
		//click expand table rows
		$(document).ready(function(){

	        $("#report tr:odd").addClass("odd");
	        $("#report2 tr:odd").addClass("odd");
	        $("#report tr:not(.odd)").hide();
	        $("#report2 tr:not(.odd)").hide();
	        $("#report tr:first-child").show();
	        $("#report2 tr:first-child").show();
	        
	        $("#report tr.odd").click(function(){
	            $(this).next("tr").toggle();
	        });
	        $("#report2 tr.odd").click(function(){
	            $(this).next("tr").toggle();
	        });
	        $("#report").jExpand();
	        $("#report2").jExpand();
    	});

		//submit json
    	function submitForm() {
			var form = document.myform;
			var dataString = $(form).serialize();

			$.ajax({
			    type:'POST',
			    url:'update_status.php',
			    data: dataString,
			    success: function(data){
			        $('#myResponse').html(data);
			    }
			});
			return false;
		}

		</script>
	</body>
</html>