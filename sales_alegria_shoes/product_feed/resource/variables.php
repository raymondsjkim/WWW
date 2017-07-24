<?
			$tmpName		= trim($row['DESCRIP'], " ");
			$tmpAlc			= trim($row['ALC_QTY'.$x], " ");
			$tmpRma			= trim($row['RMA_QTY'.$x], " ");
			$tmpSalesOrder	= trim($row['SO_QTY'.$x], " ");
			$tmpSizeRun		= trim($row['SZR_QTY'.$x], " ");
			//$tmpStock 		= trim($row['SZR_QTY'.$x], " ");
			// $tmpStock		= $tmpSizeRun - $tmpSalesOrder - $tmpAlc - $tmpRma;
			$tmpStock		= $tmpSizeRun - $tmpSalesOrder - $tmpAlc;
			$tmpItemNo  	= trim($row['PROD_CD'], " ");

			// New OMS changed tables for some reason, 16 and 18 are relative to wholesale and retail, respectively.
			// $tmpWholeSale 	= trim($row['RETAIL_PRS'], " ");
			$tmpWholeSale 	= trim($row['16'], " ");
			// $tmpRetail		= trim($row['WHOLE_PRS2'], " ");
			$tmpRetail		= trim($row['18'], " ");
			$tmpSeason		= trim($row['SEASONS'], " ");
			//$etaDate		= $row['eta'];
			
			
			if( $tmpStock < 2){
				$tmpStock = 0;
			} 
			
			if( trim($row['LOY_FLG'], " ") == "Y"){
				$tmpDis			= "1";
			} else {
				$tmpDis			= "0";
			}
			
			
?>