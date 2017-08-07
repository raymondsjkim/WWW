<?php
require("../includes/resource/db.php");
set_time_limit(720);
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	$date = date("m_d_y");
	$name = "inventory/belk_inventory".$date.".txt";

	$company = "ALG";
	$replenishmentdate = "";

	//header
	//Always "IN",your sku #,"Yes","No", or "Guaranteed",Quantity On Hand,,,,,Enter Product Description,,,,,,,,,Enter Merchant Name,

	
	// UPDATE MANUALLY FOR EACH NEW SHOE SENT BY BELK
	
	$file = fopen( $name, "w" );
	$time = date("H_i_s");
	include("../product_feed/resource/connection_mysql.php");
	
	while($row = mysql_fetch_assoc($result)){
		include("../product_feed/resource/variables_mysql.php");
		$selectedShoes = array(
						'ALG-101',
						'ALG-427',
						'ALG-395',
						'ALG-531',
						'ALG-532',
						'ALG-558',
						'ALG-601',
						'ALG-631',
						'ALG-637',
						'ALG-715',
						'ALG-716',
						'ALG-662',
						'ALG-711',
						'ALG-628',
						'ALG-629',
						'ALG-818',
						'ALG-819',
						'ALG-PAL-101',
						'ALG-PAL-121',
						'ALG-PAL-249',
						'ALG-PAL-250',
						'ALG-PAL-323',
						'ALG-PAL-375',
						'ALG-PAL-379',
						'ALG-PAL-387',
						'ALG-PAL-397',
						'ALG-PAL-399',
						'ALG-PAL-505',
						'ALG-PAL-528',
						'ALG-PAL-531',
						'ALG-PAL-534',
						'ALG-PAL-545',
						'ALG-PAL-601',
						'ALG-PAL-612',
						'ALG-PAL-682',
						'ALG-PAL-688',
						'ALG-PAL-357',
						'ALG-PAL-213',
						'ALG-PAL-621',
						'ALG-PAL-510',
						'ALG-PAL-669',
						'ALG-PAL-600S',
						'ALG-PAL-518S',
						'ALG-PAL-215',
						'ALG-PAL-524',
						'ALG-PAL-529',
						'ALG-PAL-662',
						'ALG-DON-600',
						'ALG-DON-301',
						'ALG-DON-356',
						'ALG-DON-600',
						'ALG-DON-530',
						'ALG-DON-543',
						'ALG-DEB-304',
						'ALG-DEB-305',
						'ALG-DEB-309',
						'ALG-DEB-323',
						'ALG-DEB-386',
						'ALG-DEB-531',
						'ALG-DEB-532',
						'ALG-DEB-600',
						'ALG-DEB-601',
						'ALG-DEB-688',
						'ALG-DEB-810',
						'ALG-DEB-373',
						'ALG-DEB-560',
						'ALG-DEB-432',
						'ALG-DEB-573',
						'ALG-DEB-812',
						'ALG-SEV-221',
						'ALG-SEV-601',
						'ALG-SEV-213',
						'ALG-SEV-357',
						'ALG-SEV-813',
						'ALG-DAY-101',
						'ALG-DAY-248',
						'ALG-DAY-249',
						'ALG-DAY-250',
						'ALG-DAY-561',
						'ALG-DAY-601',
						'ALG-DAY-726',
						'ALG-DAY-564',
						'ALG-DAY-565',
						'ALG-DAY-567',
						'ALG-ALL-386',
						'ALG-ALL-571',
						'ALG-ALL-572',
						'ALG-ALL-726',
						'ALG-ALL-431',
						'ALG-ALL-433',
						'ALG-ALL-662',
						'ALG-KAI-221',
						'ALG-KAI-391',
						'ALG-KAI-601',
						'ALG-KAI-602',
						'ALG-KAI-251',
						'ALG-KAI-254',
						'ALG-KAI-712',
						'ALG-KAI-374',
						'ALG-KAI-606',
						'ALG-KAI-711',
						'ALG-KAY-100',
						'ALG-KAY-101',
						'ALG-KAY-131',
						'ALG-KAY-380',
						'ALG-KAY-381',
						'ALG-KAY-382',
						'ALG-KAY-387',
						'ALG-KAY-601',
						'ALG-KAY-726',
						'ALG-KAY-414',
						'ALG-KAY-415',
						'ALG-KAY-602',
						'ALG-KAY-428',
						'ALG-KAY-409',
						'ALG-KAY-418',
						'ALG-KAY-439',
						'ALG-KAY-430',
						'ALG-KAY-554',
						'ALG-KHL-104',
						'ALG-KHL-601',
						'ALG-KHL-632',
						'ALG-KYR-386',
						'ALG-KYR-601',
						'ALG-KYR-701',
						'ALG-KYR-703',
						'ALG-KYR-239',
						'ALG-KYR-374',
						'ALG-KYR-712',
						'ALG-KEL-431',
						'ALG-KEL-433',
						'ALG-KEL-565',
						'ALG-KEL-564',
						'ALG-KEL-601',
						'ALG-CIN-324',
						'ALG-CIN-600',
						'ALG-CIN-801',
						'ALG-CIN-825',
						'ALG-SAY-101',
						'ALG-SAY-325',
						'ALG-SAY-801',
						'ALG-SAY-409',
						'ALG-SAY-439',
						'ALG-SON-600',
						'ALG-SON-601',
						'ALG-SON-822',
						'ALG-BEL-101',
						'ALG-BEL-104',
						'ALG-BEL-392',
						'ALG-BEL-558',
						'ALG-BEL-631',
						'ALG-BEL-637',
						'ALG-BEL-433',
						'ALG-BEL-568',
						'ALG-PES-627',
						'ALG-PES-628',
						'ALG-PES-647',
						'ALG-PES-629',
						'ALG-PES-630',
						'ALG-PES-641',
						'ALG-PES-668',
						'ALG-PES-688',
						'ALG-TAY-602',
						'ALG-TAY-603',
						'ALG-TAY-611',
						'ALG-TAY-614',
						'ALG-TAY-616',
						'ALG-TAY-617',
						'ALG-ELL-104',
						'ALG-ELL-250',
						'ALG-ELL-601',
						'ALG-ELL-632',
						'ALG-ELL-703',
						'ALG-ELL-729',
						'ALG-ELL-730',
						'ALG-ETT-221',
						'ALG-ETT-222',
						'ALG-ETT-223',
						'ALG-ETT-601',
						'ALG-COC-201',
						'ALG-COC-204',
						'ALG-COC-601',
						'ALG-COC-701',
						'ALG-ISA-609',
						'ALG-ISA-610',
						'ALG-ISA-631',
						'ALG-ISA-647',
						'ALG-VER-565',
						'ALG-VER-669',
						'ALG-VER-832',
						'ALG-VER-834',
						'ALG-VER-601',
						'ALG-VIO-601',
						'ALG-VIO-831',
						'ALG-CAR-224',
						'ALG-CAR-524',
						'ALG-CAR-601',
						'ALG-CAR-621',
						'ALG-CAR-669',
						'ALG-CAR-212',
						'ALG-CAR-727',
						'ALG-CAR-820',
						'ALG-CAR-612',
						'ALG-CAR-653',
						'ALG-CAR-121',
						'ALG-KAR-224',
						'ALG-KAR-600',
						'ALG-KAR-601',
						'ALG-KAR-647',
						'ALG-KAR-235',
						'ALG-KAR-236',
						'ALG-KAR-237',
						'ALG-KLE-631',
						'ALG-KLE-639',
						'ALG-KLE-647',
						'ALG-KLE-728',
						'ALG-LAR-119',
						'ALG-LAR-214',
						'ALG-LAR-601',
						'ALG-LAR-713',
						'ALG-LOL-117',
						'ALG-LOL-132',
						'ALG-LOL-600',
						'ALG-LOL-601',
						'ALG-OLI-631',
						'ALG-OLI-647',
						'ALG-DIA-601',
						'ALG-ZAN-801',
						'ALG-ZAN-802');
				//write line to CSV if in stock
		
		if ($tmpStock > 0) {
			$available = "YES";
		}
		else {
			$available = "NO";
		}

		$line = "IN,"."0".$tmpUpc.",".$available.",".$tmpStock.",,,,,".$tmpColor.",,,,,,,,,BELK,\r\n";

		foreach ($selectedShoes as $skuNumber) {
			// if ($skuNumber == 'ALG-LAN-101' && $tmpSize < 37 ) {
			// 		continue;
			// 	}	
			if ($skuNumber == $tmpItemNo) { 
				fputs($file, $line);
				}	
			}
		}
				//echo $line."<br>";
				
		
		
	
	fclose($file);
	echo 'Belk CommerceHub TXT Created Successfully! Date today: '.$date.'<br /> <br />';
	echo 'Download: <a href="ftp://lko@ftp.alegriashoes.com/www/sales_alegriashoes_com/belk/inventory/belk_inventory'.$date.'.txt">Belk CommerceHub TXT for '.$date.'</a><br /><br /><b>***RIGHT CLICK and SAVE-AS to save file to computer!</b>';