<?
			$tmpName		= trim($row['DESCRIP'], " ");
			$tmpStock 		= trim($row['SZR_QTY'.$x], " ");
			$tmpItemNo  	= trim($row['PROD_CD'], " ");
			$tmpWholeSale 	= "27.50";
			
			if ($tmpStock <= 0){
				$tmpdate = trim($row['REMARK'], " ");
				if (empty($tmpdate) or $tmpdate == "NO ETA"){
					
					$tmpETA = $replenishmentdate;
				} else {
					$tmpETA	= $tmpdate;
				}
				
			} else {
				$tmpETA = "";
			}

			
			if( $tmpStock < 0){
				$tmpStock = 0;
			} else {
				if($tmpItemNo == "ALG-206" or $tmpItemNo == "ALG-PAL-206" or $tmpItemNo == "ALG-FEL-206" or $tmpItemNo == "ALG-DON-413S" or $tmpItemNo == "ALG-DON-133S" or $tmpItemNo == "ALG-DON-323S" or $tmpItemNo == "ALG-DON-103S" or $tmpItemNo == "ALG-DON-353S" or $tmpItemNo == "ALG-PAL-320S" or $tmpItemNo == "ALG-PAL-320S" or $tmpItemNo == "ALG-PAL-343S" or $tmpItemNo == "ALG-PAL-353S" or $tmpItemNo == "ALG-PAL-354S" or $tmpItemNo == "ALG-PAL-356S" or $tmpItemNo == "ALG-PAL-518S"){
					
					$tmpStock = 0;	
				} else {
					$tmpStock = $tmpStock;
				}
			} 
			
			if( trim($row['LOY_FLG'], " ") == "Y"){
				$tmpDis			= "1";
			} else {
				$tmpDis			= "0";
			}
			
			//$tmpRetail	 	= trim($row['RETAIL_PRS'], " ");
			/*
			echo "name: ".$tmpItemNo." ";
			echo "temp size: ".$tmpSize." ";
			echo $tmpStock." ";
			echo $tmpRetail." ";
			echo $row['ACTIVE']."<br>";
			*/
			
?>