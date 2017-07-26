<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_tss(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "theshoestore/tssinv.csv";
	//header
	$line = "ProductId,AO_Code,AO_Sufix,AO_Name,AO_Cost,AO_stock,AO_Weight\r\n";
	$company = "ALG";
	$replenishmentdate = "";
	$season = "ALG5";
	
	$ao_code = "2272";
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
	
	
	
	$file = fopen( $name, "w" );
	
	$time = date("H_i_s");

	
	$linkID = mysql_connect($inhost, $inuser, $inpass) or die ('Error connecting to mysql');
	mysql_select_db($indatabase, $linkID);
	
	$query = "SELECT * FROM $intable WHERE class = '".$season."' ORDER BY itemNo ASC";
	//$query = "SHOW COLUMNS FROM $intable WHERE class = '".$season."' ORDER BY itemNo ASC";


	$result = mysql_query($query, $linkID) or die("Data not found. 1st"); 
	
	
	
	fputs($file, $line);
	
	while($row = mysql_fetch_assoc($result)){
		
		
		
		//loop through size 35 to 42
		if(strpos($row['color'], 'Exclusive') === false){ 
			if(strpos($row['color'], 'Scrubwear') === false){	
			
			include("resource/variables_mysql.php");
			
			
			
			$tmpUPC		=trim($row1['UPC_CD']," ");
			
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */	
			if ($tmpStock <= 10){ $tmpStock = 0;} else { $tmpStock = $tmpStock;}
			
			if ($tmpSize == 35){ $sizeChart = "35 (US 5 - 5.5)";}
			if ($tmpSize == 36){ $sizeChart = "36 (US 6 - 6.5)";}
			if ($tmpSize == 37){ $sizeChart = "37 (US 7 - 7.5)";}
			if ($tmpSize == 38){ $sizeChart = "38 (US 8 - 8.5)";}
			if ($tmpSize == 39){ $sizeChart = "39 (US 9 - 9.5)";}
			if ($tmpSize == 40){ $sizeChart = "40 (US 10)";}
			if ($tmpSize == 41){ $sizeChart = "41 (US 10.5)";}
			if ($tmpSize == 42){ $sizeChart = "42 (US 11)";}
			
		/*	if ($tmpItemNo == "ALG-101"){$pID = "1";}	
			if ($tmpItemNo == "ALG-112"){$pID = "2";}	
			if ($tmpItemNo == "ALG-117"){$pID = "3";}	
			if ($tmpItemNo == "ALG-123"){$pID = "4";}	
			if ($tmpItemNo == "ALG-124"){$pID = "5";}	
			if ($tmpItemNo == "ALG-126"){$pID = "6";}	
			if ($tmpItemNo == "ALG-205"){$pID = "7";}	
			if ($tmpItemNo == "ALG-206"){$pID = "8";}	
			if ($tmpItemNo == "ALG-211"){$pID = "9";}	
			if ($tmpItemNo == "ALG-311"){$pID = "10";}	
			if ($tmpItemNo == "ALG-316"){$pID = "11";}	
			if ($tmpItemNo == "ALG-ASP-6146"){$pID = "49";}	
			if ($tmpItemNo == "ALG-ASP-6156"){$pID = "50";}	
			if ($tmpItemNo == "ALG-CAR-101"){$pID = "51";}	
			if ($tmpItemNo == "ALG-CAR-123"){$pID = "52";}	
			if ($tmpItemNo == "ALG-CAR-126"){$pID = "53";}	
			if ($tmpItemNo == "ALG-CAR-419"){$pID = "54";}	
			if ($tmpItemNo == "ALG-CAR-423"){$pID = "55";}	
			if ($tmpItemNo == "ALG-CAR-601"){$pID = "56";}	
			if ($tmpItemNo == "ALG-CAR-602"){$pID = "57";}	
			if ($tmpItemNo == "ALG-CAR-604"){$pID = "58";}	
			if ($tmpItemNo == "ALG-CAR-611"){$pID = "59";}	
			if ($tmpItemNo == "ALG-DEB-600"){$pID = "60";}	
			if ($tmpItemNo == "ALG-DEB-601"){$pID = "61";}	
			if ($tmpItemNo == "ALG-DON-114"){$pID = "62";}	
			if ($tmpItemNo == "ALG-DON-314"){$pID = "63";}	
			if ($tmpItemNo == "ALG-DON-315"){$pID = "64";}	
			if ($tmpItemNo == "ALG-DON-339"){$pID = "65";}	
			if ($tmpItemNo == "ALG-DON-515"){$pID = "66";}	
			if ($tmpItemNo == "ALG-DON-516"){$pID = "67";}	
			if ($tmpItemNo == "ALG-DON-517"){$pID = "68";}	
			if ($tmpItemNo == "ALG-DON-519"){$pID = "69";}	
			if ($tmpItemNo == "ALG-DON-600"){$pID = "70";}	
			if ($tmpItemNo == "ALG-DON-601"){$pID = "71";}	
			if ($tmpItemNo == "ALG-FEL-101"){$pID = "72";}	
			if ($tmpItemNo == "ALG-FEL-102"){$pID = "73";}	
			if ($tmpItemNo == "ALG-FEL-205"){$pID = "74";}	
			if ($tmpItemNo == "ALG-FEL-206"){$pID = "75";}	
			if ($tmpItemNo == "ALG-FEL-211"){$pID = "76";}	
			if ($tmpItemNo == "ALG-FEL-326"){$pID = "77";}	
			if ($tmpItemNo == "ALG-FEL-327"){$pID = "78";}	
			if ($tmpItemNo == "ALG-FEL-345"){$pID = "79";}	
			if ($tmpItemNo == "ALG-FEL-346"){$pID = "80";}	
			if ($tmpItemNo == "ALG-FEL-347"){$pID = "81";}	
			if ($tmpItemNo == "ALG-FEL-412"){$pID = "82";}	
			if ($tmpItemNo == "ALG-FEL-416"){$pID = "83";}	
			if ($tmpItemNo == "ALG-FEL-420"){$pID = "84";}	
			if ($tmpItemNo == "ALG-FEL-507"){$pID = "85";}	
			if ($tmpItemNo == "ALG-FEL-509"){$pID = "86";}	
			if ($tmpItemNo == "ALG-FEL-601"){$pID = "87";}	
			if ($tmpItemNo == "ALG-MAR-205"){$pID = "96";}	
			if ($tmpItemNo == "ALG-MAR-206"){$pID = "97";}	
			if ($tmpItemNo == "ALG-MAR-211"){$pID = "98";}	
			if ($tmpItemNo == "ALG-MAR-305"){$pID = "99";}	
			if ($tmpItemNo == "ALG-MAR-604"){$pID = "100";}	
			if ($tmpItemNo == "ALG-MAR-611"){$pID = "101";}	
			if ($tmpItemNo == "ALG-PAL-101"){$pID = "102";}	
			if ($tmpItemNo == "ALG-PAL-112"){$pID = "103";}	
			if ($tmpItemNo == "ALG-PAL-123"){$pID = "104";}	
			if ($tmpItemNo == "ALG-PAL-124"){$pID = "105";}	
			if ($tmpItemNo == "ALG-PAL-205"){$pID = "106";}	
			if ($tmpItemNo == "ALG-PAL-206"){$pID = "107";}	
			if ($tmpItemNo == "ALG-PAL-208"){$pID = "108";}	
			if ($tmpItemNo == "ALG-PAL-209"){$pID = "109";}	
			if ($tmpItemNo == "ALG-PAL-211"){$pID = "110";}	
			if ($tmpItemNo == "ALG-PAL-311"){$pID = "111";}	
			if ($tmpItemNo == "ALG-PAL-323"){$pID = "112";}	
			if ($tmpItemNo == "ALG-PAL-324"){$pID = "113";}	
			if ($tmpItemNo == "ALG-PAL-325"){$pID = "114";}	
			if ($tmpItemNo == "ALG-PAL-333"){$pID = "115";}	
			if ($tmpItemNo == "ALG-PAL-334"){$pID = "116";}	
			if ($tmpItemNo == "ALG-PAL-402"){$pID = "117";}	
			if ($tmpItemNo == "ALG-PAL-406"){$pID = "118";}	
			if ($tmpItemNo == "ALG-PAL-407"){$pID = "119";}	
			if ($tmpItemNo == "ALG-PAL-410"){$pID = "120";}	
			if ($tmpItemNo == "ALG-PAL-421"){$pID = "121";}	
			if ($tmpItemNo == "ALG-PAL-424"){$pID = "122";}	
			if ($tmpItemNo == "ALG-PAL-504"){$pID = "123";}	
			if ($tmpItemNo == "ALG-PAL-514"){$pID = "124";}	
			if ($tmpItemNo == "ALG-PAL-600"){$pID = "125";}	
			if ($tmpItemNo == "ALG-PAL-601"){$pID = "126";}	
			if ($tmpItemNo == "ALG-PAL-602"){$pID = "127";}	
			if ($tmpItemNo == "ALG-PAL-604"){$pID = "128";}	
			if ($tmpItemNo == "ALG-PAL-701"){$pID = "129";}	
			if ($tmpItemNo == "ALG-PAL-702"){$pID = "130";}	
			if ($tmpItemNo == "ALG-PAL-802"){$pID = "131";}	
			if ($tmpItemNo == "ALG-PAL-804"){$pID = "132";}	
			if ($tmpItemNo == "ALG-PIS-101"){$pID = "133";}	
			if ($tmpItemNo == "ALG-PIS-123"){$pID = "134";}	
			if ($tmpItemNo == "ALG-PIS-126"){$pID = "135";}	
			if ($tmpItemNo == "ALG-PIS-604"){$pID = "136";}	
			if ($tmpItemNo == "ALG-PIS-611"){$pID = "137";}	
			if ($tmpItemNo == "ALG-PIS-615"){$pID = "138";}	
			if ($tmpItemNo == "ALG-PIS-618"){$pID = "139";}	
			if ($tmpItemNo == "ALG-TUS-420"){$pID = "168";}	
			if ($tmpItemNo == "ALG-TUS-422"){$pID = "169";}	
			if ($tmpItemNo == "ALG-TUS-604"){$pID = "170";}	
			if ($tmpItemNo == "ALG-TUS-611"){$pID = "171";}	
			if ($tmpItemNo == "ALG-TUS-614"){$pID = "172";}	
			if ($tmpItemNo == "ALG-999"){$pID = "224";}	
			if ($tmpItemNo == "ALG-999W"){$pID = "225";}	
			if ($tmpItemNo == "ALG-SED-205"){$pID = "226";}	
			if ($tmpItemNo == "ALG-SED-206"){$pID = "227";}	
			if ($tmpItemNo == "ALG-SED-211"){$pID = "228";}	
			if ($tmpItemNo == "ALG-SED-412"){$pID = "229";}	
			if ($tmpItemNo == "ALG-SED-416"){$pID = "230";}	
			if ($tmpItemNo == "ALG-SED-508"){$pID = "231";}	
			if ($tmpItemNo == "ALG-SED-521"){$pID = "232";}	
			if ($tmpItemNo == "ALG-SED-601"){$pID = "233";}	
			if ($tmpItemNo == "ALG-SED-602"){$pID = "234";}	
			if ($tmpItemNo == "ALG-SEV-101"){$pID = "235";}	
			if ($tmpItemNo == "ALG-SEV-1121"){$pID = "236";}	
			if ($tmpItemNo == "ALG-SEV-122"){$pID = "237";}	
			if ($tmpItemNo == "ALG-SEV-1231"){$pID = "238";}	
			if ($tmpItemNo == "ALG-SEV-126"){$pID = "239";}	
			if ($tmpItemNo == "ALG-SEV-3211"){$pID = "240";}	
			if ($tmpItemNo == "ALG-SEV-3221"){$pID = "241";}	
			if ($tmpItemNo == "ALG-SEV-339"){$pID = "242";}	
			if ($tmpItemNo == "ALG-SEV-5211"){$pID = "243";}	
			if ($tmpItemNo == "ALG-SEV-5221"){$pID = "244";}	
			if ($tmpItemNo == "ALG-SEV-5231"){$pID = "245";}	
			if ($tmpItemNo == "ALG-SEV-525"){$pID = "246";}	
			if ($tmpItemNo == "ALG-SEV-600"){$pID = "247";}	
			if ($tmpItemNo == "ALG-SEV-601"){$pID = "248";}	
			if ($tmpItemNo == "ALG-SEV-602"){$pID = "249";}	
			if ($tmpItemNo == "ALG-SEV-701"){$pID = "250";}	
			if ($tmpItemNo == "ALG-SEV-702"){$pID = "251";}	
			if ($tmpItemNo == "ALG-SEV-711"){$pID = "252";}	
			if ($tmpItemNo == "ALG-SEV-712"){$pID = "253";}	
			if ($tmpItemNo == "ALG-VER-101"){$pID = "254";}	
			if ($tmpItemNo == "ALG-VER-123"){$pID = "255";}	
			if ($tmpItemNo == "ALG-VER-126"){$pID = "256";}	
			if ($tmpItemNo == "ALG-VER-305"){$pID = "257";}	
			if ($tmpItemNo == "ALG-VER-422"){$pID = "258";}	
			if ($tmpItemNo == "ALG-VER-423"){$pID = "259";}	
			if ($tmpItemNo == "ALG-VER-604"){$pID = "260";}	
			if ($tmpItemNo == "ALG-VER-611"){$pID = "261";}	
			if ($tmpItemNo == "ALG-MAD-101"){$pID = "262";}	
			if ($tmpItemNo == "ALG-MAD-126"){$pID = "263";}	
			if ($tmpItemNo == "ALG-MAD-420"){$pID = "264";}	
			if ($tmpItemNo == "ALG-FEL-709"){$pID = "265";}	
			if ($tmpItemNo == "ALG-320"){$pID = "266";}	
			if ($tmpItemNo == "ALG-321"){$pID = "267";}	
			if ($tmpItemNo == "ALG-322"){$pID = "268";}	
			if ($tmpItemNo == "ALG-323"){$pID = "269";}	
			if ($tmpItemNo == "ALG-330"){$pID = "270";}	
			if ($tmpItemNo == "ALG-336"){$pID = "271";}	
			if ($tmpItemNo == "ALG-337"){$pID = "272";}	
			if ($tmpItemNo == "ALG-407"){$pID = "273";}	
			if ($tmpItemNo == "ALG-410"){$pID = "274";}	
			if ($tmpItemNo == "ALG-412"){$pID = "275";}	
			if ($tmpItemNo == "ALG-416"){$pID = "276";}	
			if ($tmpItemNo == "ALG-421"){$pID = "277";}	
			if ($tmpItemNo == "ALG-424"){$pID = "278";}	
			if ($tmpItemNo == "ALG-504"){$pID = "279";}	
			if ($tmpItemNo == "ALG-505"){$pID = "280";}	
			if ($tmpItemNo == "ALG-509"){$pID = "281";}	
			if ($tmpItemNo == "ALG-511"){$pID = "282";}	
			if ($tmpItemNo == "ALG-512"){$pID = "283";}	
			if ($tmpItemNo == "ALG-513"){$pID = "284";}	
			if ($tmpItemNo == "ALG-601"){$pID = "285";}	
			if ($tmpItemNo == "ALG-602"){$pID = "286";}	
			if ($tmpItemNo == "ALG-604"){$pID = "287";}	
			if ($tmpItemNo == "ALG-701"){$pID = "288";}	
			if ($tmpItemNo == "ALG-702"){$pID = "289";}	
			if ($tmpItemNo == "ALG-709"){$pID = "290";}	
			if ($tmpItemNo == "ALG-714"){$pID = "291";}	
			if ($tmpItemNo == "ALG-715"){$pID = "292";}	
			if ($tmpItemNo == "ALG-716"){$pID = "293";}	
			if ($tmpItemNo == "ALG-802"){$pID = "294";}	
			if ($tmpItemNo == "ALG-804"){$pID = "295";}	
			if ($tmpItemNo == "ALG-814"){$pID = "296";}	
			if ($tmpItemNo == "ALG-925"){$pID = "297";}	
			if ($tmpItemNo == "ALG-FEL-710"){$pID = "298";}	
			if ($tmpItemNo == "ALG-FEL-713"){$pID = "299";}	
			if ($tmpItemNo == "ALG-FEL-714"){$pID = "300";}	
			*/
			if ($tmpItemNo == "ALG-128"){$pID = "375";}
			if ($tmpItemNo == "ALG-381"){$pID = "376";}
			if ($tmpItemNo == "ALG-382"){$pID = "377";}
			if ($tmpItemNo == "ALG-383"){$pID = "378";}
			if ($tmpItemNo == "ALG-535"){$pID = "379";}
			if ($tmpItemNo == "ALG-536"){$pID = "380";}
			if ($tmpItemNo == "ALG-537"){$pID = "381";}
			if ($tmpItemNo == "ALG-631"){$pID = "382";}
			if ($tmpItemNo == "ALG-633"){$pID = "383";}
			if ($tmpItemNo == "ALG-635"){$pID = "384";}
			if ($tmpItemNo == "ALG-637"){$pID = "385";}
			if ($tmpItemNo == "ALG-723"){$pID = "386";}
			if ($tmpItemNo == "ALG-ABB-362"){$pID = "387";}
			if ($tmpItemNo == "ALG-ABB-363"){$pID = "388";}
			if ($tmpItemNo == "ALG-ABB-526"){$pID = "389";}
			if ($tmpItemNo == "ALG-BAL-101"){$pID = "390";}
			if ($tmpItemNo == "ALG-BAL-201"){$pID = "391";}
			if ($tmpItemNo == "ALG-CAR-201"){$pID = "392";}
			if ($tmpItemNo == "ALG-CAR-204"){$pID = "393";}
			if ($tmpItemNo == "ALG-CAR-241"){$pID = "394";}
			if ($tmpItemNo == "ALG-CAR-242"){$pID = "395";}
			if ($tmpItemNo == "ALG-CAR-246"){$pID = "396";}
			if ($tmpItemNo == "ALG-CAR-247"){$pID = "397";}
			if ($tmpItemNo == "ALG-CHA-101"){$pID = "398";}
			if ($tmpItemNo == "ALG-CHA-702"){$pID = "399";}
			if ($tmpItemNo == "ALG-CHA-703"){$pID = "400";}
			if ($tmpItemNo == "ALG-DAY-103"){$pID = "401";}
			if ($tmpItemNo == "ALG-DAY-353"){$pID = "402";}
			if ($tmpItemNo == "ALG-DAY-354"){$pID = "403";}
			if ($tmpItemNo == "ALG-DAY-624"){$pID = "404";}
			if ($tmpItemNo == "ALG-DEB-731"){$pID = "405";}
			if ($tmpItemNo == "ALG-DEB-732"){$pID = "406";}
			if ($tmpItemNo == "ALG-DON-129"){$pID = "407";}
			if ($tmpItemNo == "ALG-DON-354"){$pID = "408";}
			if ($tmpItemNo == "ALG-DON-550"){$pID = "409";}
			if ($tmpItemNo == "ALG-FEL-181"){$pID = "410";}
			if ($tmpItemNo == "ALG-FEL-551"){$pID = "411";}
			if ($tmpItemNo == "ALG-FEL-552"){$pID = "412";}
			if ($tmpItemNo == "ALG-FEL-555"){$pID = "413";}
			if ($tmpItemNo == "ALG-KAI-556"){$pID = "414";}
			if ($tmpItemNo == "ALG-KAI-557"){$pID = "415";}
			if ($tmpItemNo == "ALG-KAI-600"){$pID = "416";}
			if ($tmpItemNo == "ALG-KAI-601"){$pID = "417";}
			if ($tmpItemNo == "ALG-KAR-347"){$pID = "418";}
			if ($tmpItemNo == "ALG-KAR-349"){$pID = "419";}
			if ($tmpItemNo == "ALG-KAR-522"){$pID = "420";}
			if ($tmpItemNo == "ALG-KAR-537"){$pID = "421";}
			if ($tmpItemNo == "ALG-KAR-701"){$pID = "422";}
			if ($tmpItemNo == "ALG-KAR-705"){$pID = "423";}
			if ($tmpItemNo == "ALG-KAR-951"){$pID = "424";}
			if ($tmpItemNo == "ALG-KLE-101"){$pID = "425";}
			if ($tmpItemNo == "ALG-KLE-137"){$pID = "426";}
			if ($tmpItemNo == "ALG-KLE-723"){$pID = "427";}
			if ($tmpItemNo == "ALG-PAL-133"){$pID = "428";}
			if ($tmpItemNo == "ALG-PAL-210"){$pID = "429";}
			if ($tmpItemNo == "ALG-PAL-411"){$pID = "430";}
			if ($tmpItemNo == "ALG-PAL-522"){$pID = "431";}
			if ($tmpItemNo == "ALG-PAL-642"){$pID = "432";}
			if ($tmpItemNo == "ALG-PAL-645"){$pID = "433";}
			if ($tmpItemNo == "ALG-PES-624"){$pID = "434";}
			if ($tmpItemNo == "ALG-PES-641"){$pID = "435";}
			if ($tmpItemNo == "ALG-PES-643"){$pID = "436";}
			if ($tmpItemNo == "ALG-PES-647"){$pID = "437";}
			if ($tmpItemNo == "ALG-SEV-581"){$pID = "438";}
			if ($tmpItemNo == "ALG-SEV-583"){$pID = "439";}
			if ($tmpItemNo == "ALG-TUS-553"){$pID = "440";}
			if ($tmpItemNo == "ALG-TUS-723"){$pID = "441";}
			if ($tmpItemNo == "ALG-TUS-951"){$pID = "442";}
			if ($tmpItemNo == "ALG-VER-601"){$pID = "443";}
			if ($tmpItemNo == "ALG-VER-703"){$pID = "444";}
			if ($tmpItemNo == "ALG-VER-705"){$pID = "445";}
			if ($tmpItemNo == "ALG-VER-706"){$pID = "446";}
			if ($tmpItemNo == "ALG-VER-710"){$pID = "447";}
			if ($tmpItemNo == "ALG-VIO-210"){$pID = "448";}
			if ($tmpItemNo == "ALG-VIO-553"){$pID = "449";}
			if ($tmpItemNo == "ALG-VIO-601"){$pID = "450";}
			if ($tmpItemNo == "ALG-VIO-720"){$pID = "451";}

	

			//content/data
			//$line = $pID.",".$row['DESCRIP'].",,".$tmpItemNo."-".$tmpSize.",".$sizeChart.",0,".$tmpStock.",0\r\n";
			$line = $pID.",".$ao_code.",".$tmpItemNo."-".$tmpSize.",".$sizeChart.",0,".$tmpStock.",0\r\n";
			
			$ao_code++;
			
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
				//echo $line."<br>";
				fputs($file, $line);
			}
		}
			
	}
	fclose($file);
	echo "TSS created<br>";
}


inv_tss();
?>

