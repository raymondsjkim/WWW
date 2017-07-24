
        

   ALG3<br />
<table>
	
    	
        <?php require("includes/resource/db.php");
		
			//$exclude_list = "'ALG','ALG1','ALG2','ALG3','ALG-Z1'";
			$exclude_list = "'ALG3'";
			
			$linkID = mysql_connect($dbhost, $dbuser, $dbpass) or die("Could not connect to host. 12"); 
			mysql_select_db($dbdatabase, $linkID) or die("Could not find database."); 
			
			$query = "SELECT *"
				   ." FROM inv_data JOIN inv ON inv.PROD_CD = inv_data.PROD_CD"
				   ." WHERE inv_data.CLASS_CD IN ({$exclude_list})"
				   ." AND inv.ACTIVE = 'Y'"
				   ." ORDER BY inv_data.PROD_CD ASC";
			$result = mysql_query($query, $linkID) or die("Data not found."); 
			
			
			$itemArray 	= array();
			
			while($row = mysql_fetch_array($result)){
				echo "<tr>";	
				echo "<td>".$row['DESCRIP']."</td>";
				echo "<td>".$row['PROD_CD']."</td>";	
				echo "</tr>";	
			
			}
		
		?>
  </table>      
 <br />
<br />
ALG2<br />

 <?php //$exclude_list = "'ALG','ALG1','ALG2','ALG3','ALG-Z1'";
			$exclude_list = "'ALG2'";
			
			$linkID = mysql_connect($dbhost, $dbuser, $dbpass) or die("Could not connect to host. 12"); 
			mysql_select_db($dbdatabase, $linkID) or die("Could not find database."); 
			
			$query = "SELECT *"
				   ." FROM inv_data JOIN inv ON inv.PROD_CD = inv_data.PROD_CD"
				   ." WHERE inv_data.CLASS_CD IN ({$exclude_list})"
				   ." AND inv.ACTIVE = 'Y'"
				   ." ORDER BY inv_data.PROD_CD ASC";
			$result = mysql_query($query, $linkID) or die("Data not found."); 
			
			
			$itemArray 	= array();
			
			while($row = mysql_fetch_array($result)){
					
				echo $row['PROD_CD']."<br>";	
					
			
			}
		
		?>
 <br />
<br />
ALG1<br />

 <?php //$exclude_list = "'ALG','ALG1','ALG2','ALG3','ALG-Z1'";
			$exclude_list = "'ALG1'";
			
			$linkID = mysql_connect($dbhost, $dbuser, $dbpass) or die("Could not connect to host. 12"); 
			mysql_select_db($dbdatabase, $linkID) or die("Could not find database."); 
			
			$query = "SELECT *"
				   ." FROM inv_data JOIN inv ON inv.PROD_CD = inv_data.PROD_CD"
				   ." WHERE inv_data.CLASS_CD IN ({$exclude_list})"
				   ." AND inv.ACTIVE = 'Y'"
				   ." ORDER BY inv_data.PROD_CD ASC";
			$result = mysql_query($query, $linkID) or die("Data not found."); 
			
			
			$itemArray 	= array();
			
			while($row = mysql_fetch_array($result)){
					
				echo $row['PROD_CD']."<br>";	
					
			
			}
		
		?>
 <br />
<br />
ALG<br />

 <?php //$exclude_list = "'ALG','ALG1','ALG2','ALG3','ALG-Z1'";
			$exclude_list = "'ALG'";
			
			$linkID = mysql_connect($dbhost, $dbuser, $dbpass) or die("Could not connect to host. 12"); 
			mysql_select_db($dbdatabase, $linkID) or die("Could not find database."); 
			
			$query = "SELECT *"
				   ." FROM inv_data JOIN inv ON inv.PROD_CD = inv_data.PROD_CD"
				   ." WHERE inv_data.CLASS_CD IN ({$exclude_list})"
				   ." AND inv.ACTIVE = 'Y'"
				   ." ORDER BY inv_data.PROD_CD ASC";
			$result = mysql_query($query, $linkID) or die("Data not found."); 
			
			
			$itemArray 	= array();
			
			while($row = mysql_fetch_array($result)){
					
				echo $row['PROD_CD']."<br>";	
					
			
			}
		
		?>
 <br />
<br />