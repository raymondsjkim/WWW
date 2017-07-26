    <?

include("includes/resource/db.php");


$mslinkID = mssql_connect($mshost, $msuser, $mspass) or die ('Error connecting to mssql');
mssql_select_db($msname, $mslinkID);

$tmpCus 	= $_POST['cus'];
$sales		= $_COOKIE['Num_sales']; 
$count		= $_POST['count'];

//echo $tmpCus;

				
$query_invoice 	= "SELECT * from ("
				." SELECT TOP 20 * from("
				." SELECT TOP $count *"
				." FROM invoice"
				." WHERE INVS_CD = '1'"
				." AND SALES_NUM = '$sales'"
				." AND CUS_ID = '$tmpCus'"
				." ORDER BY INVS_NUM DESC"
				.") AS newtbl1 ORDER BY INVS_NUM ASC"
				.") AS newtbl2 ORDER BY INVS_NUM DESC";
				//."invoice.INVS_DT, invoice.INVS_NUM, invoice.CUS_ID, invoice.INVS_AMT, invoice.INVS_CD, invoice.SALES_NUM customer.CUS_NM"
				//." FROM invoice"
				//." WHERE invoice.INVS_DT"// BETWEEN $beginDate AND $endDate" 
				
				//." ORDER BY INVS_NUM DESC";
//echo $query_invoice;


$result_invoice	= mssql_query($query_invoice, $mslinkID) or die("Data not found. invoice"); 
	
	
	$invArray = array();
	$dayArray = array();	
	
	
		
		  while($row2 = mssql_fetch_array($result_invoice)){
		  		//echo JDToGregorian($row2['INVS_DT'] + GregorianToJD(12, 28, 1800))."<br>";
				
				array_push($invArray, $row2['INVS_NUM']);
				
				$tmpArray = array();
				// array: month of the day of sale, subtotal of sale of that day. 
				array_push($tmpArray, $row2['INVS_DT'], $row2['INVS_NUM'], $row2['CUS_ID'], $row2['INVS_AMT'], $row2['INVS_CD'], $row2['SALES_NUM'], $row2['CUS_NM']);
				
				array_push($dayArray, $tmpArray);
		}		
		
$endindex 	= count($invArray) -1;

$begininv 	= $invArray[$endindex];	
$endinv		= $invArray[0];

//echo "what is begininv: ".$begininv."<br>";
//echo "what is endinv: ".$endinv."<br>";

//mysql_free_result($result_invoice); 

		
		
		
		
		
		
		
		
		
		
		
		
for($i=0; $i < sizeof($invArray) ; $i++){

		if ($dayArray[$i][1] == $invArray[$i]){
				
				?>
                <div class="contentRow" > 
                	<div class="invHeader ">
                        <div class="col date first"><img src="images/open.png" /><?php echo JDToGregorian($dayArray[$i][0] + GregorianToJD(12, 28, 1800));?></div> 
                        <div class="col invs"><?php echo $dayArray[$i][1] ?></div>
                        <!-- div class="col cusid"><?php echo $dayArray[$i][2] ?></div -->
                        
                      
                        <div class="col amt ssamt last"><a href="javascript:void(0);" onClick="tb_show('','customer_details_invs.php?inv=<?php echo $dayArray[$i][1] ?>&amp;KeepThis=false&amp;TB_iframe=true&amp;width=500&amp;height=300',false);">$<?php echo number_format($dayArray[$i][3],2) ?></a></div>
                    </div>
                
                </div>
                           <?
				
				
		}
}		

		  
		  
		
		
		
		
				?>
                
                 
               