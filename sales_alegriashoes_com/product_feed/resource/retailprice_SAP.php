<?
			$tmpS = explode("-", $data[1]);
			$tmpC = $tmpS[0];
			$tmptrimmed = trim($tmpC);
			
			
			if ($tmpC == "CAR" or $tmpC == "MAR" or $tmpC == "PIS" or $tmpC == "VER" or $tmpC == "BAR" or $tmpC == "MIL" or $tmpC == "VEN"){$tmpRetail = "89.95";}
			if ($tmpC == "FEL" or $tmpC == "MAD" or $tmpC == "TUS"){ $tmpRetail = "99.95";} 
			if ($tmpC == "ALG" or $tmpC == "PAL" or $tmpC == "DEB" or $tmpC == "DON" or $tmpC == "SEV"){ $tmpRetail = "109.95";} 
			if ($tmpC == "ABB" or $tmpC == "FLO" or $tmpC == "DAY"){ $tmpRetail = "119.95";} 
			if ($tmpC == "CAT") {$tmpRetail = "129.95";}
			if ($tmpC == "VIK") {$tmpRetail = "139.95";}
			if ($tmpC == "FRI") {$tmpRetail = "149.95";}
			if ($tmpC == "ASP") {$tmpRetail = "154.95";}
			if ($tmpC == "VAL" or $tmpC == "SED") {$tmpRetail = "169.95";}
			
			/*if ($row[wholesalePrice] == "8.95"){$WP = "19.95";}
			if ($row[wholesalePrice] == "39.50"){$SRP = "89.95";}
			if ($row[wholesalePrice] == "44.50"){$SRP = "99.95";}
			if ($row[wholesalePrice] == "49.50"){$SRP = "109.95";}
			if ($row[wholesalePrice] == "69.50"){$SRP = "154.95";}
			if ($row[wholesalePrice] == "75.00"){$SRP = "164.95";}*/
			
			
?>