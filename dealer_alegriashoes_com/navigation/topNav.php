<div id="logo"><a href="http://dealer.alegriashoes.com/"><img src="http://assets.alegriashoes.com/images/logo_dealer.gif" border="0" /></a></div>
<div id="sitename">Dealer Center</div>

<?php if (isset($_COOKIE['ID_my_site'])) {  ?>
<div id="SideCategoryList">
<ul>
	<li>
		<a href="#" style="padding-bottom:5px"><img src="http://dealer.alegriashoes.com/images/btn_navDown.gif" 
		border="0" style="float:left;padding-right:5px;padding-bottom:10px"/> Alegria Tools</a>
    	<ul style="padding:15px">
            <li><a href="inventory.php"target="_self" >Inventory Ordering</a></li>
            <li><a href="https://www.dropbox.com/sh/hr0hn9zpmcl8iv4/AAACdanmQx5x7-Hsfm7D331ba?dl=0" target="_blank"><b>Marketing Support</b></a></li>
            <li><a href="store-locator-request.php"target="_self" >Store Locator Request</a></li>
            <li><a href="mailto:benjamin@peppergate.com">Support</a></li>
        </ul>
     </li>
</ul>
</div>

<!--div class="linkBox">
	>> <a href="entry/entryForm.php" target="_self">add new product</a>
</div>
<div class="linkBox">		
		>> <a href="edit/editForm.php"target="_self" >modify existing product</a>
</div-->
<div id="logout"><a href="logout.php">logout, <?php echo $username; ?></a></div>
<?php } ?>