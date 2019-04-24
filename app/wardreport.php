<?php
$wardid=$_GET['wardid'];
?>
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
<script type="text/javascript" src="assets/canvasjs.min.js"></script> 
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
            <h1>Details</h1>
           
                <table data-role="table" data-mode="columntoggle" class="ui-responsive" id="myTable">
                                <thead>
                                    <tr>
                                      <th>Full Name</th>
                                      <th>Report</th>
                                      <th>Nearest Location</th>
                                      <th data-priority="4">Date</th>
                                      <th data-priority="5">Time</th>
                                      <th data-priority="3">Status</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                //get the reported events in this ward and displaythem in a table
                                //get the wardid
                                $wardid=$_GET['wardid'];
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?wardid=$wardid");
                                      
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

  <div data-role="footer" data-position="fixed">
    <h1>Monitoring Service Delivery</h1>
  </div>

</div>
</body>

</html>