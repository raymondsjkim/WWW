
        

      <form method="post" action="inventory.php" id="contactform">   
      
      		
      
      
        <?php $linkID = mysql_connect($inhost, $inuser, $inpass) or die("Could not connect to host."); 
			mysql_select_db($indatabase, $linkID) or die("Could not find database."); 
			
			//$query = "SELECT * FROM $intable WHERE class !='Exclusive/Special Order' ORDER BY itemNo";
			$query = "SELECT * FROM $intable WHERE class !='PGL' and (inStock > '0' or eta != '') ORDER BY itemNo" ;
			$result = mysql_query($query, $linkID) or die("Data not found."); 
			
			
			$idArray 	= array();
			$sizeArray 	= array();
			$colorArray = array();
			$dconArray	= array();
			$etaArray 	= array();
			$wsArray	= array();
			$sizeArray 	= array();
			
			for($y = 0 ; $y < mysql_num_rows($result) ; $y++){
				//$tmpId = $row[itemNo];
				$row = mysql_fetch_assoc($result);
				
				if (!in_array($row[itemNo], $idArray)){
						
						// if ($row['inStock'] >= '6'){
						array_push($idArray, $row[itemNo]);
						array_push($colorArray, $row[color]);
						array_push($dconArray, $row[discontinue]);
						array_push($etaArray, $row[eta]);
						array_push($wsArray, $row[wholesalePrice]);
						array_push($sizeArray, $row[inStock]);
						// }
						
					//}
				}
				
			}

			$alt = "even";
			$k = -1;
			echo "<table border='0' cellspacing='0' cellpadding='0' id='inventorytable'>\n";
			
			foreach ($idArray as $value){
				if ($alt == "even"){$alt = "odd";}else{$alt = "even";};
				
			    $k++;
				
				echo "<tr class='".$alt."' id='".$idArray[$k]."'>\n";
				echo "<td class='column1'>\n";
				echo "<a name='".$value."' id='".$value."'></a>\n";
				echo "<img src='http://dealer.alegriashoes.com/images/shoes/".$value."_02.jpg' width='100' alt='".$value."' align='left' class='tn'/>";
				echo $value."<br>$<span class='wholesale'>".$wsArray[$k]."</span><br>";
				
				echo "<span class='color'>".$colorArray[$k]."</span><br>";
				
				if ($dconArray[$k] == "1"){
					echo "<span class='dcon'>Limited Qty</span><br>";
					}	
				elseif ($etaArray[$k] != "") {
					echo "<span class='eta'>ETA*: ".$etaArray[$k]."<br><b>Backorder Available</b></span><br>";
					}

				echo "</td>\n";
				echo "<td align='right' class='title'>\n<div class='size'>Size:</div><div class='stock'>In Stock:</div><div class='qty'>Qty to Order:</div></td>\n";
				
				$idQuery = "SELECT * FROM $intable WHERE itemNo = '".$value."' ORDER BY itemNo ";					
				$idResult = mysql_query($idQuery, $linkID) or die("Data not found."); 
				//Loop for each size
				for($y = 0 ; $y < mysql_num_rows($idResult) ; $y++){
					//$tmpId = $row[itemNo];
					$idRow = mysql_fetch_assoc($idResult);
					
					if ($idRow[itemNo] != "ALG-WIDE" and $idRow[itemNo] != "SEV-WIDE" ){
					
					if ($idRow[size]<49){
						
						//disabled for backorder
						//if ($idRow[inStock]> 20){ $qtnMenu = "20";}else{$qtnMenu = $idRow[inStock];}
						
						if ($idRow[inStock]<= 0){$noStock ="GreyOut"; $inStock="0";}else{$disableInput = "";$noStock =""; $inStock = $idRow[inStock];}
						//if ($idRow[inStock]< 6){ $inStock = "0";}else{$inStock = $idRow[inStock];}
						
						//backorder system
						if ($idRow[inStock]> 20){ 
							$qtnMenu = "20";
						}
						elseif($idRow[inStock] < 20 && $etaArray[$k] != ""){
							$qtnMenu = "20";
						}
						else {
							$qtnMenu = $inStock;
						}
						

						?>
						<td valign="top">
							<div class="size <?php echo $noStock?>">
								<?php echo $idRow[size]?>
							</div>
							<div class="stock <?php echo $noStock ?>">
								<?php echo $inStock ?>
							</div>
							<div class='qty <?php echo $noStock ?>'>
                                <select name="<?php echo $idRow[itemNo] ?>_<?php echo $idRow[size] ?>" id="<?php echo $idRow[itemNo] ?>_<?php echo $idRow[size] ?>" <?php echo $disableInput?> class="qtyselect">					
                                    <option>-</option>
                                    <?php for($x=0; $x < $qtnMenu ; $x++){
										$a = $x + 1;
                                        echo "<option value='$a'>$a</option>\n";
                                    }; ?> 
                                </select>
                       		</div>
						</td>
                        <?php }
					}
				}

				echo "</tr>\n";
			}
			echo "</table>\n";
		
		?>	
       
  </form>   
 