<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function newprod_alegriashoes(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "alegriashoes/alegriashoes-newproducts.csv";
	//header
	$line = "Product ID,Product Type,Code,Name,Brand,Description,Cost Price,Retail Price,Sale Price,Calculated Price, Fixed Shipping Price,Free Shipping,Warranty,Weight,Width,Height,Depth,Allow Purchases,Product Visible,Product Availability,Product Inventoried,Stock Level,Low Stock,Date Added,Date Modified,Category Details,Images,Page Title,META Keywords,META Description,Product Condition,upc\r\n";
	//$company = "ALG";
	$replenishmentdate = "";
	
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
	
	
	
	$file = fopen( $name, "w" );
	
	$time = date("H_i_s");

	

	
	

	$inlinkID = mysql_connect($inhost, $inuser, $inpass) or die("Could not connect to host."); 
	mysql_select_db($indatabase, $inlinkID) or die("Could not find database1."); 
	
	$query = "SELECT itemNo FROM $intable WHERE class = 'ALG4' ORDER BY itemNo ASC";
	$result = mysql_query($query, $inlinkID) or die("Data not found. 1st"); 
	
	//echo $query;
	$style1 = array(); 
	while($row = mysql_fetch_assoc($result)){
		
		array_push($style1, $row['itemNo']);
	
	}
    $a = array();
	$a = array_count_values($style1);
	//print_r ($a);
	
	$style1 = array_keys(array_flip($style1));
	
	//print_r ($style1);
	
	
	fputs($file, $line);
	
	for($x=0; $x<count($style1); $x++){
		
		$query = "SELECT * FROM $intable WHERE itemNo = '$style1[$x]'";
		$result = mysql_query($query, $inlinkID) or die("Data not found. 1st"); 
		
		$row = mysql_fetch_array($result);
		//loop through size 35 to 42
		//for($x = 1; $x < 9 ; $x++){
			
			//include("resource/size.php");
			
			include("resource/retailprice.php");
			
			include("resource/variables.php");
			
			//include("resource/connection_upc.php");
			
			
			//while($row1 = mysql_fetch_array($result1)){
			
			//$tmpUPC		=trim($row1['UPC_CD']," ");
			
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */	
		
		
		
		/*	if ($tmpStock <= 10){ $tmpStock = 0;} else { $tmpStock = $tmpStock;}
			
			if ($tmpSize == 35){ $sizeChart = "Size: Euro 35 / US 5 - 5.5";}
			if ($tmpSize == 36){ $sizeChart = "Size: Euro 36 / US 6 - 6.5";}
			if ($tmpSize == 37){ $sizeChart = "Size: Euro 37 / US 7 - 7.5";}
			if ($tmpSize == 38){ $sizeChart = "Size: Euro 38 / US 8 - 8.5";}
			if ($tmpSize == 39){ $sizeChart = "Size: Euro 39 / US 9 - 9.5";}
			if ($tmpSize == 40){ $sizeChart = "Size: Euro 40 / US 10";}
			if ($tmpSize == 41){ $sizeChart = "Size: Euro 41 / US 10.5";}
			if ($tmpSize == 42){ $sizeChart = "Size: Euro 42 / US 11";}
			
			if ($tmpItemNo == "ALG-101"){$pID = "106";}
			if ($tmpItemNo == "ALG-104"){$pID = "208";}
			if ($tmpItemNo == "ALG-112"){$pID = "209";}
			if ($tmpItemNo == "ALG-117"){$pID = "210";}
			if ($tmpItemNo == "ALG-122"){$pID = "211";}
			if ($tmpItemNo == "ALG-123"){$pID = "280";}
			if ($tmpItemNo == "ALG-124"){$pID = "110";}
			if ($tmpItemNo == "ALG-125"){$pID = "281";}
			if ($tmpItemNo == "ALG-201"){$pID = "212";}
			if ($tmpItemNo == "ALG-205"){$pID = "282";}
			if ($tmpItemNo == "ALG-206"){$pID = "283";}
			if ($tmpItemNo == "ALG-211"){$pID = "284";}
			if ($tmpItemNo == "ALG-301"){$pID = "115";}
			if ($tmpItemNo == "ALG-305"){$pID = "268";}
			if ($tmpItemNo == "ALG-306"){$pID = "285";}
			if ($tmpItemNo == "ALG-309"){$pID = "269";}
			if ($tmpItemNo == "ALG-310"){$pID = "270";}
			if ($tmpItemNo == "ALG-311"){$pID = "119";}
			if ($tmpItemNo == "ALG-312"){$pID = "120";}
			if ($tmpItemNo == "ALG-313"){$pID = "121";}
			if ($tmpItemNo == "ALG-316"){$pID = "143";}
			if ($tmpItemNo == "ALG-317"){$pID = "144";}
			if ($tmpItemNo == "ALG-318"){$pID = "148";}
			if ($tmpItemNo == "ALG-319"){$pID = "145";}
			if ($tmpItemNo == "ALG-320"){$pID = "286";}
			if ($tmpItemNo == "ALG-321"){$pID = "287";}
			if ($tmpItemNo == "ALG-322"){$pID = "362";}
			if ($tmpItemNo == "ALG-407"){$pID = "146";}
			if ($tmpItemNo == "ALG-408"){$pID = "207";}
			if ($tmpItemNo == "ALG-410"){$pID = "288";}
			if ($tmpItemNo == "ALG-412"){$pID = "289";}
			if ($tmpItemNo == "ALG-416"){$pID = "290";}
			if ($tmpItemNo == "ALG-421"){$pID = "291";}
			if ($tmpItemNo == "ALG-424"){$pID = "292";}
			if ($tmpItemNo == "ALG-502"){$pID = "234";}
			if ($tmpItemNo == "ALG-503"){$pID = "149";}
			if ($tmpItemNo == "ALG-504"){$pID = "150";}
			if ($tmpItemNo == "ALG-505"){$pID = "151";}
			if ($tmpItemNo == "ALG-509"){$pID = "293";}
			if ($tmpItemNo == "ALG-511"){$pID = "294";}
			if ($tmpItemNo == "ALG-512"){$pID = "295";}
			if ($tmpItemNo == "ALG-513"){$pID = "296";}
			if ($tmpItemNo == "ALG-601"){$pID = "152";}
			if ($tmpItemNo == "ALG-602"){$pID = "153";}
			if ($tmpItemNo == "ALG-604"){$pID = "297";}
			if ($tmpItemNo == "ALG-701"){$pID = "154";}
			if ($tmpItemNo == "ALG-702"){$pID = "155";}
			if ($tmpItemNo == "ALG-705"){$pID = "156";}
			if ($tmpItemNo == "ALG-708"){$pID = "157";}
			if ($tmpItemNo == "ALG-709"){$pID = "298";}
			if ($tmpItemNo == "ALG-714"){$pID = "299";}
			if ($tmpItemNo == "ALG-802"){$pID = "158";}
			if ($tmpItemNo == "ALG-803"){$pID = "159";}
			if ($tmpItemNo == "ALG-804"){$pID = "160";}
			if ($tmpItemNo == "ALG-814"){$pID = "300";}
			if ($tmpItemNo == "ALG-902"){$pID = "213";}
			if ($tmpItemNo == "ALG-921"){$pID = "214";}
			if ($tmpItemNo == "ALG-922"){$pID = "215";}
			if ($tmpItemNo == "ALG-923"){$pID = "301";}
			if ($tmpItemNo == "ALG-924"){$pID = "302";}
			if ($tmpItemNo == "ALG-925"){$pID = "161";}
			if ($tmpItemNo == "ALG-995"){$pID = "";}
			if ($tmpItemNo == "ALG-999"){$pID = "";}
			if ($tmpItemNo == "ALG-999W"){$pID = "";}
			if ($tmpItemNo == "ALG-FEL-999W"){$pID = "";}
			if ($tmpItemNo == "ALG-ASP-6116"){$pID = "303";}
			if ($tmpItemNo == "ALG-ASP-6126"){$pID = "304";}
			if ($tmpItemNo == "ALG-ASP-6136"){$pID = "305";}
			if ($tmpItemNo == "ALG-ASP-6146"){$pID = "306";}
			if ($tmpItemNo == "ALG-ASP-6156"){$pID = "307";}
			if ($tmpItemNo == "ALG-BAR-101"){$pID = "235";}
			if ($tmpItemNo == "ALG-BAR-102"){$pID = "236";}
			if ($tmpItemNo == "ALG-BAR-104"){$pID = "237";}
			if ($tmpItemNo == "ALG-BAR-120"){$pID = "238";}
			if ($tmpItemNo == "ALG-BAR-124"){$pID = "";}
			if ($tmpItemNo == "ALG-BAR-305"){$pID = "239";}
			if ($tmpItemNo == "ALG-BAR-306"){$pID = "";}
			if ($tmpItemNo == "ALG-BAR-316"){$pID = "271";}
			if ($tmpItemNo == "ALG-BAR-601"){$pID = "240";}
			if ($tmpItemNo == "ALG-BAR-701"){$pID = "272";}
			if ($tmpItemNo == "ALG-BAR-702"){$pID = "273";}
			if ($tmpItemNo == "ALG-BAR-703"){$pID = "274";}
			if ($tmpItemNo == "ALG-BAR-705"){$pID = "275";}
			if ($tmpItemNo == "ALG-BAR-708"){$pID = "276";}
			if ($tmpItemNo == "ALG-DEB-600"){$pID = "227";}
			if ($tmpItemNo == "ALG-DEB-601"){$pID = "228";}
			if ($tmpItemNo == "ALG-DEB-604"){$pID = "229";}
			if ($tmpItemNo == "ALG-DEB-605"){$pID = "230";}
			if ($tmpItemNo == "ALG-DON-307"){$pID = "219";}
			if ($tmpItemNo == "ALG-DON-308"){$pID = "220";}
			if ($tmpItemNo == "ALG-DON-314"){$pID = "221";}
			if ($tmpItemNo == "ALG-DON-315"){$pID = "222";}
			if ($tmpItemNo == "ALG-DON-515"){$pID = "308";}
			if ($tmpItemNo == "ALG-DON-516"){$pID = "309";}
			if ($tmpItemNo == "ALG-DON-517"){$pID = "382";}
			if ($tmpItemNo == "ALG-DON-519"){$pID = "310";}
			if ($tmpItemNo == "ALG-DON-600"){$pID = "223";}
			if ($tmpItemNo == "ALG-DON-601"){$pID = "224";}
			if ($tmpItemNo == "ALG-DON-604"){$pID = "225";}
			if ($tmpItemNo == "ALG-DON-605"){$pID = "226";}
			if ($tmpItemNo == "ALG-FEL-101"){$pID = "311";}
			if ($tmpItemNo == "ALG-FEL-102"){$pID = "312";}
			if ($tmpItemNo == "ALG-FEL-205"){$pID = "313";}
			if ($tmpItemNo == "ALG-FEL-206"){$pID = "314";}
			if ($tmpItemNo == "ALG-FEL-211"){$pID = "315";}
			if ($tmpItemNo == "ALG-FEL-412"){$pID = "316";}
			if ($tmpItemNo == "ALG-FEL-416"){$pID = "317";}
			if ($tmpItemNo == "ALG-FEL-507"){$pID = "318";}
			if ($tmpItemNo == "ALG-FEL-509"){$pID = "319";}
			if ($tmpItemNo == "ALG-FEL-601"){$pID = "320";}
			if ($tmpItemNo == "ALG-FEL-602"){$pID = "321";}
			if ($tmpItemNo == "ALG-FEL-604"){$pID = "363";}
			if ($tmpItemNo == "ALG-FEL-701"){$pID = "322";}
			if ($tmpItemNo == "ALG-FEL-709"){$pID = "323";}
			if ($tmpItemNo == "ALG-FEL-713"){$pID = "324";}
			if ($tmpItemNo == "ALG-FEL-714"){$pID = "325";}
			if ($tmpItemNo == "ALG-MIL-101"){$pID = "197";}
			if ($tmpItemNo == "ALG-MIL-102"){$pID = "198";}
			if ($tmpItemNo == "ALG-MIL-103"){$pID = "199";}
			if ($tmpItemNo == "ALG-MIL-105"){$pID = "200";}
			if ($tmpItemNo == "ALG-MIL-118"){$pID = "202";}
			if ($tmpItemNo == "ALG-MIL-124"){$pID = "203";}
			if ($tmpItemNo == "ALG-MIL-201"){$pID = "204";}
			if ($tmpItemNo == "ALG-MIL-204"){$pID = "205";}
			if ($tmpItemNo == "ALG-MIL-601"){$pID = "206";}
			if ($tmpItemNo == "ALG-MIL-801"){$pID = "278";}
			if ($tmpItemNo == "ALG-MIL-802"){$pID = "279";}
			if ($tmpItemNo == "ALG-PAL-101"){$pID = "179";}
			if ($tmpItemNo == "ALG-PAL-112"){$pID = "163";}
			if ($tmpItemNo == "ALG-PAL-123"){$pID = "326";}
			if ($tmpItemNo == "ALG-PAL-124"){$pID = "327";}
			if ($tmpItemNo == "ALG-PAL-205"){$pID = "328";}
			if ($tmpItemNo == "ALG-PAL-206"){$pID = "329";}
			if ($tmpItemNo == "ALG-PAL-211"){$pID = "330";}
			if ($tmpItemNo == "ALG-PAL-309"){$pID = "181";}
			if ($tmpItemNo == "ALG-PAL-311"){$pID = "184";}
			if ($tmpItemNo == "ALG-PAL-312"){$pID = "172";}
			if ($tmpItemNo == "ALG-PAL-313"){$pID = "173";}
			if ($tmpItemNo == "ALG-PAL-314"){$pID = "182";}
			if ($tmpItemNo == "ALG-PAL-317"){$pID = "180";}
			if ($tmpItemNo == "ALG-PAL-323"){$pID = "331";}
			if ($tmpItemNo == "ALG-PAL-324"){$pID = "332";}
			if ($tmpItemNo == "ALG-PAL-325"){$pID = "333";}
			if ($tmpItemNo == "ALG-PAL-331"){$pID = "334";}
			if ($tmpItemNo == "ALG-PAL-402"){$pID = "183";}
			if ($tmpItemNo == "ALG-PAL-406"){$pID = "177";}
			if ($tmpItemNo == "ALG-PAL-407"){$pID = "178";}
			if ($tmpItemNo == "ALG-PAL-408"){$pID = "185";}
			if ($tmpItemNo == "ALG-PAL-410"){$pID = "335";}
			if ($tmpItemNo == "ALG-PAL-421"){$pID = "336";}
			if ($tmpItemNo == "ALG-PAL-424"){$pID = "337";}
			if ($tmpItemNo == "ALG-PAL-504"){$pID = "186";}
			if ($tmpItemNo == "ALG-PAL-506"){$pID = "187";}
			if ($tmpItemNo == "ALG-PAL-600"){$pID = "338";}
			if ($tmpItemNo == "ALG-PAL-601"){$pID = "188";}
			if ($tmpItemNo == "ALG-PAL-602"){$pID = "189";}
			if ($tmpItemNo == "ALG-PAL-604"){$pID = "339";}
			if ($tmpItemNo == "ALG-PAL-701"){$pID = "190";}
			if ($tmpItemNo == "ALG-PAL-702"){$pID = "191";}
			if ($tmpItemNo == "ALG-PAL-705"){$pID = "192";}
			if ($tmpItemNo == "ALG-PAL-707"){$pID = "193";}
			if ($tmpItemNo == "ALG-PAL-708"){$pID = "194";}
			if ($tmpItemNo == "ALG-PAL-802"){$pID = "195";}
			if ($tmpItemNo == "ALG-PAL-804"){$pID = "196";}
			if ($tmpItemNo == "ALG-POR-101"){$pID = "253";}
			if ($tmpItemNo == "ALG-POR-102"){$pID = "254";}
			if ($tmpItemNo == "ALG-POR-103"){$pID = "255";}
			if ($tmpItemNo == "ALG-POR-104"){$pID = "340";}
			if ($tmpItemNo == "ALG-POR-105"){$pID = "256";}
			if ($tmpItemNo == "ALG-POR-118"){$pID = "257";}
			if ($tmpItemNo == "ALG-POR-120"){$pID = "258";}
			if ($tmpItemNo == "ALG-POR-124"){$pID = "259";}
			if ($tmpItemNo == "ALG-POR-201"){$pID = "260";}
			if ($tmpItemNo == "ALG-POR-204"){$pID = "261";}
			if ($tmpItemNo == "ALG-POR-505"){$pID = "277";}
			if ($tmpItemNo == "ALG-SED-205"){$pID = "341";}
			if ($tmpItemNo == "ALG-SED-206"){$pID = "342";}
			if ($tmpItemNo == "ALG-SED-211"){$pID = "343";}
			if ($tmpItemNo == "ALG-SED-412"){$pID = "344";}
			if ($tmpItemNo == "ALG-SED-416"){$pID = "345";}
			if ($tmpItemNo == "ALG-SED-508"){$pID = "346";}
			if ($tmpItemNo == "ALG-SED-521"){$pID = "347";}
			if ($tmpItemNo == "ALG-SED-601"){$pID = "348";}
			if ($tmpItemNo == "ALG-SED-602"){$pID = "349";}
			if ($tmpItemNo == "ALG-SED-921"){$pID = "231";}
			if ($tmpItemNo == "ALG-SED-922"){$pID = "232";}
			if ($tmpItemNo == "ALG-SED-923"){$pID = "233";}
			if ($tmpItemNo == "ALG-SEV-1121"){$pID = "350";}
			if ($tmpItemNo == "ALG-SEV-122"){$pID = "167";}
			if ($tmpItemNo == "ALG-SEV-1231"){$pID = "351";}
			if ($tmpItemNo == "ALG-SEV-306"){$pID = "168";}
			if ($tmpItemNo == "ALG-SEV-3211"){$pID = "352";}
			if ($tmpItemNo == "ALG-SEV-3221"){$pID = "353";}
			if ($tmpItemNo == "ALG-SEV-5211"){$pID = "354";}
			if ($tmpItemNo == "ALG-SEV-5221"){$pID = "355";}
			if ($tmpItemNo == "ALG-SEV-5231"){$pID = "356";}
			if ($tmpItemNo == "ALG-SEV-600"){$pID = "357";}
			if ($tmpItemNo == "ALG-SEV-601"){$pID = "216";}
			if ($tmpItemNo == "ALG-SEV-602"){$pID = "169";}
			if ($tmpItemNo == "ALG-SEV-701"){$pID = "217";}
			if ($tmpItemNo == "ALG-SEV-702"){$pID = "218";}
			if ($tmpItemNo == "ALG-SEV-711"){$pID = "164";}
			if ($tmpItemNo == "ALG-SEV-712"){$pID = "166";}
			if ($tmpItemNo == "ALG-SIE-931"){$pID = "262";}
			if ($tmpItemNo == "ALG-SIE-932"){$pID = "263";}
			if ($tmpItemNo == "ALG-VEN-101"){$pID = "241";}
			if ($tmpItemNo == "ALG-VEN-103"){$pID = "242";}
			if ($tmpItemNo == "ALG-VEN-120"){$pID = "243";}
			if ($tmpItemNo == "ALG-VEN-124"){$pID = "244";}
			if ($tmpItemNo == "ALG-VEN-201"){$pID = "245";}
			if ($tmpItemNo == "ALG-VEN-204"){$pID = "246";}
			if ($tmpItemNo == "ALG-VEN-305"){$pID = "358";}
			if ($tmpItemNo == "ALG-VEN-505"){$pID = "359";}
			if ($tmpItemNo == "ALG-VEN-601"){$pID = "247";}
			if ($tmpItemNo == "ALG-VEN-701"){$pID = "248";}
			if ($tmpItemNo == "ALG-VEN-702"){$pID = "249";}
			if ($tmpItemNo == "ALG-VEN-703"){$pID = "250";}
			if ($tmpItemNo == "ALG-VEN-705"){$pID = "251";}
			if ($tmpItemNo == "ALG-VEN-708"){$pID = "252";}
			if ($tmpItemNo == "ALG-126"){$pID = "365";}
			if ($tmpItemNo == "ALG-330"){$pID = "366";}
			if ($tmpItemNo == "ALG-336"){$pID = "367";}
			if ($tmpItemNo == "ALG-337"){$pID = "368";}
			if ($tmpItemNo == "ALG-715"){$pID = "369";}
			if ($tmpItemNo == "ALG-716"){$pID = "370";}
			if ($tmpItemNo == "ALG-CAR-101"){$pID = "371";}
			if ($tmpItemNo == "ALG-CAR-123"){$pID = "372";}
			if ($tmpItemNo == "ALG-CAR-126"){$pID = "373";}
			if ($tmpItemNo == "ALG-CAR-419"){$pID = "374";}
			if ($tmpItemNo == "ALG-CAR-423"){$pID = "375";}
			if ($tmpItemNo == "ALG-CAR-601"){$pID = "376";}
			if ($tmpItemNo == "ALG-CAR-602"){$pID = "377";}
			if ($tmpItemNo == "ALG-CAR-604"){$pID = "378";}
			if ($tmpItemNo == "ALG-CAR-611"){$pID = "379";}
			if ($tmpItemNo == "ALG-DON-114"){$pID = "380";}
			if ($tmpItemNo == "ALG-DON-339"){$pID = "381";}
			if ($tmpItemNo == "ALG-DON-517"){$pID = "382";}
			if ($tmpItemNo == "ALG-FEL-326"){$pID = "383";}
			if ($tmpItemNo == "ALG-FEL-327"){$pID = "384";}
			if ($tmpItemNo == "ALG-FEL-345"){$pID = "385";}
			if ($tmpItemNo == "ALG-FEL-346"){$pID = "386";}
			if ($tmpItemNo == "ALG-FEL-347"){$pID = "387";}
			if ($tmpItemNo == "ALG-FEL-420"){$pID = "388";}
			if ($tmpItemNo == "ALG-FEL-710"){$pID = "389";}
			if ($tmpItemNo == "ALG-MAD-101"){$pID = "390";}
			if ($tmpItemNo == "ALG-MAD-126"){$pID = "391";}
			if ($tmpItemNo == "ALG-MAD-420"){$pID = "392";}
			if ($tmpItemNo == "ALG-MAR-205"){$pID = "393";}
			if ($tmpItemNo == "ALG-MAR-206"){$pID = "394";}
			if ($tmpItemNo == "ALG-MAR-211"){$pID = "395";}
			if ($tmpItemNo == "ALG-MAR-305"){$pID = "396";}
			if ($tmpItemNo == "ALG-MAR-604"){$pID = "397";}
			if ($tmpItemNo == "ALG-MAR-611"){$pID = "398";}
			if ($tmpItemNo == "ALG-PAL-208"){$pID = "399";}
			if ($tmpItemNo == "ALG-PAL-209"){$pID = "400";}
			if ($tmpItemNo == "ALG-PAL-333"){$pID = "401";}
			if ($tmpItemNo == "ALG-PAL-334"){$pID = "402";}
			if ($tmpItemNo == "ALG-PAL-514"){$pID = "403";}
			if ($tmpItemNo == "ALG-PIS-101"){$pID = "404";}
			if ($tmpItemNo == "ALG-PIS-123"){$pID = "405";}
			if ($tmpItemNo == "ALG-PIS-126"){$pID = "406";}
			if ($tmpItemNo == "ALG-PIS-604"){$pID = "407";}
			if ($tmpItemNo == "ALG-PIS-611"){$pID = "408";}
			if ($tmpItemNo == "ALG-PIS-615"){$pID = "409";}
			if ($tmpItemNo == "ALG-PIS-618"){$pID = "410";}
			if ($tmpItemNo == "ALG-SEV-101"){$pID = "411";}
			if ($tmpItemNo == "ALG-SEV-126"){$pID = "412";}
			if ($tmpItemNo == "ALG-SEV-339"){$pID = "413";}
			if ($tmpItemNo == "ALG-SEV-525"){$pID = "414";}
			if ($tmpItemNo == "ALG-TUS-420"){$pID = "415";}
			if ($tmpItemNo == "ALG-TUS-422"){$pID = "416";}
			if ($tmpItemNo == "ALG-TUS-604"){$pID = "417";}
			if ($tmpItemNo == "ALG-TUS-611"){$pID = "418";}
			if ($tmpItemNo == "ALG-TUS-614"){$pID = "419";}
			if ($tmpItemNo == "ALG-VER-101"){$pID = "420";}
			if ($tmpItemNo == "ALG-VER-123"){$pID = "421";}
			if ($tmpItemNo == "ALG-VER-126"){$pID = "422";}
			if ($tmpItemNo == "ALG-VER-305"){$pID = "423";}
			if ($tmpItemNo == "ALG-VER-422"){$pID = "424";}
			if ($tmpItemNo == "ALG-VER-423"){$pID = "425";}
			if ($tmpItemNo == "ALG-VER-604"){$pID = "426";}
			if ($tmpItemNo == "ALG-VER-611"){$pID = "427";} */
			//content/data
			$thick 		="<li>Heel Height: 1<sup>3</sup>/<sub>4</sub> in</li> <li>Platform Height: 1 in</li>";
			$thin  		="<li>Heel Height: 1<sup>1</sup>/<sub>2</sub> in</li> <li>Platform Height: <sup>3</sup>/<sub>4</sub> in</li>";
			$pac  		="<li>Heel Height: 1<sup>1</sup>/<sub>2</sub> in</li> <li>Platform Height: <sup>3</sup>/<sub>4</sub> in</li>";
			
			$add_shoe 	= "<li>Extra roomy fit gives you plenty of room in the toe box.</li>";
			$add_sandal = "<li>Extra roomy fit gives you plenty of room in the toe box.</li>";
			$add_caiti 	= "<li>Buckle and side velrco closure make getting in and out a snap.</li>";
			$add_fria 	= "<li>Cozy shearling lining.</li>";
			
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
				
				echo $row['itemNo'];
			} else {
				$itemNo = $row['itemNo'];
			}
			
			if($collection == "Classic" or $collection == "Seville"){
				$type 	= "Clog";
				$add	= $add_shoe;
				$mea	= $thick;
			}else if ($collection == "Vale"){
				$type 	= "Shearling Boot";
				$add	= $add_shoe;
				$mea	= $thick;
			}else if ($collection == "Paloma"){
				$type 	= "Mary Jane";
				$add	= $add_shoe;
				$mea	= $thick;
			}else if ($collection == "Dayna" or $collection == "Debra"){
				$type 	= "Nursing Shoe";
				$add	= $add_shoe;
				$mea	= $thick;
			}else if ($collection == "Donna"){
				$type 	= "Nursing Clog";
				$add	= $add_shoe;
				$mea	= $thick;
			}else if ($collection == "Caiti"){
				$type 	= "Boot";
				$add	= $add_caiti;
				$mea	= $thin;
			}else if ($collection == "Tuscany"){
				$type 	= "Slide";
				$add	= $add_sandal;
				$mea	= $thin;
			}else if ($collection == "Madrid"){
				$type 	= "Sandal";
				$add	= $add_sandal;
				$mea	= $thick;
			}else if ($collection == "Fria"){
				$type 	= "Pac Boot";
				$add	= $add_boot;
				$mea	= $pac;
			}else if ($collection == "Feliz"){
				$type 	= "Casual Flat";
				$add	= $add_shoe;
				$mea	= $thin;
			}else {
				$type 	= "Shoe";
				$add	= $add_shoe;
				$mea	= $thick;
			}
			
			
			$des = "<ul> <li>Beautiful ".$color." Leather Upper Women's ".$type."</li>".$add."<li>Mild Rocker Outsole is engineered to reduce heel and central metatarsal pressure and the bottom is flat to increase stability.</li> <li>The footbed is loaded with cork, memory foam and latex to create a perfect fit every time by forming to the natural contours of the foot, giving each user their own customized fit. You can even insert your own custom orthodics.</li>".$mea." </ul>";
			$des ="\"".$des."\"";
			
			$mkey = "\"Alegria ".$collection." ".$color." ".$type.",".$color." ".$type.",Alegria ".$color." ".$type.",".$collection." ".$color." ".$type.",Alegria ".$collection." ".$color.",".$collection." ".$color.",".$itemNo."\"";
	
			$mdes = "Alegria ".$collection." ".$color." ".$type." ".$itemNo." by PG Lite. ".$color." Leather upper Alegria ".$collection." ".$type." with rocker outsole and removable footbed.";
			
			$line = ",P,".$itemNo.",".$collection." ".$color." ".$type.",".$color.",".$des.",0,0,0,".$row['RetailPrice'].",0,N,,3,0,0,0,N,N, ,Y,0,40,14/06/2011,14/06/2011,,,Alegria ".$collection." ".$color." ".$type." ".$itemNo." - PG Lite,".$mkey.",".$mdes.",New,".$row['upc']."\r\n";
			
		
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
				echo $line."<br><br>";
				fputs($file, $line);
			//}
		//}
		
	}
	fclose($file);
	echo "newproducts created<br>";
}


newprod_alegriashoes();
?>

