<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
  
<title></title>  



<script language="javascript" type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAElnumKMuEjmiYT-V6RBWYxSfNkTDTEyXyQq94ydhE0J2Y0V9vRRDw64wt2wbwJDQrkC4bVBViPtZeg"
      ></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="../includes/js/locator.js"></script>


<style type="text/css">
body{margin:0;padding:0;font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;font-size:12px;}
#DLcontainer{width:985px;height:560px;text-align:left;}
#searchHeader{height:110px;float:left;width:580px;padding:10px;color:#666;}
#searchHeader p{font-size:13px;padding:10px 0 0 0;margin:0;}
#searchHeader p a{color:#ee2375;}
#searchHeader p a:hover{color:#FFF;text-decoration:none;background:#ee2375;}
#searchForm{height:110px;line-height:160%;color:#666;float:left;width:330px;padding:10px;}
#addressInput{width:250px;}
#inputSearch{margin-top:10px;}
.marker{font-size:12px;width:175px;color:#000;}

#sidebar{background-image:url(http://assets.alegriashoes.com/images/bg_store_locator.jpg);background-repeat:no-repeat;}/**/
#sidebar div{width:175px;height:65px;float:left;padding:0px 5px;}
</style>
</head>
<body onLoad="load()" onUnload="GUnload()">
<div id="DLcontainer">
  
    <table width="970">
      <tbody>
        <tr>
        	<td colspan="2" bgcolor="#f0f0f0">

            <div id="searchForm">  
                <strong>Address</strong> or <strong>Zip Code</strong>:<br>

              <input name="text" type="text" id="addressInput" width="200"/>
                <br />
              
                <strong>Radius</strong>:
              <select name="select" id="radiusSelect">
                  <option value="25" selected>25</option>
                  <option value="100">100</option>
                  <option value="200">200</option>
                </select>
               
              <br/>
                <input id="inputSearch" name="button" type="button" onClick="searchLocations()" value="Search Locations"/>
            </div>
            <div id="searchHeader">
              Get Happy! Shop <a href="http://www.alegriashoes.com/new/">ONLINE</a></span> now! 
              <br /><br /> 
              <p>
              Alegria shoes are available for sale at many fine retailers across the country. 
              To find a local store near you, enter your address or zip code to the left. 
              </p>
              <br /><br /> 
              Out of the United States? See our <a href="http://www.alegriashoes.com/pages/International-Dealers.html">International Dealer</a> page.
            </div>
            </td>
        </tr>
        <tr>
        	<td colspan="2" height="10"></td>
        </tr>
        <tr id="cm_mapTR">
          
          <td width="400" valign="top">
            <div id="sidebar" style="overflow: auto; height: 405px; font-size: 11px; color: #000"></div>
          </td>
          <td>
            <div id="map" style="overflow: hidden; width:570px; height:405px"></div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


  </body>
  </html>