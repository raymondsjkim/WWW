

<?php include("navigation/headerHTML.php"); ?>

<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap-responsive.min.css">
<script language="javascript" type="text/javascript" src="/js/bootstrap.min.js"></script>
<script language="javascript" type="text/javascript" src="/js/bootstrap-responsive.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<style type="text/css">
.yr{width:68px;float:left;}
.title.ytd{text-align:center;}
.title.yr{width: 144px; margin-right:20px;text-align:center;}
.col{text-align:right;font-family:Arial;font-size:12px;}
.name{width:144px;text-align:center;margin-right:20px;}
.last{float:none;}
.invHeader {height:40px;display:block;}

#titleContainer{clear:both;float:none;}

.inactive{color:#ccc;}
.lvlB{color:#cc6600;}

.container {
	width:985px;
}
.span3 {
	width:270px;
}

ul, ol {
	margin:0;
}


</style>
</head>

<body>


<div id="btt" style="position:absolute;right:10px;top:-100px;z-index:999;border:none;">
  
     <div><a href="#top"><img src="images/backtotop.png" border="none"></a></div>

</div>

<div id="Container">
	
		<?php 

		// variables to filter by

		$collection = isset($_POST['collection']) ? $_POST['collection'] : '';
		$season = isset($_POST['season']) ? $_POST['season'] : 'NEW\' OR inv.seasons like \'CURRENT';
		$color = isset($_POST['color']) ? $_POST['color'] : '';
		$days = '360';


		?>
        
		<div id="Outer">
			<div id="Header">
				<?php include("navigation/topNav.php"); ?>
			</div>
						

			<!-- FILTERS HERE -->
            <div id="Wrapper">
            
                <div id="pageTitle">
					
					<p>Available to Sell Report - <b>CANADA</b></p>
						<br>
						<br>
					<div>
						<small> Filter by choices below. 
							<br /> <i>Leave unnecessary fields <b>blank</b> to apply no filter:</i> 
							<br />
						</small></div>
					<br />
				</div>

            </div>
					<div class="container">
						<div class="span3">

							<form class="form-horizontal" method="post">
								<!-- Season Filter -->				
								 <b>Category:</b> <select class="input-xlarge" name="season">

									 <?php

									 echo '<option value="NEW&#39; OR inv.seasons like &#39;CURRENT">New AND Current</option>';
									 echo '<option value="NEW">New SKUs</option>';
									 echo '<option value="CURRENT">Current SKUs</option>';
									 echo '<option value="CLOSEOUT">Close Outs</option>';

									 ?>
										</select>
										<br />

								<!-- Collection Filter -->		
								 <b>Style:</b> <input class="input-xlarge" placeholder="Style name (Paloma, Classic, ...)" type="text" name="collection" />
								 		<br />
						</div>
						<div class="span3">

								<!-- Color Filter -->		
								 <b>Color SKU (Prod. ID):</b> <input class="input-xlarge" placeholder="SKU number (ALG-PAL-601, ...)" type="text" name="color" />
								 		<br />


								 <button type="submit" class="btn">Submit</button>
							</form>
							<br />
						</div>
						<div class="span3">
								 <b><i>Current Filters</i></b> <?php 
								 								if ($season == 'NEW\' OR inv.seasons like \'CURRENT') {
								 									echo '<br />Season: <b>New and Current</b>'; 
								 								}
								 								else {
									 								echo '<br />Season: <b>'.$season; 
								 								}
								 								echo '</b><br />Style: <b>'.$collection; 
								 								echo '</b><br />Color SKU: <b>'.$color; 
								 								echo'</b>';
								 								?> 
						</div>



					</div>
						<p><i>*CLICK on any style to see the current size run stock levels.*</i></p>

        	<?php 
$query_temp = "SELECT 
			        i.prod_cd as product,
			        i.descrip as description,
			        i.in_stock - i.order_qty - i.book_qty as avail_to_sell,
			        i.class_cd as season,
			        inv.seasons as season_choice,
			        -- i.order_qty as purchase_order,
					i.SZR_QTY1 - i.RMA_QTY1 - i.ALC_QTY1 - i.SO_QTY1 as size_run1,
					i.SZR_QTY2 - i.RMA_QTY2 - i.ALC_QTY2 - i.SO_QTY2 as size_run2,
					i.SZR_QTY3 - i.RMA_QTY3 - i.ALC_QTY3 - i.SO_QTY3 as size_run3,
					i.SZR_QTY4 - i.RMA_QTY4 - i.ALC_QTY4 - i.SO_QTY4 as size_run4,
					i.SZR_QTY5 - i.RMA_QTY5 - i.ALC_QTY5 - i.SO_QTY5 as size_run5,
					i.SZR_QTY6 - i.RMA_QTY6 - i.ALC_QTY6 - i.SO_QTY6 as size_run6,
					i.SZR_QTY7 - i.RMA_QTY7 - i.ALC_QTY7 - i.SO_QTY7 as size_run7,
					i.SZR_QTY8 - i.RMA_QTY8 - i.ALC_QTY8 - i.SO_QTY8 as size_run8,
					i.SZR_QTY9 - i.RMA_QTY9 - i.ALC_QTY9 - i.SO_QTY9 as size_run9,
					i.SZR_QTY10 - i.RMA_QTY10 - i.ALC_QTY10 - i.SO_QTY10 as size_run10,
					i.SZR_QTY11 - i.RMA_QTY11 - i.ALC_QTY11 - i.SO_QTY11 as size_run11,
					(SELECT MIN(dateadd(day, p.EST_DT, '18001228')) 
						from plog as p 
						where p.prod_cd = i.prod_cd 
						and dateadd(day, p.EST_DT, '18001228') > getdate() 
						group by p.PROD_CD) as 'eta',
			        (SELECT SUM(CASE 
			        	when p.pur_cd = 2 then p.log_qty * -1
			       		else p.log_qty
			        	END) from plog as p 
						where dateadd(day, p.EST_DT, '18001228') BETWEEN getdate() and dateadd(day, $days, getdate()) 
						and p.prod_cd = i.prod_cd 
						group by p.prod_cd) as 'purchase_order'
			    from
			        inv_data as i
			        join inv on inv.prod_cd = i.prod_cd
			    where
			        (inv.seasons like '$season')
			    and
			     	i.prod_cd like '%$color%'
			    and
			    	i.descrip like '%$collection%'
			    and
			    	i.WHS_NUM = 'CAN'
			    and
			    	inv.ACTIVE = 'Y'
			    group by
			        i.prod_cd,
			        i.descrip,
			        i.in_stock - i.order_qty - i.book_qty,
			        i.class_cd,
			        -- i.order_qty,
			        inv.seasons,
			        i.SZR_QTY1 - i.RMA_QTY1 - i.ALC_QTY1 - i.SO_QTY1,
					i.SZR_QTY2 - i.RMA_QTY2 - i.ALC_QTY2 - i.SO_QTY2,
					i.SZR_QTY3 - i.RMA_QTY3 - i.ALC_QTY3 - i.SO_QTY3,
					i.SZR_QTY4 - i.RMA_QTY4 - i.ALC_QTY4 - i.SO_QTY4,
					i.SZR_QTY5 - i.RMA_QTY5 - i.ALC_QTY5 - i.SO_QTY5,
					i.SZR_QTY6 - i.RMA_QTY6 - i.ALC_QTY6 - i.SO_QTY6,
					i.SZR_QTY7 - i.RMA_QTY7 - i.ALC_QTY7 - i.SO_QTY7,
					i.SZR_QTY8 - i.RMA_QTY8 - i.ALC_QTY8 - i.SO_QTY8,
					i.SZR_QTY9 - i.RMA_QTY9 - i.ALC_QTY9 - i.SO_QTY9,
					i.SZR_QTY10 - i.RMA_QTY10 - i.ALC_QTY10 - i.SO_QTY10,
					i.SZR_QTY11 - i.RMA_QTY11 - i.ALC_QTY11 - i.SO_QTY11";


$query_ats = "SELECT
			product,
			description,
			avail_to_sell,
			-- ISNULL(total_sales, 0) + ISNULL(total_sales_edi, 0) as total_sales,
			--ISNULL(current_stock, 0) + ISNULL(purchase_order, 0) - ISNULL(total_sales_edi, 0) - ISNULL(total_sales, 0) as avail_to_sell,
			-- size_run1 + size_run2 + size_run3 + size_run4 + size_run5 + size_run6 + size_run7 + size_run8 + size_run9 + size_run10 + size_run11 as avail_to_sell,
			LEFT(eta, 11) as 'eta',
			purchase_order,
			size_run1,
			size_run2,
			size_run3,
			size_run4,
			size_run5,
			size_run6,
			size_run7,
			size_run8,
			size_run9,
			size_run10,
			size_run11,
			season,
			season_choice
			from ($query_temp) as final_ats
			order by
			product ASC";

$result_ats = mssql_query($query_ats, $mslinkID);


?>
</div>
<table class="table table-striped table-hover table-bordered" style="margin-top:10px" id="report">
	<tr>
		<th colspan="10">Prod. ID</th>
		<th colspan="10">Product Description</th>
<!-- 		<th colspan="10">Current Stock</th>
		<th colspan="10">Incoming POs</th>
		<th colspan="10">Sales Orders</th> -->
		<th colspan="10">Available To Sell</th>
		<th colspan="10">Incoming PO Date</th>
		<th colspan="10">Total Incoming Pairs</th>
	</tr>	

	<?php
	$productRow = array(
				'product',
				'description', 
				// 'current_stock', 
				// 'total_sales', 
				'avail_to_sell',
				// 'eta',
				// 'purchase_order'
				);
	$oldAlg = array(
		'/\bALG\b/'
		);
	$oldSizeSeason = array(
				'ALG1', 
				'ALG2', 
				'ALG3', 
				'ALG4', 
				'ALG5', 
				'ALG6', 
				'ALG7',
				'ALG-Z1'
				);
	$oldSizeRow = array(
				'size_run10',
				'size_run1', 
				'size_run2', 
				'size_run3', 
				'size_run4', 
				'size_run5',
				'size_run6', 
				'size_run7', 
				'size_run8', 
				'size_run11'
				);	
	$algSizeRow = array(
				'size_run1', 
				'size_run2', 
				'size_run3', 
				'size_run4', 
				'size_run5',
				'size_run6', 
				'size_run7', 
				'size_run8', 
				'size_run9', 
				'size_run10'
				);	
	$amSizeSeason = 'AM';
	$amSizeRow = array(
				'size_run1', 
				'size_run2', 
				'size_run3', 
				'size_run4', 
				'size_run5',
				'size_run6', 
				'size_run7', 
				'size_run8', 
				'size_run9',
				'size_run10'
				);

	function strpos_arr($haystack, $needle) {
    	if(!is_array($needle)) $needle = array($needle);
    	foreach($needle as $what) {
        	if(($pos = strpos($haystack, $what))!==false) return $pos;
    	}
    	return false;
	}

	function preg_match_arr($pattern, $subject) {
		foreach ($pattern as $key) {
			$outcome = preg_match($key, $subject);
			if ($outcome == 1){
				return 1;
				}
			else{
				return 0;
				}
			}
		}

	while($data = mssql_fetch_assoc($result_ats)) {
	//echo '<pre>'; print_r($data); echo '</pre>';
	//Create item SKU rows
		if ($data['avail_to_sell'] <= 0){	
	  	echo '<tr class="error">';
		  }
		else{
	  	echo '<tr>';
		  }

		foreach($productRow as $key){
			if (!$key) {
				$key = '0';
			}
			echo '<td align="center" colspan="10">'.$data[$key].'</td>';
		}
		echo '</tr>';




		echo '<tr>';
		echo '<td colspan="20"></td>';
		echo '<td colspan="10">';
			echo '<table class="table table-hover table-bordered">';
		// determine which season the shoe is from for size run
			$season = trim($data['season']);
			//echo $season; echo '<br>';
			//$seasonNumber = $season[strlen($season) - 1];
			//echo $seasonNumber;
			
			// kids first because preg_match doesn't catch hyphen
			if ($season == 'ALG-K'){
				$size_run = 12;
				//use men sizeRow because it uses 1-10
				foreach ($amSizeRow as $key) {
					if ($size_run > 13) $size_run = 1;
					if ($data[$key] <= 0) $data[$key] = 0;
					echo '<tr><b>Size '.$size_run.':</b> '.$data[$key].'</tr><br />';
					$size_run ++;
				}
			}

			// add detection for alg10+ because the 1 for alg1 was matching with 10 and throwing off size run
			elseif (is_numeric(substr($season, -2)) && substr($season, 0, 3) == 'ALG' ) {
				$size_run = 34;
				foreach ($algSizeRow as $key) {
					if ($data[$key] <= 0) $data[$key] = 0;
					echo '<tr><b>Size '.$size_run.':</b> '.$data[$key].'</tr><br />';
					$size_run ++;
				}
			}

			// 'alg' to match exactly
			elseif (preg_match_arr($oldAlg, $season) == 1){
				$size_run = 34;
				foreach ($oldSizeRow as $key) {
					if ($data[$key] <= 0) $data[$key] = 0;
					echo '<tr><b>Size '.$size_run.':</b> '.$data[$key].'</tr><br />';
					$size_run ++;
					//echo '<td colspan="5">'.$data[$key].'</td>';
					//echo '<pre>'; print_r($data); echo '</pre>';
					//echo $data[$key]; echo '<br>';
				}
			}

			// alg[1-7, Z1]
			elseif (strpos_arr($season, $oldSizeSeason) !== false){
				$size_run = 34;
				foreach ($oldSizeRow as $key) {
					if ($data[$key] <= 0) $data[$key] = 0;
					echo '<tr><b>Size '.$size_run.':</b> '.$data[$key].'</tr><br />';
					$size_run ++;
					//echo '<td colspan="5">'.$data[$key].'</td>';
				}
			}


			// am for men, closeout
			elseif (strpos($season, $amSizeSeason) !== false){
				$size_run = 40;
				foreach ($amSizeRow as $key) {
					if ($data[$key] <= 0) $data[$key] = 0;
					echo '<tr><b>Size '.$size_run.':</b> '.$data[$key].'</tr><br />';
					$size_run ++;
					//echo '<td colspan="5">'.$data[$key].'</td>';
				}
			}
			// alg[8-...], everything else
			else {
				$size_run = 34;
				foreach ($algSizeRow as $key) {
					if ($data[$key] <= 0) $data[$key] = 0;
					echo '<tr><b>Size '.$size_run.':</b> '.$data[$key].'</tr><br />';
					$size_run ++;
					//echo '<td colspan="5">'.$data[$key].'</td>';
				}
			}



			// $size_run = 33;
			// foreach($secondRow as $key){
			// 	echo '<th colspan="1">Size <br>'.$size_run.'</th>';
			// 	// echo '<br>';
			// 	$size_run ++;
			// 	echo '<td colspan="5">'.$data[$key].'</td>';
			// }
			echo '</table>';
		echo '</td>';
		echo '<td colspan="20"></td>';
		echo '</tr>';


	}
	?>


</table>
</div>

<script type="text/javascript">
$(document).ready(function(){
        $("#report tr:odd").addClass("odd");
        $("#report tr:not(.odd)").hide();
        $("#report tr:first-child").show();
        
        $("#report tr.odd").click(function(){
            $(this).next("tr").toggle();
        });
        $("#report").jExpand();
    });
</script>

</body>