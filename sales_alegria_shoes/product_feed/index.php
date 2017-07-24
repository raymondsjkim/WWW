<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">

<title>Alegria Sales Center</title>
</head>
<body>
<?	
	//include ("csvimport.php");
	include ("update-db.php");
	update_db();
	include ("alegriashoes.php");
	inv_alegriashoes();
	include ("alegriashoes_com.php");
	inv_alegriashoes_com();
	include ("allheart.php");
	inv_allheart();
	include ("benchmark.php");
	inv_benchmark();
	
	include ("csn.php");
	inv_csn();	
	
	include ("lafashion.php");
	inv_lafashion();	
	
	include ("onlineshoes.php");
	// inv_onlineshoes();
	include ("planetshoes.php");
	inv_planetshoes();
	
	include ("tss.php");
	inv_tss();
	include ("scrubsetc.php");
	inv_scrubsetc();

	include ("cowboy.php");
	inv_cowboy();
	include ("lifeuniform.php");
	inv_lifeuniform();
	include ("shoebacca.php");
	inv_shoebacca();
	include ("shoebacca2.php");
	inv_shoebacca2();
	include ("shoebuy.php");
	inv_shoebuy();
	include ("3point5.php");
	inv_3point5();
	include ("outdoor_equipped.php");
	inv_outdoor_equipped();
	include ("rnshoes.php");
	inv_rnshoes();
	include ("vendornet.php");
	inv_vendornet();
	include ("shoeAndCo.php");
	inv_shoeAndCo();
	include ("mossers.php");
	inv_mossers();
	include ("dsco-nordstrom.php");
	// Alredy had inv_dscoNordstrom included in file
	include ("alamoshoes.php");
	inv_alamoshoes();
	include ("rockybrands.php");
	inv_rockybrands();
?>
</body>
</html>