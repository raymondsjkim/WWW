<? 


$imgPath = "http://assets.alegriashoes.com/pages/contests/041510_gf/upload_pic/";

include ("../../includes/resource/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
  
<title></title>  
    
<style type="text/css">
body{margin:0;padding:0;font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;font-size:12px;color:#666;}

#content{background:url(<?= $imgPath ?>bg_contests_041510_gf.gif) repeat-y; width:984px;height:780px;}<!-- 1250 height -->

#content a{color:#ee2375;text-decoration:underline;}
#content a:hover{color:#FFF;text-decoration:none;background:#ee2375;}
#content a.NoBg:hover{background:none;}

.FloatLeft{float:left;}
.FloatNone{float:none;}
.Wider{width:470px;}
.Wide{width:230px;}
p{font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;font-size:11px;padding:0 0 10px 0;margin:0;}
#catalogAddress label{width:200px;}

#ContestMarketing{}
#ContestForm{text-align:left;display:table;}
#ContestContext{width:385px;position:absolute;top:270px;left:8px;}
#ContestContext h3{padding:10px 0 0 0;margin:0;}
#ContestContext p{}

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
#inventorytable{width:1000px;}
#inventorytable td{padding:5px;}
#inventorytable td.title{width:200px;display:block;}
#inventorytable td .size, #inventorytable td .stock, #inventorytable td .qty {float:none;height:15px;font-weight:bold;vertical-align:middle;}
.odd{background:#dfdfdf;}
.GreyOut{color:#9e9e9e;}

#inventorytable select{width:50px;}

#floatMenu {
		float:right;
		position:relative;
		width:220px;
		padding:10px 15px 15px 15px;
		background:#dfdfdf;
}
#floatMenu h3{padding:0;margin:0;padding-bottom:15px;}

.Inventory .contentRow{width:100%;}

#loading{height:100%;width:100%;position:absolute;z-index:9999;background:#FFF;filter:alpha(opacity=60);
  /* CSS3 standard */
  opacity:0.6;vertical-align:middle;display:table;
}
#loading #loadingContainer{position:absolute;top:44%;left:40%;width:auto;text-align:center;font-size:13px;color:#000;}
#loading img{padding-bottom:5px;}

.spacer{display:block;height:20px;}

#orderReview{
height: 40px;
width: 100%;
position: absolute;
bottom: 0px;
background-color: #ee2375;
}

html>body #orderReview{position:fixed}/* for moz/opera and others*/

#orderReviewContainer{width:985px;text-align:left;padding-top:5px;}
#orderReviewContainer .left{color:#FFF;font-weight:bold;font-size:14px;float:left;}

#orderReviewContainer .right{float:right;}
.itemQty, .itemid, .x{float:left;}
.x{padding:0px 3px;}
.remove{float:right;font-size:11px;}
.remove a:link, .remove a:visited{color:#666;text-decoration:underline;}
.remove a:hover, .remove a:active{color:#666;text-decoration:none;}

#review div{line-height:140%;padding:0;margin:0;padding-bottom:8px;clear:both;}
.color{color:#999999;font-size:11px;}
</style>    

</head>

<body>


<div id="content">
	
	   <table border='0' cellspacing='0' cellpadding='0' id='inventorytable'>
 
         
		 <? 
		 	$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
			mysql_select_db($database, $linkID) or die("Could not find database."); 
			
			$query = "SELECT * FROM contest_041510_gf ORDER BY id";
			$result = mysql_query($query, $linkID) or die("Data not found."); 
			
			$alt = "even";
			//$k = -1;
			
			
			
			
			for($y = 0 ; $y < mysql_num_rows($result) ; $y++){
			
			
				$row = mysql_fetch_assoc($result);
				
				if ($alt == "even"){$alt = "odd";}else{$alt = "even";}
				//$k++;
				
				if ($row[message]=="upload"){
					$pic = $imgPath.$row[imgName].".jpg";
				} else {
					$pic = $row[imgName];
				}
				
			echo "<tr class='".$alt."'>\n";
				echo "<td valign='top'>\n";
				//echo "<a name='".$value."' id='".$value."'></a>\n";
				echo "<img src='".$pic."' width='300'/>";
				//echo $value."<br>";
				//echo "<span class='color'>".$colorArray[$k]."</span>";
				echo "</td>\n";
				echo "<td class='title' valign='top'>\n
						<div >".$row[firstname]." ".$row[lastname]."</div>
						
						<div >".$row[address]."<br/>".$row[city].", ".$row[state]." ".$row[zip]."
</div><br />
						<div >".$row[email]."</div>
						<div >".$row[phone]."</div>
					</td>\n";
				echo "<td valign='top'>\n
						<div >".$row[option]."</div><br />

						<div >Post Date: ".$row[entryDate]."</div>";
						
				echo "</td>\n";
			echo "</tr>";		
			
			}
		?>	
	</table>

</div>

</body>
</html>