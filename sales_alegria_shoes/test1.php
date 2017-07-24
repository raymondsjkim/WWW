<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $httpURL ?>includes/js/jquery.validate.pack.js" type="text/javascript"></script>
</head>
<body>

<?php
include("includes/resource/db.php");

$selTable 	= $_GET["table"];




$linkID = mssql_connect($mshost, $msuser, $mspass) or die ('Error connecting to mysql');
mssql_select_db($msname, $linkID);

//$query = "SELECT * FROM prod_upc";
$query = "select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_TYPE = 'BASE TABLE'";
$result = mssql_query($query, $linkID) or die("Data not found."); 

$tmpTable = array();

if (!$result) { $message = 'ERROR: ' . mssql_get_last_message();
	return $message; 
} else { 
	

	while ( ($row = mssql_fetch_row($result))) { 
		$count = count($row); 
		$y = 0; 
		//echo '<tr>'; 
		while ($y < $count) { 
			$c_row = current($row); 
			//echo /*'<td>' . */.' '.$c_row . '<br>';
			array_push($tmpTable, $c_row); 
			next($row); $y = $y + 1; 
		} 
		//echo '</tr>'; 
	} 

} 
?>

<form action="test1.php" method="GET">
<select  id="table" name="table">
	<option>Select a table</option>
<?php
for ($z = 0; $z < count($tmpTable); $z++){

	if ($tmpTable[$z] == $selTable) { $selected = "SELECTED";}else{ $selected = "";}
	echo "<option value='".$tmpTable[$z]."' ".$selected.">".$tmpTable[$z]."</option>";
}
?>
</select>
<input type="submit" value="Submit"/>

</form>




<?php

		
		$query1 = "SELECT * FROM $selTable WHERE PROD_CD = 'ALG-PAL-101'";// WHERE CUS_ID = 'A2017'$tmpTable1;//INVS_TM BETWEEN $beginday AND $endday WHERE INVS_NUM = '130644'
		
		$result1 = mssql_query($query1, $linkID) or die("Data not found."); 
			
			
	
		
		if (!$result1) { $message = 'ERROR: ' . mssql_get_last_message();
			return $message; 
		} else { 
		
			$i = 0; 
			echo "<b>".$selTable."</b><br>";
			echo '<table><tr bgcolor="#cccccc">'; 
			while ($i < mssql_num_fields($result1)) { 
				$meta = mssql_fetch_field($result1, $i); 
				echo '<td><b>' . $meta->name . '</b></td>'; 
				$i = $i + 1; 
			} 
			echo '</tr>'; 
			
			$k = 0;
			//if ( mssql_num_rows($result1) <50 ){
				while ( ($row = mssql_fetch_row($result1))) { 
					if ($k < 1000) {
					$count = count($row); 
					$y = 0; 
					echo '<tr>'; 
					while ($y < $count) { 
						$c_row = current($row); 
						echo '<td>' . $c_row . '</td>'; 
						next($row); 
						$y = $y + 1; 
					} 
					$k ++;
					
					
				echo '</tr>';
				} 
				} 
			//}
			mssql_free_result($result); 
			echo '</table>'; 
		}
//} 



	$row1 = mssql_fetch_assoc($result1);
		
		//echo "what is datetime: ".mktime(1,1,1970)."<br>";
		echo "what is mktime: ".mktime(0, 0, 0, 1, 1, 1801)."<br>";
			echo "what is date: ".$row1['INVS_DT']."<br/>";
			echo date('Y-m-d H:i:s', $row1['TMP'])."<br/>";
		



?>
<!-- iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Falegriashoes&amp;width=235&amp;connections=3&amp;stream=true&amp;header=false&amp;height=555" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:235px; height:479px; border-bottom:1px solid #666;background:#FFF;color:#FFF;" allowTransparency="true"></iframe -->

</body></html>