<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="http://dealer.alegriashoes.com/">
				<img src="http://assets.alegriashoes.com/images/logo_dealer.gif" border="0" />
			</a>
		</div>

	<?php if (isset($_COOKIE['ID_my_site'])) {  ?>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
			<h3>Dealer Center</h3>
	            <li><a href="index.php" target="_self">Assets Download</a></li>
	            <li><a href="store-locator-request.php"target="_self" >Store Locator</a></li>
	            <li><a href="inventory.php"target="_self" >Online Order</a></li>
				<li><a href="logout.php">logout</a></li>
	        </ul>
		</div>

	<?php } ?>

	</div>
</nav>