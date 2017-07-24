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
	include ("allheart.php");
	inv_allheart();
	include ("benchmark.php");
	inv_benchmark();
	
	include ("csn.php");
	inv_csn();	
	include ("lafashion.php");
	inv_lafashion();	
	
	include ("onlineshoes.php");
	inv_onlineshoes();
	include ("planetshoes.php");
	inv_planetshoes();
	//include ("shoebuy.php");
	//inv_shoebuy();
	include ("tss.php");
	inv_tss();
	include ("scrubsetc.php");
	inv_scrubsetc();

	
?>
</body>
</html>