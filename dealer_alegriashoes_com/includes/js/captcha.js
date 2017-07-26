$("#refreshimg").live("click",function(){

		$.post('includes/php/newsession.php');
		$("#captchaimage").load('includes/php/image_req.php');
		return false;
         
		alert("clicked"); 
	});

