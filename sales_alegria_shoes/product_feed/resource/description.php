<?php

			$thick 		="<li>Heel Height: 1<sup>3</sup>/<sub>4</sub> in</li> <li>Platform Height: 1 in</li>";
			$thin  		="<li>Heel Height: 1<sup>1</sup>/<sub>2</sub> in</li> <li>Platform Height: <sup>3</sup>/<sub>4</sub> in</li>";
			$pac  		="<li>Heel Height: 1<sup>1</sup>/<sub>2</sub> in</li> <li>Platform Height: <sup>3</sup>/<sub>4</sub> in</li>";
			
			$add_shoe 	= "<li>Extra roomy fit gives you plenty of room in the toe box.</li>";
			$add_sandal = "<li>Extra roomy fit gives you plenty of room in the toe box.</li>";
			$add_caiti 	= "<li>Buckle and side velcro closure make getting in and out a snap.</li>";
			$add_fria 	= "<li>Cozy shearling lining.</li>";
			$add_pro 	= "<li>Lab rated slip resistant outsole and stain-proof leather coating.</li>";
			$add_feliz	= "<li>Adjustable Velcro Strap makes this a great fitting shoe for all width.</li>";
			$add_sev	= "<li>Unique Adjustable Swivel Strap for more secure fit</li><li>Lab rated slip resistant outsole and stain-proof leather coating.</li>";
			$removable  = "<li>You can even insert your own custom orthodics.</li>";
			
			$c 			= explode(" ", $row['color']);
			$collection = $c[0];
			
			if(count($c)==2){
				$color = $c[1];
			} else if(count($c)==3){
				$color = $c[1]." ".$c[2];
			} else if(count($c)==4){
				$color = $c[1]." ".$c[2]." ".$c[3];
			} else if(count($c)==5){
				$color = $c[1]." ".$c[2]." ".$c[3]." ".$c[4];
			}
			
			if($collection != "Classic"){
				$n		= explode("-", $row['itemNo']);
				$itemNo = $n[1]."-".$n[2];
				
				//echo $row['itemNo'];
			} else {
				$itemNo = $row['itemNo'];
			}
			
			if($collection == "Classic"){
				$type 	= "Clog";
				$add	= $add_shoe;
				$mea	= $thick;
				$remove	= $removable;
			}else if ($collection == "Vale"){
				$type 	= "Shearling Boot";
				$add	= $add_shoe;
				$mea	= $thick;
				$remove	= $removable;
			}else if ($collection == "Paloma"){
				$type 	= "Mary Jane";
				$add	= $add_shoe;
				$mea	= $thick;
				$remove	= $removable;
			}else if ($collection == "Dayna" or $collection == "Debra"){
				$type 	= "Nursing Shoe";
				$add	= $add_pro;
				$mea	= $thick;
				$remove	= $removable;
			}else if ($collection == "Donna"){
				$type 	= "Nursing Clog";
				$add	= $add_pro;
				$mea	= $thick;
				$remove	= $removable;
			}else if ($collection == "Seville"){
				$type 	= "Clog";
				$add	= $add_sev;
				$mea	= $thick;
				$remove	= $removable;
			}else if ($collection == "Caiti"){
				$type 	= "Ankle Boot";
				$add	= $add_caiti;
				$mea	= $thin;
				$remove	= $removable;
			}else if ($collection == "Tuscany"){
				$type 	= "Slide";
				$add	= $add_sandal;
				$mea	= $thin;
				$remove	= $removable;
			}else if ($collection == "Madrid"){
				$type 	= "Sandal";
				$add	= $add_sandal;
				$mea	= $thick;
				$remove	= $removable;
			}else if ($collection == "Fria"){
				$type 	= "Pac Boot";
				$add	= $add_boot;
				$mea	= $pac;
				$remove	= $removable;
			}else if ($collection == "Feliz"){
				$type 	= "Casual Flat";
				$add	= $add_feliz;
				$mea	= $thin;
				$remove	= $removable;
			}else {
				$type 	= "Shoe";
				$add	= $add_shoe;
				$mea	= $thick;
				$remove	= $removable;
			}
			
			
			$des = "<ul> <li>Beautiful ".$color." Leather Upper Women's ".$type.".</li>".$add."<li>Mild Rocker Outsole is engineered to reduce heel and central metatarsal pressure and the bottom is flat to increase stability.</li> <li>The footbed is loaded with cork, memory foam and latex to create a perfect fit every time by forming to the natural contours of the foot, giving each user their own customized fit.</li>".$remove.$mea." </ul>";
			$des ="\"".$des."\"";
			
			$mkey = "\"Alegria ".$collection." ".$color." ".$type.",".$color." ".$type.",Alegria ".$color." ".$type.",".$collection." ".$color." ".$type.",Alegria ".$collection." ".$color.",".$collection." ".$color.",".$itemNo."\"";
	
			$mdes = "Alegria ".$collection." ".$color." ".$type." ".$itemNo." by PG Lite. ".$color." Leather upper Alegria ".$collection." ".$type." with rocker outsole and removable footbed.";
			
?>