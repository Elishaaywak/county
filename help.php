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
                    <div class="col-md-10">
                        <h3>
                            About SOMS
                        </h3>
                        <p>
                            This is a Mobile, Web and SMS based Systems that allows residents of Nairobi County in Kenya to report to the county government services that are not being delivered as required.
                            <br/><br/>
                            The system also allows the residents of the County to get feedback from the County Government on the status of various service delivery issues that have been reported by the residents of the county. The Mobile app is available in Android, iOS and Windows mobile version. The Android version can be accessed by clicking the link in the Homepage.
                            <br/><br/>
                            There is also an SMS based platform that allows user to access the system by simply sending a text message to a certain number and they will receive automated response.
                        </p>
                        <hr/>
                        <h3>
                            How to use the web portal
                        </h3>
                        <p>
                        To use the web portal, first you have to visit the web page. If you want to report an event, click on the Report a new event button. you will find form which if you fill and click submit, the data will be sent to the database and the respective ward and sector will be notified.
                        To view isssues that have been submitted, click on the reported events per sub county or sector that are in front on top of the page. You will be given the details that you desire. You can also download the full PDF giving you details of all that have been reported.
                        </p>
                        <h3>
                            How to use the mobile App
                        </h3>
                        <p>
                            First you download the app from the link in the homepage and install it. To report an event, click on the button written 'Report a new event'. after that you fill the form and click the submit button and the data will automatically be directed to the database.
                            to view past reported events, click on the view reported events button and you will be directed to a page containing the reported events. You can select a ward or sector of your choice or you can download the entire report in PDF format.
                        </p>
                        <h3>
                            How to use the SMS Gateway
                        </h3>
                        <p>
                            To use the SMS Service, send a message using the *ward_id*sector_id*name*report*nearest location# to the number +254703395018 and you will receive a confirmation message telling you that the report was successful. To get the ID of the sector send the word Sector to the number +254703395018 To get the ID of the ward send the word Ward to the number +254703395018
                        </p>
                    </div>
                </div>
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
