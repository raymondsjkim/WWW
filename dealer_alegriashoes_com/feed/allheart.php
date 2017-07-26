<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/



function inv_allheart (){
	
$filename = 'test.txt';
$Content = "Add this to the file\r\n";
 
echo "open";
$handle = fopen($filename, 'x+');
echo " write";
fwrite($handle, $Content);
echo " close";
fclose($handle);
 

	if($handle = fopen($filename, 'a')){
		if(is_writable($filename)){
			if(fwrite($handle, $content) === FALSE){
				echo "Cannot write to file $filename";
				exit;
			}
			echo "The file $filename was created and written successfully!";
			fclose($handle);
		}
		else{
			echo "The file $filename, could not written to!";
			exit;
		}
	}
	else{
		echo "The file $filename, could not be created!";
		exit;
	}

}

inv_allheart();
//fclose($file2);

?>

