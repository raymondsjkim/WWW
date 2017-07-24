

<?php include("navigation/headerHTML.php"); ?>

<script type="text/javascript">	
			$(function(){
				  $('input').daterangepicker({presetRanges: [
						{text: 'Today', dateStart: 'Today', dateEnd: 'Today' },
						{text: 'Last 7 days', dateStart: 'Last <?php echo date("l") ?>', dateEnd: 'Today' },
						{text: 'Month to date', dateStart: '<?php echo date("n") ?>/1/<?php echo date("y")?>', dateEnd: 'Today' }
					], 
presets:{specificDate:'Specific Date',dateRange:'Date Range'},arrows:false, onClose:function(){}}); 
			 });//$('#range').submit();
</script>

</head>

<body>

<style type="text/css">
.red {color:#FF0000;}
</style>

<div id="loading">
	<span id="loadingContainer"><img src="images/25.gif" /><br />
It's loading a lot of your sales data,<br />
Please wait patiently.</span>

</div>

<div id="btt" style="position:absolute;right:10px;top:-100px;z-index:999;border:none;">
  
     <div><a href="#top"><img src="images/backtotop.png" border="none"></a></div>

</div>

<div id="Container">
	
		
        
		<div id="Outer">
			<div id="Header">
				<?php include("navigation/topNav.php"); ?>
			</div>
						
		
            <div id="Wrapper">
            
                <div id="pageTitle">
					
					<p>Invoice Report</p>
                
                	<form action="index.php" method="GET" id="range" class="formInput">
                    <fieldset>
                    
                    
                    <input type="text" name="rangeA" id="rangeA" class="pointer" value="<?php echo $range ?>" autocomplete="off"/>
                    
                    <button class="btn action apply" tabindex="4" type="submit">Apply<span></span></button>
                    <div>*Use the <a href="sales.php">Year to Date Report</a> to see Monthly Sales</div>
                    </fieldset>
                    </form>
				</div>


				 <div id="summary">
                    <div class="col date bold">
                    	<p>Date</p>
                    	<div id="date"></div>
                        
                    </div>
                    
                    <div class="col invs bold">
                    	<p>Total Invoice</p>
                    	<div id="totalinvs"></div>
                        
                    </div>
                    <div class="col qty bold">
                    	<p>Total Quantity</p>
                    	<div id="totalqty"></div>
                        
                    </div>
                    <div class="col amt bold last">
                    	<p>Total Amount</p>
                    	<div  id="totalamt"></div>
                        
                    </div>
                </div>
<!--form action="index.php" id="range" method="GET">
	<input type="text" name="rangeA" id="rangeA" value="<?php echo $range ?>" autocomplete="off"/>
   >
</form-->      
                

<?php



function strstrb($h,$n){
    return array_shift(explode($n,$h,2));
}



if(strpos($range, '-') === false){
	
	//echo "difference: ".$range."<br/>";
	$endDate 	= daysDifference($baseDate, $range);
	$beginDate 	= daysDifference($baseDate, $range);
} else {
	$range1		= strstrb($range, " - ");
	$range2 	= substr(strstr($range, ' - '), 3);
	//echo "start: ".$range1."<br/>";
	//echo "end: ".$range2."<br/>";
	$endDate 	= daysDifference($baseDate, $range2);
	$beginDate 	= daysDifference($baseDate, $range1);
}




//echo "what is beginDate: ".$beginDate."<br>";
//echo "what is endDate: ".$endDate."<br>";



$query_invoice 	= "SELECT invoice.INVS_DT, invoice.INVS_NUM, invoice.CUS_ID, invoice.INVS_AMT, invoice.INVS_CD, invoice.SALES_NUM,"
				." customer.CUS_NM"
				." FROM invoice, customer"
				." WHERE invoice.INVS_DT BETWEEN $beginDate AND $endDate" 
				." AND invoice.INVS_CD = '1'"
				." AND $select_table = '$sales'"
				." AND customer.CUS_ID = invoice.CUS_ID"
				." ORDER BY invoice.INVS_DT, invoice.INVS_NUM, invoice.CUS_ID ASC";

$result_invoice	= mssql_query($query_invoice, $mslinkID) or die("Data not found. invoice"); 


$invArray = array();
$dayArray = array();
while($row = mssql_fetch_array($result_invoice)){

	array_push($invArray, $row['INVS_NUM']);
	
	$tmpArray = array();
	// array: month of the day of sale, subtotal of sale of that day. 
	array_push($tmpArray, $row['INVS_DT'], $row['INVS_NUM'], $row['CUS_ID'], $row['INVS_AMT'], $row['INVS_CD'], $row['SALES_NUM'], $row['CUS_NM']);
	
	array_push($dayArray, $tmpArray);
}
//print_r ($invArray);
//echo "<br><br>";
//print_r ($dayArray);
//echo "<br><br>";
$endindex 	= count($invArray) -1;

$begininv 	= $invArray[0];
$endinv		= $invArray[$endindex];	

//echo "what is begininv: ".$begininv."<br>";
//echo "what is endinv: ".$endinv."<br>";

//mysql_free_result($result_invoice); 

if ( sizeof($invArray) > 0){

$query_order 	= "SELECT invt_log.INVS_NUM, invt_log.PROD_CD, invt_log.UT_DESC, invt_log.PROD_QTY, invt_log.UNIT_PRS, invt_log.ORDER_QTY, invt_log.DISCOUNT,"	
				." inv.REMARK"							
				." FROM invt_log JOIN inv ON inv.PROD_CD = invt_log.PROD_CD"
				." WHERE invt_log.INVS_NUM BETWEEN $begininv AND $endinv" 
				//." "
				." ORDER BY invt_log.PROD_CD";
								
$result_order	= mssql_query($query_order, $mslinkID) or die("Data not found. order"); 

$itemArray = array();
while($row1 = mssql_fetch_array($result_order)){

	
	
	$tmpArray = array();
	// array: month of the day of sale, subtotal of sale of that day. 
	array_push($tmpArray, $row1['INVS_NUM'], $row1['PROD_CD'], $row1['UT_DESC'], $row1['PROD_QTY'], $row1['UNIT_PRS'], $row1['ORDER_QTY'], $row1['DISCOUNT'], $row1['REMARK']);
	
	array_push($itemArray, $tmpArray);
}
//echo "what is  item array: ".print_r($itemArray);

mssql_free_result($result_order); 

$query_bo 	= "SELECT ord_log.INVS_NUM, ord_log.PROD_CD, ord_log.DESCRIP, ord_log.ORDER_QTY, ord_log.INVS_QTY, ord_log.UNIT_PRS, (ord_log.ORDER_QTY)-(ord_log.INVS_QTY) AS Difference,"	
				." inv.REMARK"							
				." FROM ord_log JOIN inv ON inv.PROD_CD = ord_log.PROD_CD"
				." WHERE ord_log.INVS_NUM BETWEEN $begininv AND $endinv" 
				." AND (ord_log.INVS_QTY)-(ord_log.ORDER_QTY) < 0" 
				//." AND 
				." ORDER BY ord_log.PROD_CD";


								
$result_bo	= mssql_query($query_bo, $mslinkID) or die("Data not found. order"); 

$boitemArray = array();
while($row2 = mssql_fetch_array($result_bo)){

	
	
	$tmpArray = array();
	// array: month of the day of sale, subtotal of sale of that day. 
	array_push($tmpArray, $row2['INVS_NUM'], $row2['PROD_CD'], $row2['DESCRIP'], $row2['ORDER_QTY'], $row2['INVS_QTY'], $row2['UNIT_PRS'], $row2['Difference'], $row2['REMARK']);
	
	array_push($boitemArray, $tmpArray);
}
//echo "what is back order array: ".print_r($boitemArray);
mssql_free_result($result_bo); 

}
/*
$query_getSales = "SELECT * FROM sls_pro WHERE SALES_NUM = $sales";
$result_getSales= mysql_query($query_getSales, $linkID) or die("Data not found. sales"); 

$row_getSales 	= mysql_fetch_assoc($result_getSales);	
$sale_name		= $row_getSales['COMP_NM'] ;
*/
$alt = "even";
?>
<div id="titleContainer">
    <div class="title date first">Date</div>
    <div class="title invs">Invoice<br />#</div>
    <div class="title cusid">Cus. ID</div>
    <div class="title cusname">Customer Name</div>
    <div class="title prodsku">SKU</div>
    <div class="title prodname">Product Name</div>
    <div class="title unitprice">Unit Price</div>
    <div class="title eta">Next Batch<br />ETA</div>
    <div class="title qty">BO Qty</div>
    <div class="title qty sqty">Qty</div>
    <div class="title amt last">Amount</div>

</div>
<?php
if ( sizeof($invArray) == 0){


	echo "<div style='width:100;text-align:center;padding-top:20px;'>No invoices found.</div>";

}

for($i=0; $i < sizeof($invArray) ; $i++){

		if ($dayArray[$i][1] == $invArray[$i]){
			if ($alt == "even"){$alt = "odd";}else{$alt = "even";};
			//echo $dayArray[$i][0]."  ".$dayArray[$i][1]."  ".$dayArray[$i][2]."  ".$dayArray[$i][3]."  ".$dayArray[$i][4]."  ".$dayArray[$i][6]."<br>";
			//array_push($tmpArray, $row['INVS_DT'], $row['INVS_NUM'], $row['CUS_ID'], $row['INVS_AMT'], $row['INVS_CD'], $row['SALES_NUM'], $row['CUS_NM']);
			?>
            <div class="contentRow <?php echo $alt ?>" id="row_<?php echo $x ?>"> 
                	<div class="invHeader addhand <?php echo $alt ?>">
                        <div class="col date first"><img src="images/open.png" /><?php echo JDToGregorian($dayArray[$i][0] + GregorianToJD(12, 28, 1800));?></div> 
                        <div class="col invs"><?php echo $dayArray[$i][1] ?></div>
                        <div class="col cusid"><?php echo $dayArray[$i][2] ?></div>
                        <div class="col cusname"><a href="javascript:void(0);" onClick="tb_show('','customer_details.php?cus=<?php echo $dayArray[$i][2] ?>&amp;KeepThis=false&amp;TB_iframe=true&amp;width=500&amp;height=300',false);"><?php echo $dayArray[$i][6] ?></a></div>
                        <div class="col prodsku">&nbsp;</div>
                        <div class="col prodname">&nbsp;</div>
                        <div class="col unitprice">&nbsp;</div>
                        <div class="col eta">&nbsp;</div>
                        <div class="col qty ssboqty">&nbsp;</div>
                        <div class="col qty ssqty">&nbsp;</div>
                        <div class="col amt ssamt last">$<?php echo number_format($dayArray[$i][3],2) ?></div>
                    </div>
                		
                     <div class="invContent" style="display:none;"> 
                     		 
                             	<div class="detail" id="<?php echo $row1[1] ?>">
                            
            <?php		
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
                                        <div class="ord cusid">&nbsp;</div>
                                        <div class="ord cusname">&nbsp;</div>
										<div class="ord prodsku"><?php echo $itemArray[$p][1] ?></div> 
										<div class="ord prodname"><?php echo $itemArray[$p][2] ?></div> 
										<div class="ord unitprice">$<?php echo number_format($itemArray[$p][4],2) ?></div>
										<div class="ord eta"><?php echo $itemArray[$p][7] ?></div>
                                        <div class="ord qty"><!-- ?= $row2['ORDER_QTY']-$row2['PROD_QTY']? --></div>
                                        <div class="ord qty"><?php echo number_format($itemArray[$p][3],0) ?></div>
                                        <div class="ord amt last">$<?php echo number_format($itemArray[$p][3]*$itemArray[$p][4]*(100- $itemArray[$p][6])/100,2) ?><?php if ($itemArray[$p][6] != 0){echo " *";}?></div>
                                    </div>
                    
                    
                    
                    
                    <?php
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
                                        <div class="ord cusid">&nbsp;</div>
                                        <div class="ord cusname">&nbsp;</div>
										<div class="ord prodsku"><?php echo $boitemArray[$b][1] ?></div>
                                        <div class="ord prodname"><?php echo $boitemArray[$b][2] ?></div>
                                        <div class="ord unitprice">$<?php echo number_format($boitemArray[$b][5],2) ?></div>
                                        <div class="ord eta"><?php echo $boitemArray[$b][7] ?></div>
										<div class="ord qty"><?php echo number_format($boitemArray[$b][3] - $boitemArray[$b][4],0) ?></div>
										<div class="ord qty">&nbsp;</div>
										<div class="ord amt last">&nbsp;</div>
                                        
                                    </div>
                
                
                
                <?php
				}
			 
			 }
			 
			 ?>
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
             
             
            				 </div>
                          
                    </div>
 
                </div>	
             
             
             <?php
			
		}

}


?>


   
    <script>
$(document).ready(function(){

	$('#loading').fadeOut('slow', function() {
    // Animation complete.
  	});

	tmpChecker = 0;
	$(".invHeader").click(function() {
		$(this).next('.invContent').slideToggle("fast")
	});
	$(".invHeader").toggle(function(){
			$(this).children('.date').children().attr("src", "images/close.png");
			$(this).parent('.contentRow').css('background','#f8f8f8');
			$(this).css('background','#EEEEEE');
			
			//var inv = $(this).parent('.contentRow').find('.detail').attr('id');
			//var variable ="inv="+inv; 
			
			//$(this).parent('.contentRow').find('.detail').load('invoice_details.php', variable );
			//$(this).css('background-image','url(images/linetotal.gif) right bottom no-repeat');
			
			}, function () {
			$(this).children('.date').children().attr("src", "images/open.png");
			$(this).parent('.contentRow').css('border-bottom','1px solid #eeeeee');
			$(this).parent('.contentRow').css('background','#FFFFFF');
			$(this).css('background','#FFFFFF');
			
	});
	//totalBOQty = 0;
	$('.tboqty').each(function() {
		//totalBOQty += Number($(this).text());
		if (Number($(this).text()) > 0){
			$(this).parents('.contentRow').find('.ssboqty').html(Number($(this).text()));
		}
	})
	
	
	
	
	totalQty = 0;
	$('.tqty').each(function() {
		totalQty += Number($(this).text());
		if (Number($(this).text()) < 0){
		
			$(this).parents('.contentRow').find('.ssqty').addClass("red");
		}
		$(this).parents('.contentRow').find('.ssqty').html(Number($(this).text()));
	})
	
	totalAmt = 0;
	$('.tamt').each(function() {
		//alert(parseFloat($(this).text().replace(",","").substring(1)));
		
		totalAmt += parseFloat($(this).text().replace(",","").substring(1));
		
		if (parseFloat($(this).text().replace(",","").substring(1)) < 0){
		
			$(this).parents('.contentRow').find('.ssamt').addClass("red");
			$(this).parents('.contentRow').find('.ssamt').html("$"+parseFloat($(this).text().replace(",","").substring(1)).toFixed(2));
		}
		
	})
	
	$('#date').html("<?php echo $range ?>");
	$('#totalinvs').html(<?php echo mssql_num_rows($result_invoice) ?>);
	$('#totalqty').html(totalQty);
	$('#totalamt').html("$"+totalAmt.toFixed(2));
	
	
});
	
	
</script>
  
	      </div>
		</div>
		

</div>
<?php include("includes/php/google.analytics.php"); ?>

</body>

</html>
