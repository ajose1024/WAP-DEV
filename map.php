<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>MetalStone - Mapa de Localização</title>
 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAXrK-rannU6gHtnTqJsng2xR1AKUvRvebKXmN07sT4GfgDU_FtBRM4bdannBIJFN8D5ZjhSnaQ9rQdA"
      type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

 var WINDOW_HTML = '<div style="width: 210px; padding-right: 10px"><a href="./signup.html">Sign up</a> for a Google Maps API key, or <a href="./documentation/">read more about the API</a>.</div>';

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        map.setCenter(new GLatLng(38.733766,-9.144681), 17);
		
		

        // Create our "tiny" marker icon
        var icon = new GIcon();
        icon.image = "images/icon.png";
        icon.shadow = "";
       icon.iconSize = new GSize(120, 40);
        icon.shadowSize = new GSize(48, 33);
        icon.iconAnchor = new GPoint(70, -70);
        icon.infoWindowAnchor = new GPoint(5,1);

        // Add markers to the map at specified location
      var point = new GLatLng(38.733766,-9.144681);
    //  var marker = createMarker(point,'Some stuff to display in the<br>First Info Window','white','A')
      map.addOverlay(new GMarker(point, icon));
	  

	  

      }
    }

   
    //]]>
    </script>
    <style type="text/css">
<!--
.style1 {
	font-size: 9px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #999999;
}
a:link {
	color: #999999;
	text-decoration: underline;
}
a:visited {
	text-decoration: underline;
	color: #999999;
}
a:hover {
	text-decoration: none;
	color: #999999;
}
a:active {
	text-decoration: underline;
	color: #999999;
}
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
}
body {
	margin-left: 10px;
	margin-top: 30px;
	margin-right: 10px;
	margin-bottom: 10px;
}
-->
    </style>
</head>
<body onload="load()" onunload="GUnload()">
    
  <div style=" background-image:url(img/map_bg.gif); width: 550px; height:450px;background-repeat:no-repeat; background-position:bottom;">

  <div id="map" style="width: 500px; height: 400px; margin:0 auto;"></div
  >
  <table width="473" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="209" valign="middle"><br />
      <img src="images/logo.jpg" alt="Pinholandia" /></td>
      <td width="264" valign="top"><p class="style1"><br />
          <br />
          <span style="line-height:15px"><font class="FontVerdana10BlueBold"><strong>Metalstone </strong></font><br />
           </span><span style="line-height:15px">Ed. Atrium Saldanha <br />
           Praça Duque de Saldanha </span>nº1 10 <br />
        </p>
      </td>
    </tr>
  </table>
  <br />
  
  <div align="center"><a href="javascript:window.close();"><br />
    fechar</a></div>
  </div>
</body>
</html>









