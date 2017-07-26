

<?php include("navigation/headerHTML.php"); ?>

<link rel="stylesheet" href="/css/bootstrap.min.css">
<script language="javascript" type="text/javascript" src="/js/bootstrap.min.js"></script>
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


</style>
</head>

<body>


<div id="btt" style="position:absolute;right:10px;top:-100px;z-index:999;border:none;">
  
     <div><a href="#top"><img src="images/backtotop.png" border="none"></a></div>

</div>

<div id="Container">
	
		<?php 

		// variables to filter by

		$collection = isset($_POST['collection']) ? $_POST['collection'] : '%';
		$season = isset($_POST['season']) ? $_POST['season'] : 'ALG%';
		$days = isset($_POST['days']) ? $_POST['days'] : '0';
		$color = isset($_POST['color']) ? $_POST['color'] : '%';

		$query_season = "SELECT CLASS_CD from inv where CLASS_CD LIKE 'ALG%' GROUP BY CLASS_CD ORDER BY CLASS_CD ASC";
		$seasons_list = mssql_query($query_season, $mslinkID);


		?>
        
		<div id="Outer">
			<div id="Header">
				<?php include("navigation/topNav.php"); ?>
			</div>
						

			<!-- FILTERS HERE -->
            <div id="Wrapper">
            
                <div id="pageTitle">
					
					<p>Available to Sell Report</p>
						<br>
						<br>
					<div><small> Filter by choices below. <br /> <i>Leave unnecessary fields <b>blank</b> to apply no filter:</i> </small></div>
					<br />

				</div>

            </div>
					<div class="container">
						<div class="span3">

							<form class="form-horizontal" method="post">
								<!-- Days Filter -->
								 Days Ahead:	<select class="input-xlarge" name="days">
											 		<option value="0">Today</option>
											 		<option value="14">2 Weeks</option>
											 		<option value="28">4 Weeks</option>
											 		<option value="42">6 Weeks</option>
											 		<option value="56">8 Weeks</option>
											 		<option value="60">10 Weeks</option>
											 		<option value="74">12 Weeks</option>
											 		<option value="88">14 Weeks</option>
												</select>
												<br />

								<!-- Season Filter -->				
								 Season: <select class="input-xlarge" name="season">

								 			<option value="ALG%">Current</option>
<!-- 								 			<option value="ALG">Spring 2008</option>
								 			<option value="ALG1">Fall 2008</option>
								 			<option value="ALG2">Spring 2009</option>
								 			<option value="ALG3">Fall 2009</option>
								 			<option value="ALG4">Spring 2010</option>
								 			<option value="ALG5">Fall 2010</option>
								 			<option value="ALG6">Spring 2011</option> -->
								 			<option value="ALG7">Spring 2013</option>
								 			<option value="ALG8">Fall 2013</option>
								 			<option value="ALG-Z1">Close Outs</option>
								 			<option value="ALG-K">Kids</option>

									 <?php


									 //FIX THIS!!!

									 // $year = 2008;
									 // 	echo '<option value="ALG%">All</option>';
									 // 	echo '<option value="ALG">Spring 2008</option>';
									 // 	echo '<option value="ALG-Z1">Close Outs</option>';

									 // 	while ($data = mssql_fetch_assoc($seasons_list)){
									 // 		$season = trim($data['CLASS_CD']);
									 // 		$last = $season[strlen($season) - 1];
									 // 		// echo $last;

									 // 		// Rename CLASS_CD nomenclature to be Legible

									 // 		if (round($last % 2) == 0) {
									 // 			$read = "Spring ".$year;
									 // 			// $read = str_replace($season, $year, $season);
									 // 		}
									 // 		elseif (round($last % 2) == 1) {
									 // 			$read = "Fall ".$year;
									 // 			$year ++;
									 // 		}
									 		
										// 	echo '<option value="'.trim($data['CLASS_CD']).'">'.$read.'</option>';
	
										// 	}
									 ?>
										</select>
										<br />

								<!-- Collection Filter -->		
								 Collection: <input class="input-xlarge" placeholder="Ex: Paloma or (blank = ALL)" type="text" name="collection" />
								 		<br />
						</div>
						<div class="span3">

								<!-- Color Filter -->		
								 Color SKU (Prod. ID): <input class="input-xlarge" placeholder="Ex: ALG-PAL-601 or (blank = ALL)" type="text" name="color" />
								 		<br />


								 <button type="submit" class="btn">Submit</button>
							</form>
							<br />
						</div>
						<div class="span3">
								 <b>Current Filters</b> <?php echo '<br />Number of days: '.$days; echo '<br />Season: '.$season; echo '<br />Collection: '.$collection; echo '<br />Color SKU: '.$color; ?> 
						</div>
					</div>


        	<?php 

		

$query_temp = "SELECT
			        i.prod_cd as product,
			        i.descrip as description,
			        i.in_stock as current_stock,
			        i.class_cd as season,
			        (SELECT SUM(CASE 
			        	when p.pur_cd = 2 then p.log_qty * -1
			       		else p.log_qty
			        	END) from plog as p 
						where dateadd(day, p.EST_DT, '18001228') BETWEEN getdate() and dateadd(day, $days, getdate()) 
						and p.prod_cd = i.prod_cd 
						group by p.prod_cd) as 'purchase_order',
			        (SELECT SUM(CASE
			        	when l.CAN_QTY > 0 then l.order_qty * 0
			        	else l.order_qty
			        	END) from ord_log as l 
			        	where dateadd(day, l.SHIP_DT, '18001228') BETWEEN getdate() and dateadd(day, $days, getdate())
			        	and l.prod_cd = i.prod_cd) as 'total_sales',
			        (SELECT SUM(order_qty)
			        	from ediordlg as e
			        	where dateadd(day, e.SHIP_DT, '18001228') BETWEEN getdate() and dateadd(day, $days, getdate())
			        	and e.prod_cd = i.prod_cd) as 'total_sales_edi'
			    from
			        inv_data as i
			        join inv on inv.prod_cd = i.prod_cd
			    where
			        i.class_cd like '%$season%'
			    and
			     	i.prod_cd like '%$color%'
			    and
			    	i.descrip like '%$collection%'
			    and
			    	inv.ACTIVE = 'Y'
			    group by
			        i.prod_cd,
			        i.descrip,
			        i.in_stock,
			        i.class_cd";


$query_ats = "SELECT
			product,
			description,
			current_stock,
			purchase_order,
			ISNULL(total_sales, 0) + ISNULL(total_sales_edi, 0) as total_sales,
			(ISNULL(current_stock, 0) + ISNULL(purchase_order, 0) - ISNULL(total_sales_edi, 0) - ISNULL(total_sales, 0)) as avail_to_sell
			from ($query_temp) as final_ats
			order by
			product ASC";

$result_ats = mssql_query($query_ats, $mslinkID);

?>
</div>
<table class="table table-striped table-hover" style="margin-top:10px">
	<tr>
		<th>Prod. ID</th>
		<th>Product Description</th>
		<th>Current Stock</th>
		<th>Incoming POs</th>
		<th>Sales Orders</th>
		<th>Available To Sell</th>
	</tr>

		<?php
	while($data = mssql_fetch_assoc($result_ats)) {
		// echo "<pre>"; print_r($data); echo "</pre>";

	

	  if ($data['avail_to_sell'] <= 0){	
	  	echo '<tr class="error">';
	  }
	  else{
	  	echo '<tr>';
	  }

	  
	  foreach($data as $k => $v){
		if (!$v) {
		  	$v = '0';
		  }
	  	echo '<td>'.$v.'</td>';
	  }
	echo '</tr>';
	
	 
	}
		?>


</table>
</div>