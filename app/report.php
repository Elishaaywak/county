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
 <style>
    div#gmap {
      
        height: 500px;
        border:double;
 }
    </style>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAA6UsI3A8Y5gA70h2LMKCKFyXOMq9VE8w"></script>
    
    <script type="text/javascript">
         var map;
        function initialize() {
            var myLatlng = new google.maps.LatLng(-1.25826,36.79699);
            var myOptions = {
                zoom:12,
                center: myLatlng,
                mapTypeId: 'roadmap'
            };
            map = new google.maps.Map(document.getElementById("gmap"), myOptions);
            // marker refers to a global variable
            marker = new google.maps.Marker({
                position: myLatlng,
                map: map
            });
            



            google.maps.event.addListener(map, "click", function(event) {
                // get lat/lon of click
                var clickLat = event.latLng.lat();
                var clickLon = event.latLng.lng();

                // show in input box
                document.getElementById("lat").value = clickLat.toFixed(5);
                document.getElementById("lon").value = clickLon.toFixed(5);

                  var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(clickLat,clickLon),
                        map: map
                     });
            });
            $("#reportj").on("shown.bs.modal", function () {
            google.maps.event.trigger(map, "resize");
            map.setCenter(MyLatLng);
});
    }   

    window.onload = function () { initialize() };
    </script>
   

    </head>
    <body>
<div data-role="page">

  <div data-role="header">
      <a href="#myPanel" class="ui-btn ui-btn-inline">Menu</a>
    <h1>Report a new Event</h1>
  </div>
    <div data-role="panel" id="myPanel">
  <h2>Menu</h2>
  <p>
      <div data-role="controlgroup" data-type="vertical">
      <a href="index.php" class="ui-btn" data-transition="slide">Home</a>
      <a href="reported.php" class="ui-btn" data-transition="slide">Reported Events</a>
      <a href="login.php" class="ui-btn" data-transition="slide">Login (Sector user/ Ward Admin)</a>
      <a href="help.php" class="ui-btn" data-transition="slide">Help & Support</a>
    </div>
      
      
      
  </p>
</div>
  <div data-role="main" class="ui-content">
    <p>Fill in the form below to report a new event</p>
    <form action="newreport.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label for="email">Name:</label>
                                      <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Email:</label>
                                      <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Telephone</label>
                                      <input type="text" class="form-control" id="telephone" name="telephone">
                                    </div>
                                     <div class="form-group">
                                      <label for="Ward">Ward:</label>
                                    <select class="form-control" id="ward" name="wardid">
                                       <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getward.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $wardid = $sc["wardid"];
                                                                //into a drop down menu
                                                                ?><option value="<?php echo $wardid;?>"><?php echo $name;?></option><?php
                                                                }

                                       ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="service">Service/Sector:</label>
                                    <select class="form-control" id="service" name="serviceid">
                                       <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getservice.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $serviceid = $sc["serviceid"];
                                                                //into a drop down menu
                                                                ?><option value="<?php echo $serviceid;?>"><?php echo $name;?></option><?php
                                                                }

                                       ?>                                      
                                       </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Report</label>
                                      <textarea class="form-control" id="report" name="report" required></textarea>
                                    </div>
                                     <div class="form-group">
                                        <label for="nearest">Nearest School/Hospital/ Shopping center</label>
                                        <input type="text" class="form-control" name="nearest" id="nearest" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="Location">Select the exact location</label>
                                    </div>
                                    <div id="gmap"></div>
                                    <div class="form-group">
                                      <label for="File">Picture/Video</label>
                                      <input type="file" class="form-control" id="file" name="file">
                                    </div>
                                    <div class="form-group" hidden>
                                      <label for="Lat">Latitude</label>
                                      <input type="text" class="form-control" id="lat" name="lat">
                                    </div>
                                       <div class="form-group" hidden>
                                      <label for="Lat">Longitude</label>
                                      <input type="text" class="form-control" id="lon" name="lon">
                                    </div>
                                    
                                    <div class="form-group">
                                     <button type="submit" class="btn btn-success">Report</button>
                                    </div>
                                </form>    
  
    
  </div>

  <div data-role="footer" data-position="fixed">
    <h1>Monitoring Service Delivery</h1>
  </div>

</div>
</body>

</html>