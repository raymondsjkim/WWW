<?php
$date = date("y_m_d");
$orderdate = date("m/d/Y");
//Сheck that we have a file
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
  if (($ext == "neworders") && ($_FILES["uploaded_file"]["type"] == "application/octet-stream") && 
    ($_FILES["uploaded_file"]["size"] < 180000)) {
    //Determine the path to which we want to save this file
      $newname = dirname(__FILE__).'/uploads/'.$filename;
      $copyfile = dirname(__FILE__).'/ship_confirm/'.$filename;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        copy($_FILES['uploaded_file']['tmp_name'], $copyfile);
        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
          
          /***CREATE VARIABLES AND ARRAY FROM COMMERCEHUB ORDER***/
          $index = -1;
          $itemnum = 0;
          $order_array = array();
          $file = file_get_contents($newname);

          $lines = explode("\n", "$file");
          array_pop($lines);

          foreach ($lines as $line) {
            if (substr($line, 3, 1) == "P") {
              $index ++;
              $itemnum = 0;
              $type = "header";
            }
            elseif (substr($line, 3, 1) == "O") {
              $type = "item".$itemnum;
              $itemnum ++;
            }
            $order_array['order'.$index][$type] = explode("|", $line);
          }
          /**************VARIABLES CREATED***********************/

          /**************CREATE ALEGRIA CSV*******************/
          $alegria_import_path = "alegria_import_csv/alegria_comhub_".$date.".csv";
          $alegria_file = fopen($alegria_import_path, "w");
          $alegria_line = "S/O No.,S/O Date,Customer ID,Ship To,Shipping Address,Shipping Address Line 2,Shipping City,Shipping State,Shipping Zip,UPC,Order Qty\r\n";
          fputs($alegria_file, $alegria_line);

          $customer_id = "A2904B";
          foreach ($order_array as $line => $value) {
            $itemnum = 0;
            while ($itemnum <= count($value)) {
              if (isset($value['item'.$itemnum])) {
                $upcnum = substr($value['item'.$itemnum]['10'], 1);

                $alegria_line = $value['header']['3'].",".$orderdate.",".$customer_id.",".$value['header']['56'].
                  ",".$value['header']['59'].",".$value['header']['60'].",".$value['header']['62'].",".$value['header']['63'].
                  ",".$value['header']['64'].",".$upcnum.",".$value['item'.$itemnum]['26']."\r\n";
                
                fputs($alegria_file, $alegria_line);
              }
            $itemnum ++;  
            }
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