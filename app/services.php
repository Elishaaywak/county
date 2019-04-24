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
    <h1>View Sector</h1>
  </div>
    <div data-role="panel" id="myPanel">
  <h2>Menu</h2>
  <p>
      <div data-role="controlgroup" data-type="vertical">
      <a href="index.php" class="ui-btn" data-transition="slide">Home</a>
      <a href="report.php" class="ui-btn" data-transition="slide">Report a new Event</a>
      <a href="reported.php" class="ui-btn" data-transition="slide">Reported Events</a>
      <a href="login.php" class="ui-btn" data-transition="slide">Login (Sector user/ Ward Admin)</a>
      <a href="help.php" class="ui-btn" data-transition="slide">Help & Support</a>
    </div>
      
      
      
  </p>
</div>
  <div data-role="main" class="ui-content">
  
          <?php
                                      //the url to call the json data
                                        $service_link=file_get_contents("http://www.prisconet.com/apps/county/getservice.php?serviceid=$_GET[sectorid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($service_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $serviceid = $sc["serviceid"];
                                                                $description = $sc["description"];
                                                                //into a drop down menu
                                                                ?><h3><?php echo $name;?></h3>
                                
      
    
      <strong align="center"><?php echo $description;?></strong>
      <a href="sreport.php?sectorid=<?php echo $_GET['sectorid'];?>" class="ui-btn" data-transition="slide">Report an Event in this Sector</a>
      <a href="viewreport.php?secid=<?php echo $_GET['sectorid'];?>" class="ui-btn" data-transition="slide">Reported Events in this Sector</a>
  
        <?php
                                                                }
                                       ?>
        
       </div>
       

  <div data-role="footer" data-position="fixed">
    <h1>Monitoring Service Delivery</h1>
  </div>

</div>
</body>

</html>