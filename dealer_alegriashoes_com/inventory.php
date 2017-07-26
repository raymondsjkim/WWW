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
<style type="text/css">



#contact-wrapper {
	font-family:Arial, Helvetica, sans-serif;
	width:730px;
	
	position:relative;
	top:0px;
	padding:0px 0px 10px 0px;
	text-align:left;
}
#contact-wrapper p.error{
	color:#DD0000;
	font-size:12px;
	line-height:140%;
}
#contact-wrapper p.confirm{
	color:#ee2375;
	font-size:12px;
	line-height:140%;
}
#contact-wrapper form{
	width:750px;
}
#contact-wrapper div {
	
	margin:1em 0;
}
#contact-wrapper label {
	display:block;
	float:none;
	font-size:13px;
	width:auto;
	color:#666;
}
form#contactform{
    
	width:700px;
}
form#contactform input {
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	font-family:Arial, Helvetica, sans-serif;
	border-style:solid;
	border-width:1px;
	padding:4px;
	font-size:13px;
	color:#333;
	width:260px;
}
form#contactform textarea {
	font-family:Arial, Helvetica, sans-serif;
	font-size:100%;
	padding:4px;
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	border-style:solid;
	border-width:1px;
	width:260px;
	font-size:13px;
}
form#contactform select {
	font-size:12px;
	padding:3px;
}

form#contactform label.error {
	color:#DD0000;
	padding-top:3px;
	font-size:11px;
}
form#contactform input.error, 
form#contactform textarea.error{
	
	border:1px solid #DD0000;
}

#contact-wrapper div.catalogCol {
	
	margin-top:0px;
}
#catalogAddress label{width:300px;}

#catalogAddress div input{width:300px;}

input#submit{width:140px;height:30px;padding:0;margin:0;background:#4787ed;color:#FFF;font-weight:bold;font-size:13px;font-weight:bold;line-height:120%;}
input#reset{width:60px;height:30px;padding:0;margin-left:10px;background:#999;color:#FFF;font-weight:bold;font-size:13px;line-height:120%;}

.contentRow .areaHeader{margin-top: 10px;padding-top: 10px;}

/*a {  outline: thin dashed firebrick ! important;  background-color: rgb(255, 200, 200) ! important; }*/

#inventorytable{width:730px;}
#inventorytable td{padding:5px;}
#inventorytable td.column1{width:190px;}
#inventorytable td.title{width:55px;float:left;}

#inventorytable td .size, #inventorytable td .stock, #inventorytable td .qty {float:none;height:15px;font-weight:bold;vertical-align:middle;}
.odd{background:#dfdfdf;}
.GreyOut{color:#9e9e9e;}

#inventorytable select{width:45px;}

#floatMenu {
		float:right;
		position:relative;
		width:235px;
		padding:10px 5px 15px 5px;
		background:#dfdfdf;
}
#floatMenu h3{padding:0;margin:0;padding-bottom:15px;}

.Inventory .contentRow{width:100%;}

#loading{height:100%;width:100%;position:absolute;z-index:9999;background:#FFF;filter:alpha(opacity=60);
  /* CSS3 standard */
  opacity:0.6;vertical-align:middle;display:table;
}
#loading #loadingContainer{position:absolute;top:44%;left:40%;width:auto;text-align:center;font-size:13px;color:#000;}
#loading img{padding-bottom:5px;}

.spacer{display:block;height:20px;}

#orderReview{
height: 40px;
width: 100%;
position: absolute;
bottom: 0px;
background-color: #272727;
}

html>body #orderReview{position:fixed}/* for moz/opera and others*/

#orderReviewContainer{width:985px;text-align:left;padding-top:5px;}
#orderReviewContainer .left{color:#FFF;font-weight:bold;font-size:14px;float:left;}

#orderReviewContainer .right{float:right;}

#review div{border-bottom:1px solid #bbb;height:12px;display:block;}

.itemQty, .itemid, .x{float:left;}
.itemid{width:110px;}
.itemQty{width:20px;}
.x{padding:0px 3px;}

.itemTotal, .dollarSign{float:left;}
.dollarSign{}
.itemTotal{}
.unitprice{display:none;}
.remove{float:right;font-size:11px;}
.remove a:link, .remove a:visited{color:#666;text-decoration:underline;}
.remove a:hover, .remove a:active{color:#666;text-decoration:none;}

#review div{line-height:140%;padding:0;margin:0;padding-bottom:8px;clear:both;}
img.tn {padding-right:5px;}
.color{color:#999999;font-size:11px;float:none;clear:both;}
.eta, .dcon{font-size:11px;float:none;clear:both;line-height:200%;color:#FF0000;}

.style1 {color: #FF0000;font-weight:bold;}
</style>


            
            
  <?php
  
  
   require("includes/resource/db.php");
  
  

?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="includes/js/jquery.validate.pack.js" type="text/javascript"></script>
<script src="includes/js/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>
<script src="includes/js/jquery.dimensions.js" type="text/javascript"></script>
<script src="includes/js/thickbox.js" type="text/javascript" language="javascript" ></script>
<script src="includes/js/jquery.tooltip.min.js" type="text/javascript" language="javascript" ></script>
<script language="javascript">
	var name = "#floatMenu";
	var menuYloc = null;
	
	
		$(document).ready(function(){
			menuYloc = parseInt($(name).css("top").substring(0,$(name).css("top").indexOf("px")))
			
			$(window).scroll(function () { 
				var position = $(name).position();
				//alert (position.top);
				
				if ($(document).scrollTop() >= 225){
					offset = $(document).scrollTop() - 230 +"px";
					$(name).animate({top:offset},{duration:500,queue:false});
				} else {
					$(name).animate({top:"0px"},{duration:500,queue:false});
					}
			});
		}); 
	 </script>

<script type="text/javascript">



function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

$(document).ready(function(){
	
	$('#loading').fadeOut('slow', function() {
    // Animation complete.
  });

	//$(".qtyselect").change(function(){ 
	$(".qtyselect").live("change", function(){ 
	
		if (readCookie('ID_my_site') == null){
						
			window.location = "login.php"
 
							
		} else {
			var htmlStr = $('#review').html();
			
			//$(".itemid").contains(this.id);
			var tmp = "#p_"+this.id;
			
			
			
			 if ($(tmp).length){
					var tmpVal = $(this).val();	
					
					var selectedSKU = "#" + $(this).closest("tr").attr("id")+ " .wholesale";
					
					if (tmpVal == "-"){
						$(tmp).replaceWith("");
					} else {
						 
						$(tmp).replaceWith("<div id='p_" + this.id + "'><span class='itemContainer'><span class='itemid'>"+this.id + "</span><span class='x'> x </span><span class='itemQty'>"+ tmpVal + "</span></span><span class='unitprice'>$"+Number($(selectedSKU).text())+"</span><span class='dollarSign'>$</span><span class='itemTotal'>"+ Number($(selectedSKU).text())*tmpVal +"</span><span class='remove'><a href='javascript:void(0)'>Remove</a></span></div>");
					}
	//
			 } else {
					var tmpVal = $(this).val();
					
					var selectedSKU = "#" + $(this).closest("tr").attr("id")+ " .wholesale";
					//alert( Number($(selectedSKU).text())*tmpVal );
					
					
					if ( tmpVal != "-"){
					
						$('#review').html(htmlStr+"<div id='p_" + this.id + "'><span class='itemContainer'><span class='itemid'>"+this.id + "</span><span class='x'> x </span><span class='itemQty'>"+ tmpVal + "</span></span><span class='unitprice'>$"+Number($(selectedSKU).text())+"</span><span class='dollarSign'>$</span><span class='itemTotal'>"+ Number($(selectedSKU).text())*tmpVal +"</span><span class='remove'><a href='javascript:void(0)'>Remove</a></span></div>");
					}
	//<span class='dollarSign'>$</span><span class='itemTotal'>"+ Number($(selectedSKU).text())*tmpVal +"</span>
			}
			$(".remove").click(function () { 
			
			
					$(this).parent().remove();
					
					var str = $(this).parent().attr("id");
					var substr = str.split('_');
					// substr[0] contains "something"
					// substr[1] contains "something_else"
					
					
					var tmpsel = "#"+substr[1]+"_"+substr[2];
					$(tmpsel).val('-'); 
			
			});
		}
	}); 

	

});
</script>
</head>

<body>

<div id="loading"><span id="loadingContainer"><img src="images/25.gif" /><br />
It may take 1-2 mins to<br />
load Current Inventory Data.<br />
Please wait patientaly.</span></div>

<div id="Container" class="Inventory">
	
		
        
		<div id="Outer">
			<div id="Header">
				<?php include("navigation/topNav.php"); ?>
			</div>
						
		
            <div id="Wrapper">
                <div class="contentRow">
                    <div class="areaHeader" >Online Inventory Report & Ordering</div>
                    <p style="padding-bottom:20px;">Inventory updates daily at <strong>8 p.m. PST.</strong> Use the Shortcuts located at the bottom of the page to get to the product faster. Out of stock items/sizes are greyed out, but those with backorder capability can be processed in your order. You may want to call us to verify stock count if it is below 5. Call us at 1-800-468-5191 Mon - Fri 9 a.m - 5 p.m. PST. Review your order detail in the "Order Review" box to your right. <strong>Press the "Continue" button</strong> at the bottom of the page to continue. A window will open and you can submit the order after you fill out your information. <br />
<br />
<span class="style1">You will receive an "Order Received" email after submitting the order. If you don't see it, check your spam folder and add noreply@alegriashoes.com to your address book. </span><br />
<br />

Our sales rep will contact you to follow up on your order. If you need technical assistance, please email <a href="mailto:benjamin@peppergate.com">support</a>.

</p>
           			</div>
                
           <div id="floatMenu">
           		<h3>Order Review</h3>
                
                <div id="review"></div>
          
          </div>
                
                
                
				<div id="contact-wrapper">
	
	<?php if(isset($hasError)) { //If errors are found ?>
		<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
	<?php } ?>

	<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
		<p class="confirm"><strong>Request Successfully Sent!</strong><br>
		Thank you <strong><?php echo $name;?></strong> for submitting your request! We will process your information shortly.</p>
	<?php } ?>

	
		<!-- div>
			<label for="subject"><strong>Choose a Subject *</strong></label>
		    <select name="subject" id="subject">
              <option value='1'>General Question</option>
              <option value='2'>Product Inquiry</option>
              <option value='3'>Order Assistance</option>
              <option value='4'>Feedback</option>
            </select>
		</div -->
        
       
    <?php include("inventory_form.php"); ?>
    
    <!-- p class="style1">Apologize, the inventory report is temporarily down for maintenance. Please check back again soon.</p -->

    
  <div>*Estimated Time of Arrival is provided to our best knowledge. We will update this infomration as soon we receive further updates. Please contact our office if you have further questions.</div>
  <div class="spacer"></div>
  

  
						</div><!-- EOD contact-wrapper -->
				</div><!-- EOF Wrapper -->
 		</div><!-- EOf Outer -->
 </div><!-- EOf Container -->
 
 
    <div id="orderReview" align="center">
	  <div id="orderReviewContainer" align="left">
        		<span class="left">Shortcut:
   		  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
          			<option value="">Select a Style</option>
            <?php foreach ($idArray as $value){  
            
            		echo "<option value='#".$value."'>".$value."</option>";
					
					}
            ?>        
          </select>	
<!--          		-or-
              <select name="jumpMenu2" id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)">
                <option>Select a Collection</option>
                <option value="#ALG-101">Classic</option>
                <option value="#ALG-ASP-6116">Aspen</option>
                <option value="#ALG-BAR-102">Barcelona</option>
                <option value="#ALG-DEB-600">Debra</option>
                <option value="#ALG-DON-314">Donna</option>
                <option value="#ALG-FEL-101">Feliz</option>
                <option value="#ALG-MIL-101">Milano</option>
                <option value="#ALG-PAL-101">Paloma</option>
                <option value="#ALG-POR-101">Porto</option>
                <option value="#ALG-SED-205">Sedona</option>
                <option value="#ALG-SEV-1121">Seville</option>
                <option value="#ALG-SIE-932">Sierra</option>
                <option value="#ALG-VEN-101">Venice</option>
              </select> -->
           
          
        	</span>
            <span class="right">
        <input id="reset" type="reset" value="Reset" name="reset" />&nbsp;&nbsp;<input id="submit" type="submit" value="CONTINUE" name="submit" onclick="submitorder()" />
	     	</span>
		<script type="text/javascript">
				

				function readCookie(name) {
				
					var cookiename = name + "=";
				
					var ca = document.cookie.split(';');
				
					for(var i=0;i < ca.length;i++)
					{
				
						var c = ca[i];
				
						while (c.charAt(0)==' ') c = c.substring(1,c.length);
				
						if (c.indexOf(cookiename) == 0) return c.substring(cookiename.length,c.length);
				
					}
				
					return null;
				}
				
				


		
                $("#reset").click(function(){
                    $('.qtyselect').val('-'); 
					$('#review').replaceWith("<div id='review'></div>");
                });
				
				function submitorder(){
					//alert ("submit clicked");
					if ( $('#review div').length == 0) {
						alert ("Please select a product before proceed to the next step");
					} else {
					    
						if (readCookie('ID_my_site') == null){
						
							window.location = "login.php"
 
							
						} else {
						
							totalQty = 0;
							
							$('.itemQty').each(function() {
								totalQty += Number($(this).text());
							});
							
							totalAmt = 0;
							
							$('.itemTotal').each(function() {
								totalAmt += Number($(this).text());
							});
							
							
						   
							tb_show('Enter Dealer Info and Submit Order', 'inventory_submit.php?keepThis=true&q='+$('#review').text()+'&totalQty='+totalQty+'&totalAmt='+totalAmt+'TB_iframe=true&height=500&width=600');
						}
					}
				}
				$(document).ready(function(){
						$('.color').each(function(){
							$(this).html($(this).html().replace(/Alegria/ig, ""));
						});
				
				
				});
            </script>
        
            
        </div>
  	
  </div>

<?php include("includes/php/google.analytics.php"); ?>
</body>
</html>