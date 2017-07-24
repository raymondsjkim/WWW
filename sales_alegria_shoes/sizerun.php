<?php include("navigation/headerHTML.php"); ?>

<?php

$query_sizerun = "SELECT prod_cd,
					SZR_QTY1,
					SZR_QTY2,
					SZR_QTY3,
					SZR_QTY4,
					SZR_QTY5,
					SZR_QTY6,
					SZR_QTY7,
					SZR_QTY8,
					SZR_QTY9,
					SZR_QTY10
				   FROM inv_data
				   WHERE class_cd = 'ALG7'
				   ORDER BY prod_cd asc";

$sizerun = mssql_query($query_sizerun, $mslinkID);

while ($data = mssql_fetch_assoc($sizerun)) {
echo '<pre>'; print_r($data); echo '</pre>';
}

?>