
<?php require_once ("includes/php/checkCookie.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>Alegria Online Inventory Report</title>  
<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>
<link href="includes/css/thickbox.css" rel="stylesheet" type="text/css"/>



            
            
 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>



</head>

<body>



<div id="Container">
	
		
        
		<div id="Outer">
			<div id="Header">
				<?php include("navigation/topNav.php"); ?>
			</div>
						
		
            <div id="Wrapper">
                <div class="contentRow">
                    <div class="areaHeader" >Request Successfully Sent!</div>
                    <p style="padding-bottom:20px;">Thank you <strong><?php echo $name;?></strong> for submitting your request! 
                    <p class="errorMsg">You will receive an "Order Received" email after submitting the order. If you don't see it, check your spam folder and add noreply@alegriashoes.com to your address book.
                    </p> 
                    <p>
                    Our customer service rep will be in touch with you via email to confirm your order status and shipping dates. <br />
If you don't receive a confirmation from our customer service rep in 2 days, please call us at 1-800-468-5191 Mon - Fri 9 a.m - 5 p.m. PST. for assistance. <br /><br />
<b>*If you placed a back order, please do not call to check the status. The listed ETA is the most we can offer, if there are any changes our customer service will contact you.*</b><br /><br />

<a href="inventory.php">Click here</a> if you'd like to place another order.</p>
           			</div><!-- eof contentRow -->
                
       
        	</div><!-- eof header -->
            
        </div><!-- eof outer -->
  	
  </div><!-- eof Container -->

<?php include("includes/php/google.analytics.php"); ?>
</body>
</html>