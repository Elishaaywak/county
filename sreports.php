<?php
session_start();
//check if the session is set
if (!isset($_SESSION['suserid']))
{
   header("Location:index.php");
}
//the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getsuser.php?suserid=$_SESSION[suserid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $sectorid=$sc["serviceid"];
                                                                $thesector=$sectorid;
                                                                $thesector2=$sectorid;
                                                                }
//get the name of the sector
                                        $thesector_link=file_get_contents("http://www.prisconet.com/apps/county/getsector.php?sectorid=$thesector");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($thesector_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $sectorname = $sc["name"];
                                                               
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
				//valueFormatString: "YYYY/MMM/DD"

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
                                        $daily_link=file_get_contents("http://www.prisconet.com/apps/county/getdaily.php?sectorid=$sectorid");
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
				name: "Resolved Events",
				color: "#20B2AA",
				lineThickness: 2,

				dataPoints: [
				<?php
                                       //the url to call the json data
                                        $resolved_link=file_get_contents("http://www.prisconet.com/apps/county/getresolved.php?sectorid=$sectorid");
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
                                        $daily_link=file_get_contents("http://www.prisconet.com/apps/county/getpending.php?sectorid=$sectorid");
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
				name: "Fowarded for further Action",
				color: "#145214",
				lineThickness: 2,

				dataPoints: [
				<?php
                                       //the url to call the json data
                                        $daily_link=file_get_contents("http://www.prisconet.com/apps/county/getfowarded.php?sectorid=$sectorid");
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
                                        $daily_link=file_get_contents("http://www.prisconet.com/apps/county/getdismissed.php?sectorid=$sectorid");
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

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-56.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    SOMS
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="shome.php">
                        <i class="pe-7s-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li >
                    <a href="suser.php">
                        <i class="pe-7s-user"></i>
                        <p>My Account</p>
                    </a>
                </li>
               
                <li>
                    <a href="sreports.php">
                        <i class="pe-7s-note2"></i>
                        <p>All Reports (My Sector)</p>
                    </a>
                </li>
                
                <li>
                    <a href="ward_resolved.php">
                        <i class="pe-7s-note2"></i>
                        <p>Resolved by Ward Admin</p>
                    </a>
                </li>
               
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-inverse navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Reported Events
                    <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getsuser.php?suserid=$_SESSION[suserid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $wardid=$sc["wardid"];
                                                                $sectorid=$sc["sectorid"];
                                                                echo " - <small>$name</small></a>";
                                                                }
                                         //get the name of the ward
                                        $sector_link=file_get_contents("http://www.prisconet.com/apps/county/getsector.php?sectorid=$sectorid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($sector_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $sectorname = $sc["name"];
                                                                $sectorid=$sc["sectorid"];
                                                                
                                                                }

                                       ?> 
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
                           <a href="suser.php">
                               Account
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Reported (Sub-county)
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
                                    Reported (Sector)
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
                            <a href="logout.php">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h3>All reported events in My Sector <small><a href="spdf.php" target="_blank">Download PDF</a></small></h3>
                            
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
                                      <th>Email</th>
                                      <th>Telephone</th>
                                      <th>Report</th>
                                      <th>Nearest Location</th>
                                      <th>Date</th>
                                      <th>Time</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                //get the reported events in this ward and displaythem in a table
                                
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?sectorid=$thesector2");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportid=$sc['reportid'];
                                                                $name = $sc['name'];
                                                                $email=$sc['email'];
                                                                $telephone=$sc['telephone'];
                                                                $report=$sc['report'];
                                                                $nearest=$sc['nearest'];
                                                                $status=$sc['status'];
                                                                $date=$sc['reportdate'];
                                                                $time=$sc['reporttime'];
                                                                
                                                                //into the table
                                                                
                                                                ?>
                                    <tr><td><?php echo $name;?></td><td><?php echo $email;?></td><td><?php echo $telephone;?></td><td><?php echo $report;?></td><td><?php echo $nearest;?></td>
                                        <td><?php echo $date;?></td><td><?php echo $time;?></td><td><?php echo $status;?></td><td><a href="sdetails.php?reportid=<?php echo $reportid;?>">Details</a></td></tr>
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
        
        //the url to call the json data
                                        $map_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?sectorid=$serviceid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($map_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportid=$sc['reportid'];
                                                                $name = $sc['name'];
                                                                $email=$sc['email'];
                                                                $telephone=$sc['telephone'];
                                                                $report=$sc['report'];
                                                                $status=$sc['status'];
                                                                $latitude=$sc['latitude'];
                                                                $longitude=$sc['longitude'];
                                                                
                                                                //into the table
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
    

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
}
</script>
                                          
                                          
                                          
<div id="mapCanvas"></div>                            
   
                                     
                                    </div>
                                    <div id="graphs" class="tab-pane fade">
                                       <div id="chartContainer" style="height: 100%; width: 100%;">
	</div>

                                    </div>
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
