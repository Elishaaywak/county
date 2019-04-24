<html>
    <head>

<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="themes/county.min.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />

    </head>
    <body>
<div data-role="page">

  <div data-role="header">
      <a href="#myPanel" class="ui-btn ui-btn-inline">Menu</a>
    <h1>Reported Events</h1>
  </div>
    <div data-role="panel" id="myPanel">
  <h2>Menu</h2>
  <p>
      <div data-role="controlgroup" data-type="vertical">
      <a href="index.php" class="ui-btn" data-transition="slide">Home</a>
      <a href="report.php" class="ui-btn" data-transition="slide">Report a new Event</a>
      <a href="login.php" class="ui-btn" data-transition="slide">Login (Sector user/ Ward Admin)</a>
      <a href="help.php" class="ui-btn" data-transition="slide">Help & Support</a>
    </div>
      
      
      
  </p>
</div>
  <div data-role="main" class="ui-content">
    <p>Select the Sector/Ward to view the reported events</p>
  
        <div data-role="collapsible">
            <h1>Sectors</h1>
            <p>
                <?php
                                      //the url to call the json data
                                        $service_link=file_get_contents("http://www.prisconet.com/apps/county/getservice.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($service_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $serviceid = $sc["serviceid"];
                                                                //into a drop down menu
                                                                ?><a href="services.php?sectorid=<?php echo $serviceid;?>"  data-transition="slide"><?php echo $name;?></a><br/><hr/><?php
                                                                }
                                       ?>
                                
            </p>
        </div>
        
        <div data-role="collapsible">
            <h1>Wards</h1>
            <p>
                <?php
                        //the url to call the json data
                                        $wards_link=file_get_contents("http://www.prisconet.com/apps/county/getward.php?");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($wards_link,true);
                                        
                                        foreach ($data as $wd) {
                                                                $ward_name = $wd["name"];
                                                                $wardid = $wd["wardid"];
                                                                ?><a href="wardreport.php?wardid=<?php echo $wardid;?>"><?php
                                                               echo "<b>$ward_name</b></a><br/><hr/>";
                                                                }
                    ?>
                    
            </p>
        </div>
        <div data-role="collapsible">
            <h1>All Reported Events</h1>
            <p><a href="http://www.prisconet.com/apps/county/convert.php" target="_blank">View All Reported Events</a></p>
  </div>

  <div data-role="footer" data-position="fixed">
    <h1>Monitoring Service Delivery</h1>
  </div>

</div>
</body>

</html>