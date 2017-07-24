



<script type="text/javascript">	
			$(function(){
				  $('input').daterangepicker({presetRanges: [
						{text: 'Today', dateStart: 'Today', dateEnd: 'Today' },
						{text: 'Last 7 days', dateStart: 'Last <?php echo date("l") ?>', dateEnd: 'Today' },
						{text: 'Month to date', dateStart: '<?php echo date("n") ?>/1/<?php echo date("y")?>', dateEnd: 'Today' }
					], 
presets:{specificDate:'Specific Date',dateRange:'Date Range'},arrows:false, onClose:function(){}}); 
			 });//$('#range').submit();
</script>

</head>

<body>
<center>
<div style="width:400px;height:200px;padding-top:100px;text-algin:center;">Alegria Sales Center is currently under maintenance.<br> We apologize for the inconvenience.</div> 
<?php include("includes/php/google.analytics.php"); ?>
</center>
</body>

</html>
