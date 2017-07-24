<style type="text/css">
#customerdetail{width:500px;font-family:Arial, Helvetica, sans-serif;font-size:12px;}
#customerdetail tr td{width:280px;vertical-align:top;padding:8px 5px;}
#customerdetail tr{margin-bottom:20px;}
#customerdetail label{float:left;font-weight:bold;}
#customerdetail .field{margin:0 0 0 80px;}
.address label{float:none;}
.address div{padding-bottom:5px;}
.address{line-height:130%;}
.even{background:#EEEEEE;}
</style>


<?
$tmpInv = $_GET["inv"];
echo $tmpInv;

include("includes/resource/db.php");
$mslinkID = mssql_connect($mshost, $msuser, $mspass) or die ('Error connecting to mssql');
mssql_select_db($msname, $mslinkID);




$query_order 	= "SELECT invt_log.INVS_NUM, invt_log.PROD_CD, invt_log.UT_DESC, invt_log.PROD_QTY, invt_log.UNIT_PRS, invt_log.ORDER_QTY, invt_log.DISCOUNT,"	
				." inv.REMARK"							
				." FROM invt_log JOIN inv ON inv.PROD_CD = invt_log.PROD_CD"
				." WHERE invt_log.INVS_NUM = '$tmpInv'" 
				//." AND invt"
				." ORDER BY invt_log.PROD_CD";
							
$result_order	= mssql_query($query_order, $mslinkID) or die("Data not found. order"); 

$itemArray = array();

while($row3 = mssql_fetch_array($result_order)){

	$tmpArray = array();
	// array: month of the day of sale, subtotal of sale of that day. 
	array_push($tmpArray, $row3['INVS_NUM'], $row3['PROD_CD'], $row3['UT_DESC'], $row3['PROD_QTY'], $row3['UNIT_PRS'], $row3['ORDER_QTY'], $row3['DISCOUNT'], $row3['REMARK']);
	
	array_push($itemArray, $tmpArray);
}
echo "what is  item array: ".print_r($itemArray);

mssql_free_result($result_order); 

$query_bo 	= "SELECT ord_log.INVS_NUM, ord_log.PROD_CD, ord_log.DESCRIP, ord_log.ORDER_QTY, ord_log.INVS_QTY, ord_log.UNIT_PRS, (ord_log.ORDER_QTY)-(ord_log.INVS_QTY) AS Difference,"	
				." inv.REMARK"							
				." FROM ord_log JOIN inv ON inv.PROD_CD = ord_log.PROD_CD"
				." WHERE ord_log.INVS_NUM = '$tmpInv'" 
				." AND (ord_log.INVS_QTY)-(ord_log.ORDER_QTY) < 0" 
				//." AND 
				." ORDER BY ord_log.PROD_CD";


								
$result_bo	= mssql_query($query_bo, $mslinkID) or die("Data not found. order"); 

$boitemArray = array();
while($row4 = mssql_fetch_array($result_bo)){

	
	
	$tmpArray = array();
	// array: month of the day of sale, subtotal of sale of that day. 
	array_push($tmpArray, $row4['INVS_NUM'], $row4['PROD_CD'], $row4['DESCRIP'], $row4['ORDER_QTY'], $row4['INVS_QTY'], $row4['UNIT_PRS'], $row4['Difference'], $row4['REMARK']);
	
	array_push($boitemArray, $tmpArray);
}
//echo "what is back order array: ".print_r($boitemArray);
mssql_free_result($result_bo); 




?>
                             <div class="invContent" style=""> 
                     		 
                             	<div class="detail" id="">
                            
            <?		
			$totalBOQty = 0;
			$totalQty 	= 0;
			$totalAmt 	= 0;
			
			 for($p=0; $p < sizeof($itemArray) ; $p++){
			 	if($itemArray[$p][0] == $invArray[$i]){
					//echo $itemArray[$p][0]."  ".$itemArray[$p][1]."  ".$itemArray[$p][2]."  ".$itemArray[$p][3]."  ".$itemArray[$p][4]."  ".$itemArray[$p][6]."<br>";
					//array_push($tmpArray, $row1['INVS_NUM'], $row1['PROD_CD'], $row1['UT_DESC'], $row1['PROD_QTY'], $row1['UNIT_PRS'], $row1['ORDER_QTY'], $row1['DISCOUNT'], $row1['REMARK']);
					$totalQty = $totalQty + $itemArray[$p][3];
					$totalAmt = $totalAmt + ($itemArray[$p][3]*$itemArray[$p][4]*(100-$itemArray[$p][6])/100);
									
					?>
                    <div class="instock">
                                    	<div class="ord date first">&nbsp;</div>
                                        <div class="ord invs">&nbsp;</div>
                                       
										<div class="ord prodsku"><?php echo $itemArray[$p][1] ?></div> 
										<div class="ord prodname"><?php echo $itemArray[$p][2] ?></div> 
										<div class="ord unitprice">$<?php echo number_format($itemArray[$p][4],2) ?></div>
										<div class="ord eta"><?php echo $itemArray[$p][7] ?></div>
                                        <div class="ord qty"><!-- ?= $row2['ORDER_QTY']-$row2['PROD_QTY']? --></div>
                                        <div class="ord qty"><?php echo number_format($itemArray[$p][3],0) ?></div>
                                        <div class="ord amt last">$<?php echo number_format($itemArray[$p][3]*$itemArray[$p][4]*(100- $itemArray[$p][6])/100,2) ?><?php if ($itemArray[$p][6] != 0){echo " *";}?></div>
                                    </div>
                    
                    
                    
                    
                    <?
				}
			 
			 }
			 for($b=0; $b < sizeof($boitemArray) ; $b++){
			 	if($boitemArray[$b][0] == $invArray[$i]){
					//echo "<font color=red>".$boitemArray[$b][0]."  ".$boitemArray[$b][1]."  ".$boitemArray[$b][2]."  ".$boitemArray[$b][3]."  ".$boitemArray[$b][4]."  ".$boitemArray[$b][6]."</font><br>";
					//array_push($tmpArray, $row2['INVS_NUM'], $row2['PROD_CD'], $row2['DESCRIP'], $row2['ORDER_QTY'], $row2['INVS_QTY'], $row2['UNIT_PRS'], $row2['Difference'], $row2['REMARK']);
					$totalBOQty = $totalBOQty + ($boitemArray[$b][3] - $boitemArray[$b][4]);

				?>
                 <div class="backorder">
                                    	<div class="ord date first">&nbsp;</div>
                                        <div class="ord invs">&nbsp;</div>
                                        <!--div class="ord cusid">&nbsp;</div>
                                        <div class="ord cusname">&nbsp;</div-->
										<div class="ord prodsku"><?php echo $boitemArray[$b][1] ?></div>
                                        <div class="ord prodname"><?php echo $boitemArray[$b][2] ?></div>
                                        <div class="ord unitprice">$<?php echo number_format($boitemArray[$b][5],2) ?></div>
                                        <div class="ord eta"><?php echo $boitemArray[$b][7] ?></div>
										<div class="ord qty"><?php echo number_format($boitemArray[$b][3] - $boitemArray[$b][4],0) ?></div>
										<div class="ord qty">&nbsp;</div>
										<div class="ord amt last">&nbsp;</div>
                                        
                                    </div>
                
                
                
                <?
				}
			 
			 }
			 
			 ?>
           
             
             
            				 </div>
                          
                    </div>