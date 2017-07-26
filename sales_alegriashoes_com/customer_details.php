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
$tmpCus = $_GET["cus"];
//echo $tmpCus;

function format_phone($phone)
{
	$phone = preg_replace("/[^0-9]/", "", $phone);

	if(strlen($phone) == 7)
		return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
	elseif(strlen($phone) == 10)
		return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
	else
		return $phone;
}


include("includes/resource/db.php");
$linkID = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname, $linkID);

                               $query_order 	= "SELECT *"	
												//." inv.REMARK"							
												." FROM customer"
												." WHERE CUS_ID = '$tmpCus'";
												//." AND inv.PROD_CD = invt_log.PROD_CD"
												//." ORDER BY invt_log.PROD_CD";
								
								$result_order	= mysql_query($query_order, $linkID) or die("Data not found. order"); 
								
								
                        		//while($row2 = mysql_fetch_array($result_order) ){ 
								//$itemArray = array();
								while($row1 = mysql_fetch_array($result_order)){
									//$tmpArray = array();
									// array: month of the day of sale, subtotal of sale of that day. 
									//array_push($tmpArray, $row1['PROD_CD'], $row1['UT_DESC'], $row1['PROD_QTY'], $row1['UNIT_PRS'], $row1['ORDER_QTY'], $row1['DISCOUNT'], $row1['REMARK']);
									//array_push($itemArray, $tmpArray);
								
								//print_r($itemArray);				
								//for ($z = 0 ; $z < sizeof($itemArray) ; $z++){
								
										//$row2 		= $itemArray[$z];
										//$totalQty 	= $totalQty + $row2[2];
										//$totalAmt 	= $totalAmt + ($row2[2]*$row2[3]*(100-$row2[5])/100);
										//$totalBOQty = $totalBOQty + ($row2[4]-$row2[2]); 
										?>
										<table id="customerdetail">
                                        	<tr>
                                            	<td valign="top">
                                                    <label>Customer ID</label><div class="field"><?php echo $row1['CUS_ID'] ?></div> 
                                                   
                                         		</td>
                                                <td valign="top">                                             
                                                    <label>Sales #</label><div class="field"><?php echo $row1['SALES_NUM'] ?></div>
                                                    

</div>
                                        		</td>
                                            </tr>
                                            <tr class="even">
                                            	 <td valign="top">
                                                 	<label>Name</label><div class="field"><?php echo $row1['CUS_NM'] ?></div>
                                                    </td>
                                                <td valign="top"> 
                                                	<label>Terms</label><div class="field"><?php echo $row1['TERM_DESC'] ?>
                                                 </td>
                                                  
                                            
                                            </tr>
                                            <tr>  
                                                   
                                            	<td valign="top"><label>Attn</label><div class="field"><?php echo $row1['ATTN'] ?></div>
                                                </td>
                                                <td valign="top">
                                                	<label>Ship Via</label><div class="field"><?php echo $row1['SHIP_DESC'] ?></div>
                                                </td>
                                                
                                            </tr>
                                            <tr class="even">
                                            	<td valign="top"> <label>Phone</label><div class="field"><?php echo format_phone($row1['PHONE']) ?></div>
                                                </td>
                                                <td valign="top">
                                                </td>
                                            </tr>
                                            <tr>
                                           	  <td valign="top" class="address">
                                                <div><strong>Billing Address</strong></div>
                                                <?php echo $row1['ADDRESS'] ?><br />
                                                <?php if($row1['ADDRESS2'] != ""){ echo $row1['ADDRESS2']."<br/>";} ?>
                                                <?php echo $row1['CITY'] ?>, <?php echo $row1['STATE'] ?> <?php echo $row1['ZIP'] ?><br />
                                                <?php echo $row1['COUNTRY'] ?>
                                              </td>
                                                <td valign="top" class="address">
                                                <div><strong>Default Shipping Address</strong></div>
												<?php if($row1['SHP_ADDRESS'] == ""){echo "-";}else{ echo $row1['SHP_ADDRESS'];} ?><br />
                                                <?php if($row1['SHP_ADDRESS2'] != ""){ echo $row1['SHP_ADDRESS2']."<br/>";} ?>
                                                <?php if($row1['SHP_CITY'] !=""){echo $row1['SHP_CITY'].",";} ?> <?php echo $row1['SHP_STATE'] ?> <?php echo $row1['SHP_ZIP'] ?><br />
                                                <?php echo $row1['SHP_COUNTRY'] ?>
                                              </td>
                                             </tr>
                                         </table>
                                   
							<?		} ?>
                               
								
								