<?
			$tmpName		= trim($row['DESCRIP'], " ");
			$tmpStock 		= trim($row['SZR_QTY'.$x], " ");
			$tmpItemNo  	= trim($row['PROD_CD'], " ");
			$tmpWholeSale 	= trim($row['RETAIL_PRS'], " ") + 5;
			$tmpColor  	= trim($row['color'], " ");
			
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
				if($tmpItemNo == "ALG-206" or $tmpItemNo == "ALG-PAL-206" or $tmpItemNo == "ALG-FEL-206" or $tmpItemNo == "ALG-DON-413S" or $tmpItemNo == "ALG-DON-133S" or $tmpItemNo == "ALG-DON-323S" or $tmpItemNo == "ALG-DON-103S" or $tmpItemNo == "ALG-DON-353S" or $tmpItemNo == "ALG-PAL-320S" or $tmpItemNo == "ALG-PAL-320S" or $tmpItemNo == "ALG-PAL-343S" or $tmpItemNo == "ALG-PAL-353S" or $tmpItemNo == "ALG-PAL-354S" or $tmpItemNo == "ALG-PAL-356S" or $tmpItemNo == "ALG-PAL-518S" or $tmpItemNo == "KID-VIN-101" or $tmpItemNo == "KID-VIN-104" or $tmpItemNo == "KID-VIN-105" or $tmpItemNo == "KID-VIN-125" or $tmpItemNo == "KID-VIN-214" or $tmpItemNo == "KID-VIN-353" or $tmpItemNo == "KID-VIN-354" ){
					
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