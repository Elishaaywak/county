<?php
session_start();
//if the sub-county report is not set, go to pdf.php
if (!isset($_GET['scid']))
{
   header("Location:pdf.php");
}


if (isset($_GET['wardid']))
{
    $wardid=$_GET['wardid'];
}
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

  <script type="text/javascript">
	window.onload = function () {
		var chart = new CanvasJS.Chart("chartContainer",
		{

			title:{
				text: "Graphical visualization",
				fontSize: 30
			},
                        animationEnabled: true,
			axisX:{

				gridColor: "Silver",
				tickColor: "silver",
				valueFormatString: "YYYY/MMM/DD"

			},                        
                        toolTip:{
                          shared:false
                        },
			theme: "theme3",
			axisY: {
				gridColor: "Silver",
				tickColor: "silver"
			},
			legend:{
				verticalAlign: "center",
				horizontalAlign: "right"
			},
			data: [
			{        
				type: "line",
				showInLegend: true,
				lineThickness: 3,
				name: "Daily Reported Events",
				markerType: "square",
				color: "#ffff00",
				dataPoints: [
                                    <?php
                                       //the url to call the json data
                                        $dailyg_link=file_get_contents("http://www.prisconet.com/apps/county/getdaily.php?wardid=$wardid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($dailyg_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportdate = $sc["reportdate"];
                                                                //explode the reportdate and store it as individual entries
                                                                $reportdate = explode('-', $reportdate);
                                                                $year = $reportdate[0];
                                                                $month   = $reportdate[1];
                                                                $day  = $reportdate[2];
                                                                
                                                                //month starts from 0, not 1
                                                                $month=$month-1;

                                                                $number = $sc["number"];
                                                                //into a drop down menu
                                                                ?>{ x:new Date(<?php echo "$year,$month,$day";?>) , y: <?php echo $number;?>},<?php
                                                                                   
                                                                }	
                                       ?>
				
				]
			},
			{        
				type: "line",
				showInLegend: true,
				name: "Resolved Events",
				color: "#20B2AA",
				lineThickness: 2,

				dataPoints: [
				<?php
                                       //the url to call the json data
                                        $resolved_link=file_get_contents("http://www.prisconet.com/apps/county/getresolved.php?wardid=$wardid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($resolved_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportdate = $sc["reportdate"];
                                                                //explode the reportdate and store it as individual entries
                                                                $reportdate = explode('-', $reportdate);
                                                                $year = $reportdate[0];
                                                                $month   = $reportdate[1];
                                                                $day  = $reportdate[2];
                                                                
                                                                //month starts from 0, not 1
                                                                $month=$month-1;

                                                                $number = $sc["number"];
                                                                //into a drop down menu
                                                                ?>{ x:new Date(<?php echo "$year,$month,$day";?>) , y: <?php echo $number;?>},<?php
                                                                                   
                                                                }	
                                       ?>
				]
			}
                        ,
			{        
				type: "line",
				showInLegend: true,
				name: "Pending Events",
				color: "#e6004c",
				lineThickness: 2,

				dataPoints: [
				<?php
                                       //the url to call the json data
                                        $pending_link=file_get_contents("http://www.prisconet.com/apps/county/getpending.php?wardid=$wardid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($pending_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportdate = $sc["reportdate"];
                                                                //explode the reportdate and store it as individual entries
                                                                $reportdate = explode('-', $reportdate);
                                                                $year = $reportdate[0];
                                                                $month   = $reportdate[1];
                                                                $day  = $reportdate[2];
                                                                
                                                                //month starts from 0, not 1
                                                                $month=$month-1;

                                                                $number = $sc["number"];
                                                                //into a drop down menu
                                                                ?>{ x:new Date(<?php echo "$year,$month,$day";?>) , y: <?php echo $number;?>},<?php
                                                                                   
                                                                }	
                                       ?>
				]
			},
                        {        
				type: "line",
				showInLegend: true,
				name: "Fowarded for further Action",
				color: "#145214",
				lineThickness: 2,

				dataPoints: [
				<?php
                                       //the url to call the json data
                                        $daily_link=file_get_contents("http://www.prisconet.com/apps/county/getfowarded.php?wardid=$wardid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($daily_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportdate = $sc["reportdate"];
                                                                //explode the reportdate and store it as individual entries
                                                                $reportdate = explode('-', $reportdate);
                                                                $year = $reportdate[0];
                                                                $month   = $reportdate[1];
                                                                $day  = $reportdate[2];
                                                                
                                                                //month starts from 0, not 1
                                                                $month=$month-1;

                                                                $number = $sc["number"];
                                                                //into a drop down menu
                                                                ?>{ x:new Date(<?php echo "$year,$month,$day";?>) , y: <?php echo $number;?>},<?php
                                                                                   
                                                                }	
                                       ?>
				]
			},
                        {        
				type: "line",
				showInLegend: true,
				name: "Dismissed Reports",
				color: "#99003d",
				lineThickness: 2,

				dataPoints: [
				<?php
                                       //the url to call the json data
                                        $daily_link=file_get_contents("http://www.prisconet.com/apps/county/getdismissed.php?wardid=$wardid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($daily_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportdate = $sc["reportdate"];
                                                                //explode the reportdate and store it as individual entries
                                                                $reportdate = explode('-', $reportdate);
                                                                $year = $reportdate[0];
                                                                $month   = $reportdate[1];
                                                                $day  = $reportdate[2];
                                                                
                                                                //month starts from 0, not 1
                                                                $month=$month-1;

                                                                $number = $sc["number"];
                                                                //into a drop down menu
                                                                ?>{ x:new Date(<?php echo "$year,$month,$day";?>) , y: <?php echo $number;?>},<?php
                                                                                   
                                                                }	
                                       ?>
				]
			}

			
			],
          legend:{
            cursor:"pointer",
            itemclick:function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              	e.dataSeries.visible = false;
              }
              else{
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          }
		});

chart.render();
}
</script>
<script type="text/javascript" src="assets/canvasjs.min.js"></script>    
       <style>
       #mapCanvas {
        height: 350px;
        width: 100%;
       }
        
    </style>
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
                                                                ?><li><a href="services.php?serviceid=<?php echo $serviceid;?>"><?php echo $name;?></a></li><?php
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
                   
                    <div class="col-md-9">
                       <?php
                       //get the details of the sub-county
                       
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getsubcounty.php?scountyid=$_GET[scid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $subcountyid = $sc["subcountyid"];
                                                                
                                                               
                                                                }
                                       
                       //display the name of the sub-county
                                                                echo "<h2>$name Sub-County</h2>";
                                                                
                               //if the wardid is not set, display a message
                                                                if (!isset($_GET['wardid']))
                                                                {
                                                                    echo"<blockquote>Please select a ward rom the right pane to view the reports in the ward</blockquote>";
                                                                }
                                                                else
                                                                {
                                                                    ?>
                        <?php
                        //get the name of the ward
                        //the url to call the json data
                                        $wards_link=file_get_contents("http://www.prisconet.com/apps/county/getward.php?wardid=$_GET[wardid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($wards_link,true);
                                        
                                        foreach ($data as $wd) {
                                                                $ward_name = $wd["name"];
                                                                $wardid = $wd["wardid"];
                                                                ?><?php echo "<h4>$ward_name Ward</h4>";
                                                                }
                    ?>
                    
                                                                          <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#details">Details</a></li>
                                    <li><a data-toggle="tab" href="#maps">Maps</a></li>
                                    <li><a data-toggle="tab" href="#graphs">Graph</a></li>
                                  </ul>

                                  <div class="tab-content">
                                    <div id="details" class="tab-pane fade in active">
                                      <h3>Details</h3>
                                      <p>
                                      <table class="table table-striped">
                                <thead>
                                    <tr>
                                      <th>Full Name</th>
                                      <th>Report</th>
                                      <th>Nearest Location</th>
                                      <th>Date</th>
                                      <th>Time</th>
                                      <th>Status</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                //get the reported events in this ward and displaythem in a table
                                //get the wardid
                                $wardid=$_GET['wardid'];
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?wardid=$wardid&user=public");
                                      
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportid=$sc['reportid'];
                                                                $name = $sc['name'];
                                                                $report=$sc['report'];
                                                                $nearest=$sc['nearest'];
                                                                $date=$sc['reportdate'];
                                                                $time=$sc['reporttime'];
                                                                $status=$sc['status']
                                                                
                                                                //into the table
                                                                
                                                                ?>
                                    <tr><td><?php echo $name;?></td><td><?php echo $report;?></td><td><?php echo $nearest;?></td><td><?php echo $date;?></td><td><?php echo $time;?></td><td><?php echo $status;?></td>
                                        </tr>
                                                              <?php
                                                                }

                                      
                                ?>
                            </tbody>
                            </table>
                                      </p>
                                    </div>
                                    <div id="maps" class="tab-pane fade">
                                      <h3>Map</h3>
            
   <script async defer
                                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA6UsI3A8Y5gA70h2LMKCKFyXOMq9VE8w&callback=initMap">
                                        </script>                             
<script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(10);
    var markers = [
        <?php
        $wardid=$_GET['wardid'];
        
        //the url to call the json data
                                        $map_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?wardid=$wardid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($map_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportid=$sc['reportid'];
                                                                $name = $sc['name'];
                                                                $email=$sc['email'];
                                                                $telephone=$sc['telephone'];
                                                                $report=$sc['report'];
                                                                $nearest=$sc['nearest'];
                                                                $status=$sc['status'];
                                                                $latitude=$sc['latitude'];
                                                                $longitude=$sc['longitude'];
                                                                
                                                                //into the map
                                                                
                                                                // Multiple markers location, latitude, and longitude
                                                                
                                                                //if the longitude and the latitude are not null
                                                                
                                                                if (($latitude !='') && ($longitude !=''))
                                                                {
                                                                    
                                                                      echo"['$name:$report', $latitude, $longitude],";
                                                                         
                                                                }
                                                                 
                                        }
                                                             ?>
    ];
                        
   
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}
// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);


$('a[data-toggle="tab"]').on('click', function () {
      
  	setTimeout(function(){
        google.maps.event.trigger(mapCanvas, 'resize');
    }, 100);

});
</script>
                                          
                                          
                                          
<div id="mapCanvas"></div>                            
   
                                     
                                    </div>
                                    <div id="graphs" class="tab-pane fade">
                                       <div id="chartContainer" style="height: 100%; width: 100%;">
	</div>

                                    </div>
                                  </div>
                                                                    <?php
                                                                }
                           ?>
                    </div>
                    <div class="col-md-3"><h4>Wards in the sub-County</h4>
                    <?php
                        //the url to call the json data
                                        $wards_link=file_get_contents("http://www.prisconet.com/apps/county/getward.php?scountyid=$_GET[scid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($wards_link,true);
                                        
                                        foreach ($data as $wd) {
                                                                $ward_name = $wd["name"];
                                                                $wardid = $wd["wardid"];
                                                                ?><a href="screport.php?wardid=<?php echo $wardid;?>&scid=<?php echo $subcountyid;?>&user=public"><?php
                                                               echo "<b>$ward_name</b></a></br/>";
                                                                }
                    ?>
                    
                    
                    </div>
                </div>
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
