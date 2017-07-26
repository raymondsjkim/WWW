<?php
function update_db(){
/********************************/
/* Code at http://legend.ws/blog/tips-tricks/csv-php-mysql-import/
/* Edit the entries below to reflect the appropriate values
/********************************/
require("../includes/resource/db.php");

$databasehost		= $inhost;
$databasename 		= $indatabase ;
$databasetable 		= "alg_inventory_SAP";//$intable;
$databaseusername 	= $inuser ;
$databasepassword 	= $inpass;
$fieldseparator 	= "\t";
$lineseparator 		= "\r\n";
$csvfile 			= "Export Inventory List.txt";
/********************************/
/* Would you like to add an ampty field at the beginning of these records?
/* This is useful if you have a table with the first field being an auto_increment integer
/* and the csv file does not have such as empty field before the records.
/* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.
/* This can dump data in the wrong fields if this extra field does not exist in the table
/********************************/
$addauto = 0;
/********************************/
/* Would you like to save the mysql queries in a file? If yes set $save to 1.
/* Permission on the file should be set to 777. Either upload a sample file through ftp and
/* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql
/********************************/
$save = 0;
$outputfile = "output.sql";
/********************************/


if(!file_exists($csvfile)) {
	echo "File not found. Make sure you specified the correct path.\n";
	exit;
}

$file = fopen($csvfile,"r");

if(!$file) {
	echo "Error opening data file.\n";
	exit;
}

$size = filesize($csvfile);

if(!$size) {
	echo "File is empty.\n";
	exit;
}

$csvcontent = fread($file,$size);

fclose($file);

$inlinkID = mysql_connect($inhost, $inuser, $inpass) or die("Could not connect to host."); 
mysql_select_db($indatabase, $inlinkID) or die("Could not find database1."); 

$query = "truncate table $databasetable";	
	//echo $query;
mysql_query($query, $inlinkID);

$lines = 0; 
$queries = "";
$linearray = array();

foreach(split($lineseparator,$csvcontent) as $line) {

	$lines++;
	//echo $line."<br>";
	//$line = trim($line," \t");
	
	//$line = str_replace("\r","",$line);
	
	/************************************
	This line escapes the special character. remove it if entries are already escaped in the csv file
	************************************/
	$line = str_replace("'","\'",$line);
	/*************************************/
	
	$linearray = explode($fieldseparator,$line);
	
	$itemPieces = explode("-", $linearray[1]);
	$tmpItemNo = $itemPieces[0]."-".$itemPieces[1];
	$tmpClass = "PGL";
	


	

}

$row = 1;
if (($handle = fopen("Export Inventory List.txt", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
        $num = count($data);
		$data = str_replace(chr(0), "", $data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        
      		$tmpID 		= $data[0];
			$itemPieces = explode("-", $data[1]);
			$tmpItemNo 	= $itemPieces[0]."-".$itemPieces[1];
		
			$tmpColor 	= $data[5];
			$tmpSize 	= $data[7];
			$tmpUPC 	= $data[8];
			$tmpStock	= ceil($data[9]);
			$tmpWP		= $data[10];
			$tmpRetail	= $data[11];
			$tmpStyle	= $data[3];
			$tmpDis		= $data[13];
			if($data[14] != ""){
				$etapieces	= explode("/", $data[14]);
				$tmpETA		= $etapieces[1]."/".$etapieces[0]."/".$etapieces[2];
			} else {
				$tmpETA = "";
			}
			
			$tmpCat		= trim($data[15]);
		/*	$tmpCat 	= str_replace("\r", "", $tmpCat);
			$tmpCat 	= str_replace("\n", "", $tmpCat);
			$tmpCat 	= str_replace("\t", "", $tmpCat);*/
			$tmpCStyle	= $data[2];
			//include("resource/retailprice_SAP.php");
			
			if($data[0] != "#" and $data[0] != ""){
				$linemysql = "'".$tmpID."','".$tmpItemNo."','".$tmpCat."','".$tmpColor."','".$tmpSize."','".$tmpUPC."','".$tmpStock."','".$tmpWP."','".$tmpRetail."','".$tmpStyle."','".$tmpDis."','".$tmpETA."','".$tmpCStyle."'";
				if($addauto){
					$query = "REPLACE INTO $databasetable values('',$linemysql);";
				}else{
					$query = "REPLACE INTO $databasetable values($linemysql);";
					//echo $linemysql."<br>";
					$queries .= $query . "\n";
//echo $query;
					mysql_query($query, $inlinkID);
				}
			}	
				
		/*	if($addauto)
				$query = "REPLACE INTO $databasetable values('','$linemysql');";
			else
				$query = "REPLACE INTO $databasetable values('$linemysql');";
	*/
	
		
    }
    fclose($handle);
}

@mysql_close($con);

if($save) {
	
	if(!is_writable($outputfile)) {
		echo "File is not writable, check permissions.\n";
	}
	
	else {
		$file2 = fopen($outputfile,"w");
		
		if(!$file2) {
			echo "Error writing to the output file.\n";
		}
		else {
			fwrite($file2,$queries);
			fclose($file2);
		}
	}
	
}

//echo "Found a total of $lines records in this csv file.\n";
echo "Records imported";
}
//update_db();
?>
