<?php
require("../includes/resource/db.php");
set_time_limit(720);
$company = "ALG";
$replenishmentdate = "";
include("../product_feed/resource/connection_mysql.php");
$date = date("y_m_d");
$orderdate = date("m/d/Y");
//Сheck that we have a file
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
  // echo $_FILES["uploaded_file"]["type"];
  if (($ext == "csv") && ($_FILES["uploaded_file"]["type"] == "application/vnd.ms-excel") && 
    ($_FILES["uploaded_file"]["size"] < 35000)) {
    //Determine the path to which we want to save this file
      $newname = dirname(__FILE__).'/uploads/'.$filename;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        copy($_FILES['uploaded_file']['tmp_name'], $copyfile);
        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
          
          /***CREATE VARIABLES AND ARRAY FROM COMMERCEHUB ORDER***/          
          $order_array = array();
          $upc_array = array();
          $file = file_get_contents($newname);
          $lines = explode("\n", "$file");
          array_pop($lines);

          while ($row = mysql_fetch_assoc($result)) {
            include("../product_feed/resource/variables_mysql.php");
            $tmparr = array('SKU' => $tmpItemNo, 
                            'Size' => $tmpSize,
                            'UPC' => $tmpUPC);
            array_push($upc_array, $tmparr);
          }
         
          foreach ($lines as $key) {
            $lineitem = explode(",", "$key");

            //replace SKU with UPC
            $skuStyle = substr($lineitem['10'], 0, -3);
            $skuSize = substr($lineitem['10'], -2, 2);

            foreach ($upc_array as $key) {
              if ($skuStyle == $key['SKU']) {
                if ($skuSize == $key['Size']) {
                  array_push($lineitem, $key['UPC']);
                }
              }
            }

            array_push($order_array, $lineitem);
          }

          // echo "<pre>"; print_r($order_array); echo "</pre>"; 
          // echo "<pre>"; print_r($upc_array); echo "</pre>"; 

          /**************VARIABLES CREATED***********************/

          /**************CREATE ALEGRIA CSV*******************/
          $alegria_import_path = "alegria_import_csv/alegria_bigcom_".$date.".csv";
          $alegria_file = fopen($alegria_import_path, "w");
          $alegria_line = "S/O No.,S/O Date,Customer ID,Ship To,Shipping Address,Shipping Address Line 2,Shipping City,Shipping State,Shipping Zip,UPC,Order Qty\r\n";
          fputs($alegria_file, $alegria_line);

          $customer_id = "A1906";
          $shipto = "SHOECABIN.COM";
          $shipadd = "20711 E. Crest Ln Unit A";
          $shipcity = "Walnut";
          $shipst = "CA";
          $shipzip = "91789";

          foreach ($order_array as $value) {

                $alegria_line = $value['0'].",".$value['1'].",".$customer_id.",".$shipto.",".$shipadd.",,".
                                $shipcity.",".$shipst.",".$shipzip.",".$value['11'].",".
                                $value['9']."\r\n";
                
                fputs($alegria_file, $alegria_line);
          }
          fclose($alegria_file);
          /**************FINISH ALEGRIA CSV*******************/
          echo "<br /><br />";
          echo "<br /><br />";
          echo "Alegria OMS csv order import file successfully created! Download here: <a href='".$alegria_import_path."'>OMS order csv for ".$date."</a>";
          echo "<br /><br />";
          echo "<br /><br />";
          echo "<i>***NOTE: To save the file, RIGHT-CLICK and choose SAVE-AS to download the file.***</i>";

        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file"]["name"]." already exists";
      }
  } else {
     echo "Error: Your file format does not match the usecase.";
  }
} else {
 echo "Error: No file uploaded";
}
?>