<div id="logo"><a href="http://sales.alegriashoes.com/"><img src="http://assets.alegriashoes.com/images/logo_dealer.gif" border="0" /></a></div>
<div id="sitename">Sales Center</div>

<?php if (isset($_COOKIE['ID_sales'])) {  ?>
<div id="SideCategoryList">


<ul>
	
	<li class=""><a href="#"><img src="http://dealer.alegriashoes.com/images/btn_navDown.gif" border="0"/></a>
    	<ul>
            <li><a href="index.php" target="_self">Invoice Report</a></li>
            <li><a href="ats_report.php" target="_self">Available to Sell</a></li>
            <li><a href="marketing_request.php" target="_self">Marketing Request Form</a></li>
            <li><br /></li>
            <li><a href="customer_year.php"target="_self" >Year Over Year Account Snapshot <small><i>*new*</i></small></a></li>
            <li><a href="sales.php"target="_self" >Year To Date Sales Report</a></li>
            <?php 
            $lastYear = date("Y") - 1;
            for ($i = $lastYear; $i >= 2010; $i--) { 
                echo '<li><a href="sales_archive.php?y='.$i.'" >'.$i.' Sales Report</a></li>';
            }
            ?>

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
<div id="logout"><span>Welcome back, <?php echo $currentUser ?>. </span><a href="logout.php">logout</a></div>
<?php } ?>