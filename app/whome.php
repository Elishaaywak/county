<?php
session_start();
//check if the session is set
if (!isset($_SESSION['wuserid'])) {
    header("Location:index.php");
}

    //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getwadmin.php?adminid=$_SESSION[wuserid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $wardid=$sc["wardid"];
                                                              
                                                                }

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

    </head>
    <body>
<div data-role="page">

  <div data-role="header">
      <a href="#myPanel" class="ui-btn ui-btn-inline">Menu</a>
    <h1>Ward Admin</h1>
  </div>
    <div data-role="panel" id="myPanel">
  <h2>Menu</h2>
  <p>
      <div data-role="controlgroup" data-type="vertical">
      <a href="wall.php" class="ui-btn">Reported(My Ward)</a>
      <a href="http://www.prisconet.com/apps/county/convert_ward.php?wardid=<?php echo $wardid; ?>" target="_blank" class="ui-btn">View Report (PDF)</a>
      <a href="logout.php" class="ui-btn">Logout</a>
    </div>
      
      
      
  </p>
</div>
  <div data-role="main" class="ui-content">
      
      <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getwadmin.php?adminid=$_SESSION[wuserid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $wardid=$sc["wardid"];
                                                                echo " <h3>Welcome $name";
                                                                }
                                      
                                                                
                                                                
                                        //get the name of the ward
                                        $ward_link=file_get_contents("http://www.prisconet.com/apps/county/getward.php?wardid=$wardid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($ward_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $wardname = $sc["name"];
                                                                $wardid=$sc["wardid"];
                                                                echo " - </small>$wardname</small></h3><hr/>";
                                                                }
                                       ?>
      <h4>Pending reports in my ward</h4>
                            
                                <table data-role="table" data-mode="columntoggle" class="ui-responsive" id="myTable">
                                <thead>
                                    <tr>
                                      <th>Full Name</th>
                                      <th>Report</th>
                                      <th data-priority="6">Nearest Location</th>
                                      <th data-priority="4">Date</th>
                                      <th data-priority="5">Time</th>
                                      <th data-priority="3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                //get the reported events in this ward and displaythem in a table
                                
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?wardid=$wardid&status=Pending");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportid=$sc['reportid'];
                                                                $name = $sc['name'];
                                                                $email=$sc['email'];
                                                                $telephone=$sc['telephone'];
                                                                $report=$sc['report'];
                                                                $nearest=$sc['nearest'];
                                                                $date=$sc['reportdate'];
                                                                $time=$sc['reporttime'];
                                                                
                                                                //into the table
                                                                
                                                                ?>
                                    <tr><td><?php echo $name;?></td><td><?php echo $report;?></td><td><?php echo $nearest;?></td>
                                        <td><?php echo $date;?></td><td><?php echo $time;?></td><td><a href="wdetails.php?reportid=<?php echo $reportid;?>">Details</a></td></tr>
                                                              <?php
                                                                }

                                      
                                ?>
                            </tbody>
                            </table>
    
  </div>

  <div data-role="footer" data-position="fixed">
    <h1>Monitoring Service Delivery</h1>
  </div>

</div>
</body>

</html>