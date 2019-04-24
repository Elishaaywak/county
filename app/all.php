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
                                        $daily_link=file_get_contents("http://www.prisconet.com/apps/county/getdaily.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($daily_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportdate = $sc["reportdate"];
                                                                $reportdate = str_replace('-', ',', $reportdate);
                                                                $number = $sc["number"];
                                                                //into a drop down menu
                                                                ?>{ x:new Date(<?php echo $reportdate;?>) , y: <?php echo $number;?>},<?php
                                                                                   
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
                                        $solved_link=file_get_contents("http://www.prisconet.com/apps/county/getresolved.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($solved_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $date = $sc["reportdate"];
                                                                $number = $sc["number"];
                                                                //into a drop down menu
                                                                 ?>{ x:new Date(<?php echo $reportdate;?>) , y: <?php echo $number;?>},<?php
                                                                                   
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
                                        $daily_link=file_get_contents("http://www.prisconet.com/apps/county/getpending.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($daily_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportdate = $sc["reportdate"];
                                                                $reportdate = str_replace('-', ',', $reportdate);
                                                                $number = $sc["number"];
                                                                //into a drop down menu
                                                                ?>{ x:new Date(<?php echo $reportdate;?>) , y: <?php echo $number;?>},<?php
                                                                                   
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
                                        $foward_link=file_get_contents("http://www.prisconet.com/apps/county/getfowarded.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($foward_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportdate = $sc["reportdate"];
                                                                $reportdate = str_replace('-', ',', $reportdate);
                                                                $number = $sc["number"];
                                                                //into a drop down menu
                                                                ?>{ x:new Date(<?php echo $reportdate;?>) , y: <?php echo $number;?>},<?php
                                                                                   
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
                                        $dismissed_link=file_get_contents("http://www.prisconet.com/apps/county/getdismissed.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($dismissed_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportdate = $sc["reportdate"];
                                                                $reportdate = str_replace('-', ',', $reportdate);
                                                                $number = $sc["number"];
                                                                //into a drop down menu
                                                                ?>{ x:new Date(<?php echo $reportdate;?>) , y: <?php echo $number;?>},<?php
                                                                                   
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
            <h1>Details</h1>
            <p>
                jjjjjjjjjjjjjjj
                                
            </p>
        </div>
        
        <div data-role="collapsible">
            <h1>Map</h1>
            <p>
               kkk
                    
            </p>
        </div>
        <div data-role="collapsible">
            <h1>Graph</h1>
            <p>
                <div id="chartContainer" style="height: 100%; width: 100%;"></div>

            </p>
  </div>

  <div data-role="footer" data-position="fixed">
    <h1>Monitoring Service Delivery</h1>
  </div>

</div>
</body>

</html>