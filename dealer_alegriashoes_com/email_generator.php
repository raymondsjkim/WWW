<?php

$i = 0;
$x = 0;
$number = '1';

while ($x <= 15) {

echo $number.". ";	
echo "<br>";
for ($i=0; $i < 5; $i++) { 
	$rand = substr(md5(microtime()),rand(0,26),8);
	$rand2 = substr(md5(microtime()),rand(0,26),5);
	echo $rand."@hotmail.com, ";
}
echo "</br>";

$number ++;
$x ++;
}

?>