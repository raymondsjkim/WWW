<?
$tmpInv = $_GET["inv"];
//echo $tmpInv;

include("includes/resource/db.php");
$linkID = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname, $linkID);

                               $query_order 	= "SELECT invt_log.PROD_CD, invt_log.UT_DESC, invt_log.PROD_QTY, invt_log.UNIT_PRS, invt_log.ORDER_QTY, invt_log.DISCOUNT,"	
												." inv.REMARK"							
												." FROM invt_log JOIN inv ON inv.PROD_CD = invt_log.PROD_CD"
												." WHERE invt_log.INVS_NUM = ".$tmpInv
												//." AND inv.PROD_CD = invt_log.PROD_CD"
												." ORDER BY invt_log.PROD_CD";
								
								$result_order	= mysql_query($query_order, $linkID) or die("Data not found. order"); 
								$totalBOQty = 0;
								$totalQty 	= 0;
								$totalAmt 	= 0;
								
                        		//while($row2 = mysql_fetch_array($result_order) ){ 
								$itemArray = array();
								while($row1 = mysql_fetch_array($result_order)){
									$tmpArray = array();
									// array: month of the day of sale, subtotal of sale of that day. 
									array_push($tmpArray, $row1['PROD_CD'], $row1['UT_DESC'], $row1['PROD_QTY'], $row1['UNIT_PRS'], $row1['ORDER_QTY'], $row1['DISCOUNT'], $row1['REMARK']);
									array_push($itemArray, $tmpArray);
								}
								//print_r($itemArray);				
								for ($z = 0 ; $z < sizeof($itemArray) ; $z++){
								
										$row2 		= $itemArray[$z];
										$totalQty 	= $totalQty + $row2[2];
										$totalAmt 	= $totalAmt + ($row2[2]*$row2[3]*(100-$row2[5])/100);
										$totalBOQty = $totalBOQty + ($row2[4]-$row2[2]); 
										?>
										<div class="instock">
                                    	<div class="ord date first">&nbsp;</div>
                                        <div class="ord invs">&nbsp;</div>
                                        <div class="ord cusid">&nbsp;</div>
                                        <div class="ord cusname">&nbsp;</div>
										<div class="ord prodsku"><?php echo $row2[0] ?></div> 
										<div class="ord prodname"><?php echo $row2[1] ?></div> 
										<div class="ord unitprice">$<?php echo number_format($row2[3],2) ?></div>
										<div class="ord eta"><?php echo $row2[6] ?></div>
                                        <div class="ord qty"><?php echo $row2[4]-$row2[2] ?></div>
                                        <div class="ord qty"><?php echo number_format($row2[2],0) ?></div>
                                        <div class="ord amt last">$<?php echo number_format($row2[2]*$row2[3]*(100- $row2[5])/100,2) ?></div>
                                    </div>
							<?		} ?>
                               
								
								<div class="total">
                             		<div class="ord date first">&nbsp;</div>
                                    <div class="ord invs">&nbsp;</div>
                                    <div class="ord cusid">&nbsp;</div>
                                    <div class="ord cusname">&nbsp;</div>
									<div class="ord prodsku">&nbsp;</div>
                                    <div class="ord prodname">&nbsp;</div>
                                    <div class="ord unitprice">&nbsp;</div>	
                             		<div class="ord subtotal bold">Sub Total:</div>
                                    <div class="ord qty tboqty"><?php echo $totalBOQty ?></div>
                             		<div class="ord qty bold tqty"><?php echo $totalQty ?></div>
                                    <div class="ord amt bold tamt last">$<?php echo number_format($totalAmt,2) ?></div>
                               </div>
							
                            
<script type="text/javascript">
	$('.tboqty').each(function() {
		//totalBOQty += Number($(this).text());
		if (Number($(this).text()) > 0){
			$(this).parents('.contentRow').find('.ssboqty').html(Number($(this).text()));
		}
	})
</script>	   