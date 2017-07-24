<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_alegriashoes(){
	
	include("includes/resource/db.php");
	
	echo substr(sprintf('%o', fileperms('product_feed/')), -4);
	echo substr(sprintf('%o', fileperms('product_feed/test/')), -4);
	echo substr(sprintf('%o', fileperms('product_feed/test/test.csv')), -4);
	
	echo "open<br>";
	$name        = "product_feed/test/test.csv";
	$file        = fopen( $name, "w" );
	
	$linkID = mssql_connect($mshost, $msuser, $mspass) or die ('Error connecting to mysql');
	mssql_select_db($msname, $linkID);
	
	$query = "SELECT * FROM inv_data WHERE CLASS_CD = 'ALG' OR CLASS_CD = 'ALG2' OR CLASS_CD = 'ALG3' ORDER BY PROD_CD ASC";
	$result = mssql_query($query, $linkID) or die("Data not found."); 
	
	
	$line = "Product ID\r\n"; //header
	//fputs($file, $line);
	
	while($row = mssql_fetch_array($result)){
		
		//echo $row['CLASS_CD']."<br>";
		
		/*if ($row[wholesalePrice] == "8.95"){$WP = "19.95";}
		if ($row[wholesalePrice] == "39.50"){$SRP = "89.95";}
		if ($row[wholesalePrice] == "44.50"){$SRP = "99.95";}
		if ($row[wholesalePrice] == "49.50"){$SRP = "109.95";}
		if ($row[wholesalePrice] == "69.50"){$SRP = "154.95";}
		if ($row[wholesalePrice] == "75.00"){$SRP = "164.95";}
		if ($row[inStock] <= 10){ $stock = 0;} else { $stock = $row[inStock];}
		
		if ($row[size] == 35){ $sizeChart = "Size: Euro 35 / US 5 - 5.5";}
		if ($row[size] == 36){ $sizeChart = "Size: Euro 36 / US 6 - 6.5";}
		if ($row[size] == 37){ $sizeChart = "Size: Euro 37 / US 7 - 7.5";}
		if ($row[size] == 38){ $sizeChart = "Size: Euro 38 / US 8 - 8.5";}
		if ($row[size] == 39){ $sizeChart = "Size: Euro 39 / US 9 - 9.5";}
		if ($row[size] == 40){ $sizeChart = "Size: Euro 40 / US 10";}
		if ($row[size] == 41){ $sizeChart = "Size: Euro 41 / US 10.5";}
		if ($row[size] == 42){ $sizeChart = "Size: Euro 42 / US 11";}*/
	
		//if ($row[size] >=35 && $row[size] <= 42){
			$line = "$row[PROD_CD]\r\n"; //data
			
			echo "write <br>";
			fputs($file, $line);
		//}
	}
	echo "close <br>";
	fclose($file);
	
	
	
	if($handle = fopen($name, 'a')){
		if(is_writable($name)){
			if(fwrite($file, $line) === FALSE){
				echo "Cannot write to file $name";
				exit;
			}
			echo "The file $name was created and written successfully!";
			fclose($line);
		}
		else{
			echo "The file $name, could not written to!";
			exit;
		}
	}
	else{
		echo "The file $name, could not be created!";
		exit;
	}
}

	

	


inv_alegriashoes();



?>

