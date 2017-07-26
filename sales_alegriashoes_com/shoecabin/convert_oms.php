<?php

function csvexplode($str, $delim = ',', $qual = '"')
// Explode a single CSV string (line) into an array.
{
    $len = strlen($str);  // Store the complete length of the string for easy reference.
    $inside = false;  // Maintain state when we're inside quoted elements.
    $lastWasDelim = false;  // Maintain state if we just started a new element.
    $word = '';  // Accumulator for current element.

    for($i = 0; $i < $len; ++$i)
    {
        // We're outside a quoted element, and the current char is a field delimiter.
        if(!$inside && $str[$i]==$delim)
        {
            $out[] = $word;
            $word = '';
            $lastWasDelim = true;
        } 

        // We're inside a quoted element, the current char is a qualifier, and the next char is a qualifier.
        elseif($inside && $str[$i]==$qual && ($i<$len && $str[$i+1]==$qual))
        {
            $word .= $qual;  // Add one qual into the element,
            ++$i; // Then skip ahead to the next non-qual char.
        }

        // The current char is a qualifier (so we're either entering or leaving a quoted element.)
        elseif ($str[$i] == $qual)
        {
            $inside = !$inside;
        }

        // We're outside a quoted element, the current char is whitespace and the 'last' char was a delimiter.
        elseif( !$inside && ($str[$i]==" ")  && $lastWasDelim)
        {
            // Just skip the char because it's leading whitespace in front of an element.
        }

        // Outside a quoted element, the current char is whitespace, the "next" char is a delimiter.
        elseif(!$inside && ($str[$i]==" ")  )
        {
            // Look ahead for the next non-whitespace char.
            $lookAhead = $i+1;
            while(($lookAhead < $len) && ($str[$lookAhead] == " ")) 
            {
                ++$lookAhead;
            }

            // If the next char is formatting, we're dealing with trailing whitespace.
            if($str[$lookAhead] == $delim || $str[$lookAhead] == $qual) 
            {
                $i = $lookAhead-1;  // Jump the pointer ahead to right before the delimiter or qualifier.
            }

            // Otherwise we're still in the middle of an element, so add the whitespace to the output.
            else
            {
                $word .= $str[$i];  
            }
        }

        // If all else fails, add the character to the current element.
        else
        {
            $word .= $str[$i];
            $lastWasDelim = false;
        }
    }

    $out[] = $word;
    return $out;
}

$date = date("y-m-d H:m:s");
$orderdate = date("m/d/Y");
//Сheck that we have a file
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
  //Check if the file is csv image and it's size is less than 180Kb
  $filename = basename($_FILES['uploaded_file']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
  if (($ext == "csv") && ($_FILES["uploaded_file"]["size"] < 1800000)) {
    //Determine the path to which we want to save this file
      $newname = dirname(__FILE__).'/uploads/'.$date.'-'.$filename;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        copy($_FILES['uploaded_file']['tmp_name'], $copyfile);
        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
          
          /***CREATE VARIABLES AND ARRAY FROM SHOPIFY ORDER***/
          // ALSO CREATE ARRAY TO CHANGE SKU TO UPC SINCE IMPORT REQUIRES UPC NUMBER, AND SHOPIFY EXPORTS SKU
          $UPC_filepath = "../product_feed/alegriashoes_com/alegriashoesinv_nolimit.csv";
          $order_array = array();
          $UPC_array = array();
          $final_array = array();
          $date_format = date("m/d/Y");

          $final_file = "alegria_import_csv/alegria-shoecabin_".$date.".csv";

          $file = file_get_contents($newname);
          $UPCfile = file_get_contents($UPC_filepath);

          $lines = explode("\n", "$file");
          array_pop($lines);
          foreach ($lines as $line) {
            $temp_array = csvexplode($line);
            array_push($order_array, $temp_array);
            }

          $lines = explode("\n", $UPCfile);
          array_pop($lines);
          foreach ($lines as $line) {
            $temp_array = explode(",", $line);
            array_push($UPC_array, $temp_array);
          }

          /**************VARIABLES CREATED***********************/
          // echo "<pre>";
          // print_r($order_array);
          // echo "</pre><br> <br>";
          // echo "<pre>";
          // print_r($UPC_array);
          // echo "</pre>";

          // echo "<pre>";
          // print_r($UPC_array);
          // echo "</pre>";

          // echo "<pre>";
          // print_r($order_array);
          // echo "</pre>";



          /**************CREATE ALEGRIA CSV*******************/
          $tmpFile = fopen($final_file, "w");
          fputs($final_file, $line_item);
          // Match SKU from Shopify order file to SKU in online database.
          // If there's a match, swamp the SKU for UPC
          foreach ($order_array as $tmpOrder_array) {
            foreach ($UPC_array as $tmpUPC_array) {
              if ($tmpUPC_array[0] == $tmpOrder_array[20]) {
                if ($tmpOrder_array[2] != "") {

                  $SOno = trim($tmpOrder_array[0], "#");
                  $CustomerName = $tmpOrder_array[24];
                  $BillingAddress = $tmpOrder_array[26];
                  $BillingAddress2 = $tmpOrder_array[27];
                  $BillingCity = $tmpOrder_array[29];
                  $BillingState = $tmpOrder_array[31];
                  $BillingZip = $tmpOrder_array[30];
                  $BillingCountry = $tmpOrder_array[32];
                  $BillingPhone = $tmpOrder_array[33];
                  $EmailAddress = $tmpOrder_array[1];
                  $ShipTo = $tmpOrder_array[34];
                  $ShippingAddress = trim($tmpOrder_array[36], ",");
                  $ShippingAddress2 = trim($tmpOrder_array[37], ",");
                  $ShippingCity = $tmpOrder_array[39];
                  $ShippingState = $tmpOrder_array[41];
                  $ShippingZip = $tmpOrder_array[40];
                  $ShippingCountry = $tmpOrder_array[42];
                  $ShippingCountryCode = "";
                  $ShippingPhone = $tmpOrder_array[43];
                  $TermDescription = $tmpOrder_array[47];
                  $RefNumber = "ShoeCabin";
                  $UPCnum = $tmpUPC_array[1];
                  $OrderQty = $tmpOrder_array[16];
                  $UnitPrice = $tmpOrder_array[18];
                  $TaxAmount = $tmpOrder_array[10];
                  $Freight = $tmpOrder_array[9];
                  
                if (substr($tmpOrder_array[17], -4) == "Wide" ) {
                    $Notes = "Wide";
                  }
                else {
                    $Notes = "";
                  }



                  $line_item = $SOno .",". $date_format .",". $CustomerName .",". $BillingAddress .",". $BillingAddress2 .",". $BillingCity
                              .",". $BillingState .",". $BillingZip .",". $BillingCountry .",". $BillingPhone .",". $EmailAddress
                              .",". $ShipTo .",". $ShippingAddress .",". $ShippingAddress2 .",". $ShippingCity .",". $ShippingState 
                              .",". $ShippingZip .",". $ShippingCountry .",". $ShippingCountryCode .",". $ShippingPhone
                              .",". $TermDescription .",". $RefNumber .",". $UPCnum .",". $OrderQty .",". $UnitPrice
                              .",". $TaxAmount .",". $Freight .",". $Notes ."\r\n";
                  fputs($tmpFile, $line_item);
                }

                else {
                  if (substr($tmpOrder_array[17], -4) == "Wide" ) {
                      $Notes = "Wide";
                    }
                  else {
                      $Notes = "";
                    }
                  $line_item = $SOno .",". $date_format .",". $CustomerName .",". $BillingAddress .",". $BillingAddress2 .",". $BillingCity
                              .",". $BillingState .",". $BillingZip .",". $BillingCountry .",". $BillingPhone .",". $EmailAddress
                              .",". $ShipTo .",". $ShippingAddress .",". $ShippingAddress2 .",". $ShippingCity .",". $ShippingState 
                              .",". $ShippingZip .",". $ShippingCountry .",". $ShippingCountryCode .",". $ShippingPhone
                              .",". $TermDescription .",". $RefNumber .",". $tmpUPC_array[1] .",". $tmpOrder_array[16] .",". $tmpOrder_array[18]
                              .",". $$tmpOrder_array[10] .",". $tmpOrder_array[9] .",". $Notes ."\r\n";
                  fputs($tmpFile, $line_item);
                }
              }
              // If UPC does not exist, we need to supplement UPC with "12345"
            }
          }
          fclose($final_file);
          /**************FINISH ALEGRIA CSV*******************/



          echo "<br /><br />";
          echo "<br /><br />";
          echo "Shoecabin CSV order import file successfully created! Download here: <a href='".$final_file."' download>Shoecabin OMS import csv for ".$date."</a>";
          echo "<br /><br />";
          echo "<br /><br />";

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