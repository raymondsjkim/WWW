<?
			$tmpUPC			= trim($row['upc']," ");
			$tmpStock		= $row['inStock'];
			$tmpSize		= $row['size'];
			$pId			= $row['productID'];
			$tmpItemNo		= $row['itemNo'];
			$tmpUpc			= $row['upc'];
			$tmpDis			= $row['discontinue'];
			$tmpWholeSale 	= $row['wholesalePrice'];
			$tmpETA			= $row['eta'];
			$tmpClass		= trim($row['class'], " ");
			$tmpColor 		= $row['color'];
			$retailMSRP		= $row['RetailPrice'];
			$tmpSeason		= $row['season'];
			
			if($tmpItemNo == "ALG-206" or $tmpItemNo == "ALG-PAL-206" or $tmpItemNo == "ALG-FEL-206"){
				$tmpStock = 0;	
			} else {
				$tmpStock = $tmpStock;
			}
			
			if ($tmpStock <= 0){
				$tmpdate = $tmpETA;
				if (empty($tmpdate) or $tmpdate == "NO ETA"){
					
					$tmpETA = $replenishmentdate;
				} else {
					$tmpETA	= $tmpdate;
				}
				
			} /*else {
				$tmpETA = "";
			}*/
			

			
		
			//$tmpRetail	 	= trim($row['RETAIL_PRS'], " ");
			/*
			echo "name: ".$tmpItemNo." ";
			echo "temp size: ".$tmpSize." ";
			echo $tmpStock." ";
			echo $tmpRetail." ";
			echo $row['ACTIVE']."<br>";
			*/
			
?>