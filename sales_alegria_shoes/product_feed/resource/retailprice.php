<?
			$tmpColor = explode(" ", $row['DESCRIP']);
			$tmpC = $tmpColor[0];
			$tmptrimmed = trim($tmpC);
			
			
			if ($tmpC == "Carina" or $tmpC == "Mariposa" or $tmpC == "Pisa" or $tmpC == "Verona" or $tmpC == "Barcelona" or $tmpC == "Milano" or $tmpC == "Venice"){$tmpRetail = "89.95";}
			if ($tmpC == "Feliz" or $tmpC == "Madrid" or $tmpC == "Tuscany"){ $tmpRetail = "99.95";} 
			if ($tmpC == "Classic" or $tmpC == "Paloma" or $tmpC == "Debra" or $tmpC == "Donna" or $tmpC == "Seville"){ $tmpRetail = "109.95";} 
			if ($tmpC == "Abbi" or $tmpC == "Flora" or $tmpC == "Dayna"){ $tmpRetail = "119.95";} 
			if ($tmpC == "Caiti") {$tmpRetail = "129.95";}
			if ($tmpC == "Viki") {$tmpRetail = "139.95";}
			if ($tmpC == "Fria") {$tmpRetail = "149.95";}
			if ($tmpC == "Aspen") {$tmpRetail = "154.95";}
			if ($tmpC == "Vale" or $tmpC == "Sedona") {$tmpRetail = "169.95";}
			if ($tmpC == "Kids") {$tmpRetail = "59.95";}
			
			/*if ($row[wholesalePrice] == "8.95"){$WP = "19.95";}
			if ($row[wholesalePrice] == "39.50"){$SRP = "89.95";}
			if ($row[wholesalePrice] == "44.50"){$SRP = "99.95";}
			if ($row[wholesalePrice] == "49.50"){$SRP = "109.95";}
			if ($row[wholesalePrice] == "69.50"){$SRP = "154.95";}
			if ($row[wholesalePrice] == "75.00"){$SRP = "164.95";}*/
			
			
?>