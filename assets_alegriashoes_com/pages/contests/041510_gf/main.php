<? 
session_start(); //Do not remove this
//only assign a new timestamp if the session variable is empty
if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key'])==0){
    $_SESSION['random_key'] = strtotime(date('Y-m-d H:i:s')); //assign the timestamp to the session variable
	$_SESSION['user_file_ext']= "";
}

$imgPath = "http://assets.alegriashoes.com/images/contests/041510_gf/";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
  
<title></title>  
    
<style type="text/css">
body{margin:0;padding:0;font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;font-size:12px;color:#666;}

#content{background:url(<?= $imgPath ?>bg_contests_041510_gf.gif) repeat-y; width:984px;height:780px;}<!-- 1250 height -->

#content a{color:#ee2375;text-decoration:underline;}
#content a:hover{color:#FFF;text-decoration:none;background:#ee2375;}
#content a.NoBg:hover{background:none;}

.FloatLeft{float:left;}
.FloatNone{float:none;}
.Wider{width:470px;}
.Wide{width:230px;}
p{font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;font-size:11px;padding:0 0 10px 0;margin:0;}
#catalogAddress label{width:200px;}

#ContestMarketing{}
#ContestForm{text-align:left;display:table;}
#ContestContext{width:385px;position:absolute;top:270px;left:8px;}
#ContestContext h3{padding:10px 0 0 0;margin:0;}
#ContestContext p{}

#contact-wrapper {
	font-family:Arial, Helvetica, sans-serif;
	width:745px;
	background:#f1f1f1;
	text-align:left;
	height:auto;
	display:table;
	margin-left:110px;
	padding:0 0 0 20px;
}

</style>    

</head>

<body>


<div id="content">
	
	
        <div class="FloatNone" id="ContestMarketing"> 
            <img src="<?= $imgPath ?>main_contests_041510gf.png" />
            </div>
          <div id="ContestContext">
                		
            <h3>Instructions</h3>
                    <p>Upload a photo to our website or Share a photo on FaceBook of yourself 
            showing how you wear your favorite Alegria's. </p>
                    
                    <p>Briefly describe your favorite Alegria moment or a fun adventure you <br />
                      have had wearing Alegria's. You could be playing with the kids, <br />
            			walking your dog, heading into the office, at work or on vacation. </p>
                    
            <h3>Prizes</h3>
                    <p>1 finalist to win a 4 Day/3 Night Trip to Canyon Ranch Miami <br />
					Beach Hotel and Spa in Miami, FL. including Airfare, food,<br />
                    $100 Spa Cert., plus unlimited access to over 30<br /> 
                    lectures and classes. Valued at $2500.</p>
                    
            <p>5 other lucky winners will get a free pair of <br />
              Alegria shoes and be featured on the Alegria <br />
              website and our facebook fan page.</p>
              <p><img src="<?= $imgPath ?>logo_canyonranch.gif" /></p>
                                    
          
        </div>	
<div class="FloatNone"  id="ContestForm" style="text-align:center;"> 
		<!-- ?php include("form.php");? -->
    <div id="contact-wrapper" style="text-align:center;">
      <h2>Grand Prize Winner: Bernadette Wilkerson.<br />
<br />
5 winners of a pair of Alegria Shoes: Kristine Moffett, Kristin Hill, Danielle Gerstenberger, Carrie Lafrate, and Beth Langston .<br />
<br />
Winners please contact us via email at info@alegrishoes.com. We will follow up with details to claim your prizes. 
</h2>
        <a href="http://www.facebook.com/alegriashoes" target="_parent">Click here</a> to go to Alegria's facebook page<br />
and fan us to receive exclusive news, contests, sneak peeks and more. <br />
<br />
	</div>

</div>	
</div>

</body>
</html>