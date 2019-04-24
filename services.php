<?php
session_start();
//check if the session is set
if (!isset($_SESSION['adminid']))
{
    //header("Location:alogin.php");
}
require 'db.inc.php';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Monitoring Service Delivery in County Government</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
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
            $("#report").on("shown.bs.modal", function () {
            google.maps.event.trigger(map, "resize");
            map.setCenter(MyLatLng);
});
    }   

    window.onload = function () { initialize() };
    </script>
    
</head>
<body>
    <div>
        <nav class="navbar navbar-inverse navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SOMS
                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        
                        
                        <li>
                           <a data-toggle="modal" href="#search">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        
                        <li>
                            <a href="index.php" >
                               Home
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Services
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <?php
                                      //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getservice.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $serviceid = $sc["serviceid"];
                                                                //into a drop down menu
                                                                ?><li><a href="services.php?sectorid=<?php echo $serviceid;?>"><?php echo $name;?></a></li><?php
                                                                }
                                       ?>
                                
                                <li class="divider"></li>
                                
                              </ul>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Reported Events (Per Sub-county)
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getsubcounty.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $subcountyid = $sc["subcountyid"];
                                                                //into a drop down menu
                                                                ?><li><a href="screport.php?scid=<?php echo $subcountyid;?>"><?php echo $name;?></a></li><?php
                                                                }
                                       ?>
                                
                                <li class="divider"></li>
                                <li><a href="screport.php">All Sub-Counties</a></li>
                              </ul>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Reported Events (Per Sector)
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                
                                <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getservice.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $serviceid = $sc["serviceid"];
                                                                //into a drop down menu
                                                                ?><li><a href="secreport.php?secid=<?php echo $serviceid;?>"><?php echo $name;?></a></li><?php
                                                                }

                                       ?>  
                                
                                <li class="divider"></li>
                                <li><a href="secreports.php">All Sectors</a></li>
                              </ul>
                        </li>
                        
                        <li>
                           <a href="help.php">
                               About/Help
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-7">
                       <?php
                       //get the details of the service
                       
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getservice.php?serviceid=$_GET[sectorid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $serviceid = $sc["serviceid"];
                                                                $description=$sc["description"];
                                                                
                                                               
                                                                }
                                       
                       //display the description of the service
                                                                echo "<h2>$name</h2><blockquote>$description</blockquote>";
                           
                                                                ?>
                        <a class="btn btn-default" href="secreport.php?secid=<?php echo $_GET[sectorid]; ?>">View Reports </a>
                        <a class="btn btn-default" href="#" data-toggle="modal" data-target="#report">
                                Report a New Event in this sector
                            </a>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</div>


  </div>
</div>
<div id="report" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Report</h4>
      </div>
      <div class="modal-body">
        <p>Select the exact location and fill in the form below to report. (Use mouse scrawler to zoom, left click to move map location and right click once to set the exact location.)</p>
        
        <form action="newreport.php" method="post" enctype="multipart/form-data">
                                    <table width="100%">
                        <tr>
                            <td>
                                <div class="form-group">
                                      <label for="email">Name:</label>
                                      <input type="text" class="form-control" id="name" name="name">
                                    </div>
                            </td>
                            <td>
                                <div class="form-group">
                                      <label for="email">Telephone</label>
                                      <input type="text" class="form-control" id="telephone" name="telephone" required>
                                    </div>
                            </td>
                
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                      <label for="email">Email:</label>
                                      <input type="email" class="form-control" id="email" name="email">
                                    </div>
                            </td>
                            <td>
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
                            </td>
                
                        </tr>
                    </table>
                                    
                                    
                    
            <input type="hidden" name="serviceid" value="<?php echo $serviceid; ?>"/>
                                    
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="search" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search</h4>
      </div>
      <div class="modal-body">
        <p>Enter a Sector, Sub-County or Ward to search</p>
           <form method="get" action="search.php">
             <div class="form-group">
               <label for="search">Search for...</label>
               <input type="text" class="form-control" id="search" name="search">
             </div>
             <button type="submit" class="btn btn-default">Search</button>
           </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
