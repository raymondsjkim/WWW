<?php include("navigation/headerHTML.php"); ?>


<style type="text/css">

.invoicetable{float:left;width:460px;padding:10px;margin:30px 20px 0 0;border:1px solid #ccc;}
.last{margin-right:0;}

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
.invs{width:200px;}
</style>


<?php
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






$query_cus 	= "SELECT *"	
				//." inv.REMARK"							
				." FROM customer"
				." WHERE CUS_ID = '$tmpCus'"
				." AND SALES_NUM = '$sales'";
				//." AND inv.PROD_CD = invt_log.PROD_CD"
				//." ORDER BY invt_log.PROD_CD";
								
				$result_cus	= mysql_query($query_cus, $linkID) or die("Data not found. order"); 
								
								
                //while($row2 = mysql_fetch_array($result_order) ){ 
				//$itemArray = array();
				
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

					<span>What is the Customer ID?</span>                
                	<form action="customer.php" method="GET" id="search_customer" class="formInput">
                    <fieldset>
                    
                    
                    <input type="text" name="cus" id="search_customerid" class="searchbox grey" value="<?php echo $tmpCus ?>" /> <!-- autocomplete="off" -->
                    
                    <button class="btn action apply" tabindex="4" type="submit">Search<span></span></button>
                    
                    </fieldset>
                    </form>
                    
                    
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
                
                						
                					
					if (mysql_num_rows($result_cus) == 0) {
   
							?>
						 <p class="errorMsg">Please check the Customer ID you have entered is correct.</p>
					    <?php } else  {
                 
                 	
                     while($row1 = mysql_fetch_array($result_cus)){
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
                <p class="header2">Recent Invoices</p>
                <div class="titleContainer">
                    <div class="title date first">Date</div>
                    <div class="title invs">Invoice #</div>
                    <!--div class="title cusid">Cus. ID</div-->
                 
                    <div class="title amt last">Amount</div>
                
                </div>
                 <div id="invContentRows">
                <?php
				
$query_invoice 	= "SELECT TOP 20"
				."INVS_DT, INVS_NUM, CUS_ID, INVS_AMT, INVS_CD, SALES_NUM"
				." FROM invoice"
				//." WHERE invoice.INVS_DT"// BETWEEN $beginDate AND $endDate" 
				." WHERE INVS_CD = '1'"
				." AND SALES_NUM = '$sales'"
				." AND CUS_ID = '$tmpCus'"
				." ORDER BY INVS_NUM DESC";

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
                <div class="invContentRow" id=""> 
                	
                    <div class="invHeader">
                        <div class="col date first"><img src="images/open.png" /><?php echo JDToGregorian($dayArray[$i][0] + GregorianToJD(12, 28, 1800));?></div> 
                        <div class="col invs"><?php echo $dayArray[$i][1] ?></div>
                        <!-- div class="col cusid"><?php echo $dayArray[$i][2] ?></div -->
                        
                        <div class="col amt ssamt last"><a href="javascript:void(0);" onClick="tb_show('','customer_details_invs.php?inv=<?php echo $dayArray[$i][1] ?>&amp;KeepThis=false&amp;TB_iframe=true&amp;width=500&amp;height=300',false);">$<?php echo number_format($dayArray[$i][3],2) ?></a></div>
                    </div>
                    
                </div>	
             
             <?php
		}
}		

				?>
                </div>
                <a href="#" id="invShowMore" />Show next 20</a>
              </div><!-- EOF invoicetbables -->
				
                
                
                
                
                
                  <div class="invoicetable last">
                <p class="header2">Recent Orders</p>
                <div class="titleContainer">
                    <div class="title date first">Date</div>
                    <div class="title invs">Invoice #</div>
                    <!--div class="title cusid">Cus. ID</div-->
                 
                    <div class="title amt last">Amount</div>
                
                </div>
                 <div id="ordContentRows">
                <?php
				
$query_invoice 	= "SELECT TOP 20"
				."ORD_DT, ORD_NUM, CUS_ID, ORD_AMT, HANDL_FEE, SALES_NUM"
				." FROM orders"
				//." WHERE invoice.INVS_DT"// BETWEEN $beginDate AND $endDate" 
				//." WHERE INVS_CD = '1'"
				." WHERE SALES_NUM = '$sales'"
				." AND CUS_ID = '$tmpCus'"
				." ORDER BY ORD_NUM DESC";

$result_invoice	= mssql_query($query_invoice, $mslinkID) or die("Data not found. invoice"); 
	
	$invArray = array();
	$dayArray = array();	
	
		  while($row2 = mssql_fetch_array($result_invoice)){
		  		//echo JDToGregorian($row2['INVS_DT'] + GregorianToJD(12, 28, 1800))."<br>";
				
				array_push($invArray, $row2['ORD_NUM']);
				
				$tmpArray = array();
				// array: month of the day of sale, subtotal of sale of that day. 
				array_push($tmpArray, $row2['ORD_DT'], $row2['ORD_NUM'], $row2['CUS_ID'], $row2['ORD_AMT'], $row2['HANDL_FEE'], $row2['SALES_NUM'], $row2['CUS_NM']);
				
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
                <div class="ordContentRow" id=""> 
                	
                    <div class="invHeader">
                        <div class="col date first"><img src="images/open.png" /><?php echo JDToGregorian($dayArray[$i][0] + GregorianToJD(12, 28, 1800));?></div> 
                        <div class="col invs"><?php echo $dayArray[$i][1] ?></div>
                        <!-- div class="col cusid"><?php echo $dayArray[$i][2] ?></div -->
                        
                        <div class="col amt ssamt last"><a href="javascript:void(0);" onClick="tb_show('','customer_details_invs.php?inv=<?php echo $dayArray[$i][1] ?>&amp;KeepThis=false&amp;TB_iframe=true&amp;width=500&amp;height=300',false);">$<?php echo number_format($dayArray[$i][3],2) ?></a></div>
                    </div>
                    
                </div>	
             
             <?php
		}
}		

				?>
                </div>
                <a href="#" id="ordShowMore" />Show next 20</a>
          </div><!-- EOF invoicetbables -->   

<?
}
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