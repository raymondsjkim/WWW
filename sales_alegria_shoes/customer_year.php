<?php include("navigation/headerHTML.php"); ?>


<style type="text/css">

.invoicetable{float:left;width:460px;padding:10px;margin:30px 20px 0 0;border:1px solid #ccc;}
.dattaable{float:left;width:460px;padding:10px;margin:30px 20px 0 0;border:1px solid #ccc;}
.last{margin-right:0;}
.finalStatCategory{width:300px;text-align:right;}
.finalStatCategoryNum{text-align:right;}

#customerdetail{width:500px;font-family:Arial, Helvetica, sans-serif;font-size:12px;}
#customerdetail tr td{width:280px;vertical-align:top;padding:8px 5px;}
#customerdetail tr{margin-bottom:20px;}
#customerdetail label{float:left;font-weight:bold;}
#customerdetail .field{margin:0 0 0 80px;}
.address label{float:none;}
.address div{padding-bottom:5px;}
.address{line-height:130%;}
.even{background:#EEEEEE;}
.grey{color:#CCC;}


#summary .col{height:140px;}
#summary .col div{font-size:17px;padding-left:5px;text-align:left;padding-bottom:10px;}
#summary .cusid{width:90px;}
#summary .contactinfo{width:250px;}
#summary .billing{width:260px;}
#summary .shipping{width:260px;}
#summary .misc{text-align:right;}
#summary .misc div{text-align:right;padding-right:5px;}
#summary #date{text-align:left;}

.header2{font-size:22px; line-height:120%;font-style:italic; color:#666; float:none;margin:0 0 5px 0;padding:0;text-transform:uppercase;}


.red{color:#FF0000;}
.date{width: 90px;}
.invs{width:200px;text-align:right;}
</style>


<?php
error_reporting(0);
$lastyear = date("Y") - 1;
$year = isset($_POST['year']) ? $_POST['year'] : $lastyear;

if ($_GET["cus"] == ""){
	$tmpCus 	= "i.e. A9999";
	
}else{
	$tmpCus 	= $_GET["cus"];
}//echo $tmpCus;


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

function clarionToGreg($clariondate)
{
	$date = JDToGregorian($clariondate + GregorianToJD(12, 28, 1800));
	return $date;
	
}




$query_cus 	= "SELECT *"						
				." FROM customer"
				." WHERE CUS_ID like '$tmpCus'"
				." AND SALES_NUM like '$sales'";
				$result_cus	= mysql_query($query_cus, $linkID) or die("Data not found. order"); 
?>
                               
								
<div id="Container">
	
		
        
		<div id="Outer">
			<div id="Header">
				<?php include("navigation/topNav.php"); ?>
			</div>
						
		
            <div id="Wrapper">
            
                <div id="pageTitle">	
                
                	<script type="text/javascript">
						$(document).ready(function() {
							
							$('#search_customerid').focus(function() {
								//$(this).removeClass("idleField").addClass("focusField");
								if (this.value == this.defaultValue){ 
									this.value = '';
								}
								if(this.value != this.defaultValue){
									this.select();
								}
								$('#search_customerid').removeClass("grey");
							});
							$('#search_customerid').blur(function() {
								//$(this).removeClass("focusField").addClass("idleField");
								if ($.trim(this.value) == ''){
									this.value = (this.defaultValue ? this.defaultValue : '');
								}
								
							});
							if($('#search_customerid').val() != 'i.e. A9999') {
									$('#search_customerid').removeClass("grey");
							}
						});		
						
					
					</script>
					<span>Enter account Peppergate Customer ID: </span>                
                	<form action="customer_year.php" method="GET" id="search_customer" class="formInput">
                    <fieldset>
                    
                    
                    <input type="text" name="cus" id="search_customerid" class="searchbox grey" value="<?php echo $tmpCus ?>" /> <!-- autocomplete="off" -->
                    
                    <button class="btn action apply" tabindex="4" type="submit">Search<span></span></button>
                    
                    </fieldset>
                    </form>
	                <small>Currently in beta. If you have any suggestions, please send them my way to 
	                <a href="mailto:andrew@peppergate.com?Subject=Account%20Report%20Feedback">andrew@peppergate.com</a>. Thanks!</small>

                    
                    
                    <script type="text/javascript">
					
						// <!--
						
							$('#search_customer').submit(function() {
								
						
								if($('#search_customerid').val() == '') {
									alert('You forgot to enter a customer ID.');
									$('#search_customerid').focus();
									return false;
								}
						
								
								// Set the action of the form to stop spammers
								$('#subscribe_form').append("<input type=\"hidden\" name=\"check\" value=\"1\" \/>");
								return true;
						
							});
						// -->
						</script>

                    
                    
                    
				</div> <!-- EOF Pagetitle -->	
                
	<?php if (  $_GET["cus"] != ""){ 	
			// if (mysql_num_rows($result_cus) == 0) {
				// <p class="errorMsg">Please check the Customer ID you have entered is correct.</p>
		     
		    // else {
	     		while($row1 = mysql_fetch_array($result_cus)){ ?>			
	                <p class="header2">Customer Information</p>
	                <div id="summary">
							
	                    <div class="col cusid bold">
	                    	<p>Customer ID</p>
	                    	<div><?php echo $row1['CUS_ID'] ?></div>
	                        
	                    </div>
	                    
	                    <div class="col contactinfo bold">
	                    	<p>Customer Contact Info</p>
	                    	<div>
								<?php echo $row1['CUS_NM'] ?><br />
	                            Attn: <?php echo $row1['ATTN'] ?><br />
	                            <?php echo format_phone($row1['PHONE']) ?>

	                        </div>
	                        
	                    </div>
	                    <div class="col billing bold">
	                    	<p>Billing Address</p>
	                    	<div><?php echo $row1['ADDRESS'] ?><br />
	                                                <?php if($row1['ADDRESS2'] != ""){ echo $row1['ADDRESS2']."<br/>";} ?>
	                                                <?php echo $row1['CITY'] ?>, <?php echo $row1['STATE'] ?> <?php echo $row1['ZIP'] ?><br />
	                                                <?php echo $row1['COUNTRY'] ?>
	                        </div>
	                        
	                    </div>
	                    <div class="col shipping bold">
	                    	<p>Default Shipping Address</p>
	                    	<div><?php if($row1['SHP_ADDRESS'] == ""){echo "-";}else{ echo $row1['SHP_ADDRESS'];} ?><br />
	                                                <?php if($row1['SHP_ADDRESS2'] != ""){ echo $row1['SHP_ADDRESS2']."<br/>";} ?>
	                                                <?php if($row1['SHP_CITY'] !=""){echo $row1['SHP_CITY'].",";} ?> <?php echo $row1['SHP_STATE'] ?> <?php echo $row1['SHP_ZIP'] ?><br />
	                                                <?php echo $row1['SHP_COUNTRY'] ?>
	                        </div>
	                        
	                    </div>
	                    <div class="col misc bold last">
	                    	<p>Terms</p>
	                    	<div><?php echo $row1['TERM_DESC'] ?></div>
							<p>Ship Via</p>
	                    	<div><?php echo $row1['SHIP_DESC'] ?></div>
	                        
	                    </div>
                    
                    <?php		} ?>
                </div><!-- EOD summary -->
                
                <div class="invoicetable">
                <form action="customer_year.php?cus=<?php echo $tmpCus ?>" method="POST">
	                <div class="header2"><?php echo $year ?> Invoices
	                	<div style="float:right;font-size:medium;text-transform:none;">View year:
	                	<select name="year">
	                		<?php for ($i=date("Y")-1; $i > 2009; $i--) { 
	                			echo "<option value=".$i.">".$i."</option>";
	                		} ?>
	                	</select>
	                	<input style="display:inline;height:auto;width:auto;" type="submit" name="submit">
	                	</div>
	            	</div>
                </form>

                <div class="titleContainer">
                    <div class="title date first">Month</div>
                    <!-- <div class="title invs">Invoice #</div> -->
                    <!--div class="title cusid">Cus. ID</div-->
                 
                    <div class="title amt last">Total</div>
                
                </div>
                 <div id="invContentRows">
                <?php

    // Global metric cache
	$totalInvoices = "0";

	//clarion date for 1/1/2010. Hack but this will never change
	$clarion2010 = 76340;
	$clarionMultiplier = $year - 2010;

	//find year since 2010 in clarion. .25 for leap year
	$beginDate = ($clarionMultiplier * 365.25) + $clarion2010;
	$endDate = $beginDate + 365.25;

	$query_invoice 	= "SELECT "
					."INVS_DT, INVS_NUM, CUS_ID, INVS_AMT, INVS_CD, SALES_NUM"
					." FROM invoice"
					." WHERE invoice.INVS_DT BETWEEN $beginDate AND $endDate" 
					." AND INVS_CD = '1'"
					." AND SALES_NUM = '$sales'"
					." AND CUS_ID = '$tmpCus'"
					." ORDER BY INVS_DT";

	$result_invoice	= mssql_query($query_invoice, $mslinkID) or die("Data not found. invoice"); 
	
  	// invArray is for the total invoice amount of each month
	$monthArray = array("0" => "January",
						"1" => "February",
						"2" => "March",
						"3" => "April",
						"4" => "May",
						"5" => "June",
						"6" => "July",
						"7" => "August",
						"8" => "September",
						"9" => "October",
						"10" => "November",
						"11" => "December",
						"12" => "Total Invoices");	
	$monthlyTotalArray = array();
	$monthlyTotal = "";
	$verifyMonth = "";

	while($row2 = mssql_fetch_array($result_invoice)){
		$totalInvoices += 1;

  		if ($verifyMonth == "") {
  				$verifyMonth = substr(clarionToGreg($row2['INVS_DT']), 0, 2);
  			}

  		if ($verifyMonth != substr(clarionToGreg($row2['INVS_DT']), 0, 2)) {
  			array_push($monthlyTotalArray, $monthlyTotal);
  			$monthlyTotal = "";
  		}
	  	
	  	$monthlyTotal += $row2['INVS_AMT'];
	  	$verifyMonth = substr(clarionToGreg($row2['INVS_DT']), 0, 2);
		}

		array_push($monthlyTotalArray, $monthlyTotal);

		// fill in blank months with 0
		$fillerArr = (int)0;
		$monthCount = 12 - count($monthlyTotalArray);
		for ($i=0; $i < $monthCount; $i++) { 
			array_push($monthlyTotalArray, $fillerArr);
		}

		$invoiceTotal = array_sum($monthlyTotalArray);
		array_push($monthlyTotalArray, $invoiceTotal);

		$averageInvoice = $invoiceTotal / $totalInvoices;
		$q1 = array_sum(array_slice($monthlyTotalArray, 0, 3));
		$q2 = array_sum(array_slice($monthlyTotalArray, 3, 3));
		$q3 = array_sum(array_slice($monthlyTotalArray, 6, 3));
		$q4 = array_sum(array_slice($monthlyTotalArray, 9, 3));



	// print_r($monthlyTotalArray);
	// print_r($monthArray);

for($i=0; $i < sizeof($monthArray) ; $i++){
				?>
                <div class="invContentRow" id=""> 
                    <div class="invHeader">
                        <?php if ($monthArray[$i] == "Total Invoices") { ?>
                        	<br />
                        	<div class="col first finalStatCategory"><b><?php echo $monthArray[$i];?>:</b></div> 
	                        <div class="col amt ssamt last"><b>$<?php echo number_format($monthlyTotalArray[$i],2); ?></b></div>
	                        <br />
                        	
                        	<div class="col first finalStatCategory"><b>Quarter 1:</b></div> 
	                        <div class="col amt ssamt last">$<?php echo number_format($q1,2); ?></div>                       	
                        	<div class="col first finalStatCategory"><b>Quarter 2:</b></div> 
	                        <div class="col amt ssamt last">$<?php echo number_format($q2,2); ?></div>             	
                        	<div class="col first finalStatCategory"><b>Quarter 3:</b></div> 
	                        <div class="col amt ssamt last">$<?php echo number_format($q3,2); ?></div>                        	
                        	<div class="col first finalStatCategory"><b>Quarter 4:</b></div> 
	                        <div class="col amt ssamt last">$<?php echo number_format($q4,2); ?></div>

                        <?php } else { ?>
                        	<div class="col date first"><?php echo $monthArray[$i];?></div> 
                        	<div class="col amt ssamt last">$<?php echo number_format($monthlyTotalArray[$i],2); ?></div>
                        <?php } ?>                        	
                    </div>
                </div>
    <?php } ?>
                </div>
            </div><!-- EOF Past Invoices -->
				  
            <!-- Start 2015 YTD Invoices -->       
            <div class="invoicetable last">
                <p class="header2"><?php echo date("Y"); ?> Year to Date Invoices</p>
                <div class="titleContainer">
                    <div class="title date first">Month</div>
                    <div class="title invs">Percent Delta</div>
                    <div class="title amt last">Total</div>
                </div>
                 <div id="ordContentRows">
                
                <?php

    // Global metric cache
	$totalInvoicesCur = "0";
	$openOrderSum		= "";
	$totalOrderSum		= "";

	$monthlyTotalCurArray 	= array();
	$monthlyTotal 		= "";
	$verifyMonth 		= "";
	$beginDateCur 		= ((date("Y") - 2010) * 365.25) + $clarion2010;
	$endDateCur			= $beginDateCur + 365.25;
	$query_invoice_cur 	= "SELECT "
				."INVS_DT, INVS_NUM, CUS_ID, INVS_AMT, INVS_CD, SALES_NUM"
				." FROM invoice"
				." WHERE invoice.INVS_DT BETWEEN $beginDateCur AND $endDateCur" 
				." AND INVS_CD = '1'"
				." AND SALES_NUM = '$sales'"
				." AND CUS_ID = '$tmpCus'"
				." ORDER BY INVS_DT";
	$result_invoice_cur	= mssql_query($query_invoice_cur, $mslinkID) or die("Data not found. invoice"); 

	$query_order = "SELECT"
				." ORD_DT, ORD_NUM, CUS_ID, ORD_AMT, HANDL_FEE, SALES_NUM, PK_PDT"
				." FROM orders"
				." WHERE ORD_DT BETWEEN $beginDateCur AND $endDateCur" 
				." AND SALES_NUM = '$sales'"
				." AND CUS_ID = '$tmpCus'";
	$result_query_order	= mssql_query($query_order, $mslinkID) or die("Data not found. invoice"); 
	
	while ($row4 = mssql_fetch_assoc($result_query_order)) {
		if ($row4[PK_PDT] == 0) {
			$openOrderSum += $row4[ORD_AMT];
		}
		$totalOrderSum += $row4[ORD_AMT];
	}

	while($row3 = mssql_fetch_array($result_invoice_cur)){
		$totalInvoicesCur += 1;
  		if ($verifyMonth == "") {
  				$verifyMonth = substr(clarionToGreg($row3['INVS_DT']), 0, 2);
  			}

  		if ($verifyMonth != substr(clarionToGreg($row3['INVS_DT']), 0, 2)) {
  			array_push($monthlyTotalCurArray, $monthlyTotal);
  			$monthlyTotal = "";
  		}
	  	
	  	$monthlyTotal += $row3['INVS_AMT'];
	  	$verifyMonth = substr(clarionToGreg($row3['INVS_DT']), 0, 2);
	}

	array_push($monthlyTotalCurArray, $monthlyTotal);

	// fill in blank months with 0
	$fillerArr = (int)0;
	$monthCount = 12 - count($monthlyTotalCurArray);
	for ($i=0; $i < $monthCount; $i++) { 
		array_push($monthlyTotalCurArray, $fillerArr);
	}

	$invoiceTotalCur = array_sum($monthlyTotalCurArray);
	array_push($monthlyTotalCurArray, $invoiceTotalCur);

	$q1cur = array_sum(array_slice($monthlyTotalCurArray, 0, 3));
	$q2cur = array_sum(array_slice($monthlyTotalCurArray, 3, 3));
	$q3cur = array_sum(array_slice($monthlyTotalCurArray, 6, 3));
	$q4cur = array_sum(array_slice($monthlyTotalCurArray, 9, 3));

	$averageInvoiceCur = $invoiceTotalCur / $totalInvoicesCur;

	$percentDelta = array();
	for ($i=0; $i < 12; $i++) { 
		if ($monthlyTotalArray[$i] == 0) {
			$tmpDelta = "&infin;";
			array_push($percentDelta, $tmpDelta);
		}
		else {
			$tmpDelta = (((int)$monthlyTotalCurArray[$i] / (int)$monthlyTotalArray[$i]) - 1) * 100;
			array_push($percentDelta, number_format($tmpDelta,1));
		}
	}

	if ($q1 == 0) {
		$q1d = "&infin;";
	}
	else{
		$q1d = number_format(((($q1cur / $q1) - 1) * 100),1);
	}
	if ($q2 == 0) {
		$q2d = "&infin;";
	}
	else {
		$q2d = number_format(((($q2cur / $q2) - 1) * 100),1);
	}
	if ($q3 == 0) {
		$q3d = "&infin;";
	}
	else {
		$q3d = number_format(((($q3cur / $q3) - 1) * 100),1);
	}
	if ($q4 == 0) {
		$q4d = "&infin;";
	}
	else {
		$q4d = number_format(((($q4cur / $q4) - 1) * 100),1);
	}

	// echo "<pre>"; print_r($monthlyTotalArray);echo "<br />"; 
	// print_r($monthlyTotalCurArray);echo "<br />";
	// print_r($percentDelta);
	// echo "</pre>"; 
	for($i=0; $i < sizeof($monthArray) ; $i++){
					?>
	                <div class="invContentRow" id=""> 
	                    <div class="invHeader">
	                        <?php if ($monthArray[$i] == "Total Invoices") { ?>
	                        	<br />
	                        	<div class="col first finalStatCategory"><b><?php echo $monthArray[$i];?>:</b></div> 
		                        <div class="col amt ssamt last"><b>$<?php echo number_format($monthlyTotalCurArray[$i],2); ?></b></div>
		                        <br />
	                        	<div class="col first date"><b>Quarter 1:</b></div> 
	                        	<div class="col invs"><?php 
		                        	if (substr($q1d, 0,1) == "-") {
		                        		echo "<font color='red'>";
		                        		echo $q1d."%"; 
		                        		echo "</font>";
		                        	}
		                        	else {
			                        	echo $q1d."%"; 
		                        	} ?>
		                        </div>
		                        <div class="col amt ssamt last">$<?php echo number_format($q1cur,2); ?></div>                       	
	                        	<div class="col first date"><b>Quarter 2:</b></div> 
								<div class="col invs"><?php 
		                        	if (substr($q2d, 0,1) == "-") {
		                        		echo "<font color='red'>";
		                        		echo $q2d."%"; 
		                        		echo "</font>";
		                        	}
		                        	else {
			                        	echo $q2d."%"; 
		                        	} ?>
		                        </div>
		                        <div class="col amt ssamt last">$<?php echo number_format($q2cur,2); ?></div>             	
	                        	<div class="col first date"><b>Quarter 3:</b></div> 
								<div class="col invs"><?php 
		                        	if (substr($q3d, 0,1) == "-") {
		                        		echo "<font color='red'>";
		                        		echo $q3d."%"; 
		                        		echo "</font>";
		                        	}
		                        	else {
			                        	echo $q3d."%"; 
		                        	} ?>
		                        </div>
		                        <div class="col amt ssamt last">$<?php echo number_format($q3cur,2); ?></div>                        	
	                        	<div class="col first date"><b>Quarter 4:</b></div> 
	                        	<div class="col invs"><?php 
		                        	if (substr($q4d, 0,1) == "-") {
		                        		echo "<font color='red'>";
		                        		echo $q4d."%"; 
		                        		echo "</font>";
		                        	}
		                        	else {
			                        	echo $q4d."%"; 
		                        	} ?>
		                        </div>
		                        <div class="col amt ssamt last">$<?php echo number_format($q4cur,2); ?></div>
		                        <br />
	                        	<div class="col first date"><b>Open Orders:</b></div> 
		                        <div class="col amt ssamt last">$<?php echo number_format($openOrderSum,2); ?></div>                       	
<!-- 	                        	<div class="col first date"><b>Total Orders:</b></div> 
		                        <div class="col amt ssamt last">$<?php echo number_format($totalOrderSum,2); ?></div>    -->                    	
	                        <?php } else { ?>
	                        	<div class="col date first"><?php echo $monthArray[$i];?></div> 
	                        	<div class="col invs"><?php 
		                        	if (substr($percentDelta[$i], 0,1) == "-") {
		                        		echo "<font color='red'>";
		                        		echo $percentDelta[$i]."%"; 
		                        		echo "</font>";
		                        	}
		                        	else {
			                        	echo $percentDelta[$i]."%"; 
		                        	} ?>
		                        </div>
	                        	<div class="col amt ssamt last">$<?php echo number_format($monthlyTotalCurArray[$i],2); ?></div>
	                        <?php } ?>                        	
	                    </div>
	                </div>
    	<?php } ?>
                </div>
            </div><!-- EOF 2015 YTD Invoices -->

	<?
	} ?>


<script>
$(document).ready(function(){

	$('#loading').fadeOut('slow', function() {
    // Animation complete.
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
	
	$(function(){
      $('#invShowMore').click(function(event) {
         event.preventDefault();
         var number = $('.contentRow').size()+20;
		
        $.ajax({
           type: "POST",
           url: "customer_getnextinv.php",
           data: "count="+number+"&cus=<?php echo $tmpCus ?>",
           success: function(results){
             $('#invContentRows').append(results);
           }
         });

      });
	  $(function(){
      $('#ordShowMore').click(function(event) {
         event.preventDefault();
         var number = $('.contentRow').size()+20;
		
        $.ajax({
           type: "POST",
           url: "customer_getnextinv.php",
           data: "count="+number+"&cus=<?php echo $tmpCus ?>",
           success: function(results){
             $('#ordContentRows').append(results);
           }
         });

      });
});
});


});
	
	
</script>
                
                
                
          </div><!-- EOD wrapper -->
     </div><!-- EOD outer -->
   
</div><!-- EOD container -->