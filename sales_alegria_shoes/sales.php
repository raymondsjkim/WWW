

<?php include("navigation/headerHTML.php"); ?>

<style type="text/css">
.yr{width:68px;float:left;}
.title.ytd{text-align:right;}
.title.yr{text-align:center;}
.col{text-align:right;font-family:Arial;font-size:12px;}
.name{width:60px;text-align:left;margin-right:20px;}
.last{float:none;}
.invHeader {height:40px;display:block;}

#titleContainer{clear:both;float:none;}

.inactive{color:#ccc;}
.lvlB{color:#cc6600;}


</style>
</head>

<body>


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
					
					<p>Year to Date Report</p>
                	<div style="clear:both;">*See <a href="sales_archive.php?y=2014">2014 Year Report</a>.</div>

				</div>


				 <!-- div id="summary">
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
                        
                    </div-->
                </div>
<!--form action="index.php" id="range" method="GET">
	<input type="text" name="rangeA" id="rangeA" value="<?php echo $range ?>" autocomplete="off"/>
   >
</form-->      
                

<?php
// DO NOT EDIT THIS LINE
//$jd = GregorianToJD(10, 11, 1801);
//echo "$jd\n<br>";
//$gregorian = JDToGregorian($jd);
//echo "$gregorian\n<br>";


function whatMonth($d) 
{
	 $date_parts=explode("/", $d);
	 return $date_parts[1];
}


function strstrb($h,$n){
    return array_shift(explode($n,$h,2));
}



/*if(strpos($range, '-') === false){
	
	//echo "difference: ".$range."<br/>";
	$endDate 	= daysDifference($baseDate, $range);
	$beginDate 	= daysDifference($baseDate, $range);
} else {
	$range1		= strstrb($range, " - ");
	$range2 	= substr(strstr($range, ' - '), 3);
	echo "start: ".$range1."<br/>";
	echo "end: ".$range2."<br/>";
	
	$endDate 	= daysDifference($baseDate, $range2);
	$beginDate 	= daysDifference($baseDate, $range1);
}*/
//echo $range."<br>";
//echo $endDate."<br>";
//echo $beginDate."<br>";
//echo date("m-d-Y")."<br>";

$todaysdate 	= daysDifference($baseDate, date("n/j/Y"));

$beginofyrdate 	= daysDifference($baseDate, date("1/1/Y"));

//echo $todaysdate."<br>";
//echo $beginofyrdate."<br>";

//echo cal_days_in_month(CAL_GREGORIAN, 2, date("Y"));


function calculateMonthBegin ($m) {
	
		global $baseDate;
		return daysDifference($baseDate, date("$m/1/Y"));
		
}
function calculateMonthEnd ($m) {
	
	
	    global $baseDate;
		
		$tmpdays = daysDifference($baseDate, date("$m/1/Y")) + cal_days_in_month(CAL_GREGORIAN, $m, date("Y"));
		
	return $tmpdays;
}



/*
$query_invoice 	= "SELECT invoice.INVS_DT, invoice.INVS_AMT, invoice.INVS_CD, invoice.SALES_NUM, invoice.SALES_NUM,"
				." sls_pro.COMP_NM"
				." FROM invoice, sls_pro"
				." WHERE invoice.INVS_DT BETWEEN $beginofyrdate AND $todaysdate" 
				." AND invoice.INVS_CD = '1'"
				." AND sls_pro.SALES_NUM = invoice.SALES_NUM"
				." ORDER BY sls_pro.SALES_NUM, sls_pro.COMP_NM, invoice.INVS_NUM, invoice.CUS_ID ASC";

$result_invoice	= mysql_query($query_invoice, $linkID) or die("Data not found. invoice"); */





?>
<div id="titleContainer">
    <div class="title name first">Sales Name</div>
    <div class="title yr">Jan</div>
    <div class="title yr">Feb</div>
    <div class="title yr">Mar</div>
    <div class="title yr">Apr</div>
    <div class="title yr">May</div>
    <div class="title yr">Jun</div>
    <div class="title yr">Jul</div>
    <div class="title yr">Aug</div>
    <div class="title yr">Sep</div>
    <div class="title yr">Oct</div>
    <div class="title yr">Nov</div>
    <div class="title yr">Dec</div>
    <div class="title ytd last">YTD</div>

</div>

<?php
	if ($adm == 1){
	
	} else if ($adm == 0){
		$addcon = " AND USR = '$username'";
	}
	
	
	$mysql_linkID = mysql_connect($inhost, $inuser, $inpass) or die("Could not connect to host."); 
	mysql_select_db($indatabase, $mysql_linkID) or die("Could not find database."); 
	//$pass = $_COOKIE['Key_sales'];
	$query = "SELECT * FROM $inaccount WHERE ACTIVE = 'Y'$addcon ORDER BY COMP_NM ASC";//  WHERE USR = '$username'";
	
	
	$resultID = mysql_query($query, $mysql_linkID) or die("Data not found."); 

	$salesArray = array();
	
	
		for($x = 0 ; $x < mysql_num_rows($resultID) ; $x++){ 
			$row = mysql_fetch_assoc($resultID);
				
			if ($x == mysql_num_rows($resultID) -1){
				$allSales .= "'".$row["USR"]."'";
			} else {
				$allSales .= "'".$row["USR"]."',";
			}
			
			$tmpArray = array();
			array_push($tmpArray, $row["SALES_NUM"],$row["COMP_NM"],$row["LVL"],$row["ACTIVE"]);
			array_push($salesArray, $tmpArray);
		}
	
//print_r ($salesArray);
	/*while($info = mysql_fetch_array( $resultID )) {
		if ($info['ACTIVE'] == "Y") {
			$exclude_list .= $info["USR"].",";
		} else {
			
		}

	}*/

/*$query_sales = "SELECT SALES_NUM, COMP_NM"
        //." sls_pro.COMP_NM as name, sls_pro.SALES_NUM"
		." FROM sls_pro"
		." WHERE SALES_NUM IN ({$exclude_list})";
		//." JOIN sls_pro AS sales ON sales.SALES_NUM = invoice.SALES_NUM"
		//." ORDER BY SALES_NUM ASC";
$result_sales = mssql_query($query_sales, $mslinkID) or die("Data not found. sls_pro");*/

for ($x = 0; $x < sizeof($salesArray) ; $x++){ 
	  //$row1 = mssql_fetch_assoc($result_sales);
	  $salenum 	= $salesArray[$x][0];
	  $salename = $salesArray[$x][1];
	  $salelvl	= $salesArray[$x][2];
  	  	
      if ($salesArray[$x][3] == "N"){ $active = " inactive";}else{$active = " active";}
	  if($salelvl == "A") {$select_table = "invoice.SALES_NUM"; $level = " lvlA";} 
	  else if ($salelvl == "B") {$select_table = "invoice.SALES_NUM2"; $level = " lvlB";} 
  
?>
 			<div class="contentRow <?php echo $level ?><?php echo $active ?>" id="row_<?php echo $x ?>"> 
                	<div class="invHeader addhand <?php echo $alt ?>">
                        <div class="col name first"><?php echo $salename ?></div> 


<?php


$query9 = "SELECT SUM(invoice.INVS_AMT) AS subtotal, invoice.INVS_DT as month"
        //." sls_pro.COMP_NM as name, sls_pro.SALES_NUM"
		." FROM invoice" 
		//." JOIN sls_pro AS sales ON sales.SALES_NUM = invoice.SALES_NUM"
		." WHERE invoice.INVS_DT BETWEEN $beginofyrdate AND $todaysdate" 
		." AND invoice.INVS_CD = '1'"
		." AND $select_table = '$salenum'"
		." GROUP BY invoice.INVS_DT"
		." ORDER BY invoice.INVS_DT ASC";
	 
$result9 = mssql_query($query9, $mslinkID) or die("Data not found. invoice");

// Print out result
$ytdArray = array();

while($row9 = mssql_fetch_array($result9)){
	//echo "Total ". JDToGregorian($row9['month'] + GregorianToJD(12, 28, 1800)). " = $". $row9['subtotal']."<br>"; 
	
	
	$tmpArray = array();
	// array: month of the day of sale, subtotal of sale of that day. 
	array_push($tmpArray, JDToGregorian($row9['month'] + GregorianToJD(12, 28, 1800)), $row9['subtotal']);
	
	array_push($ytdArray, $tmpArray);
}

	
	for ($y = 1 ; $y < 13 ; $y++){
	
		${"tmpsum_".$y} = array();
	
		for ($z = 0; $z < sizeof($ytdArray); $z++){
		
			$date_parts1=explode("/", $ytdArray[$z][0]);
			
			if ($date_parts1[0] == $y){
				//echo "month: ".$y ." and ".$date_parts1[0]."<br>"; 
				array_push(${"tmpsum_".$y}, number_format($ytdArray[$z][1],2,'.', ''));
			}
		}
	}
	?>
    
   
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_1),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_2),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_3),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_4),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_5),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_6),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_7),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_8),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_9),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_10),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_11),2,'.', ',') ?></div>
                        <div class="col yr"><?php echo number_format(array_sum($tmpsum_12),2,'.', ',') ?></div>
                        <div class="col ytd last bold">$<?php echo number_format(array_sum($tmpsum_1)
													+array_sum($tmpsum_2)
													+array_sum($tmpsum_3)
													+array_sum($tmpsum_4)
													+array_sum($tmpsum_5)
													+array_sum($tmpsum_6)
													+array_sum($tmpsum_7)
													+array_sum($tmpsum_8)
													+array_sum($tmpsum_9)
													+array_sum($tmpsum_10)
													+array_sum($tmpsum_11)
													+array_sum($tmpsum_12),2,'.', ',') ?></div>
                    </div>
				</div>

<?php
//	}
}
?>
  
  
  
   
    <script>
$(document).ready(function(){
	tmpChecker = 0;
	$(".invHeader").click(function() {
		$(this).next('.invContent').slideToggle("fast")
	});
	$(".invHeader").toggle(function(){
			$(this).children('.date').children().attr("src", "images/close.png");
			$(this).parent('.contentRow').css('background','#f8f8f8');
			$(this).css('background','#EEEEEE');
			
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
		$(this).parents('.contentRow').find('.ssqty').html(Number($(this).text()));
	})
	
	totalAmt = 0;
	$('.tamt').each(function() {
		//alert(parseFloat($(this).text().replace(",","").substring(1)));
		totalAmt += parseFloat($(this).text().replace(",","").substring(1));
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
