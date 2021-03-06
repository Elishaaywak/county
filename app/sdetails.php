<?php
session_start();
//check if the session is set
if (!isset($_SESSION['suserid'])) {
    header("Location:index.php");
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
    <h1>Sector User</h1>
  </div>
    <div data-role="panel" id="myPanel">
  <h2>Menu</h2>
  <p>
      <div data-role="controlgroup" data-type="vertical">
      <a href="whome.php" class="ui-btn">Home</a>
      <a href="all.php" class="ui-btn">My Ward (PDF)</a>
      <a href="logout.php" class="ui-btn">Logout</a>
    </div>
      
      
      
  </p>
</div>
  <div data-role="main" class="ui-content">
      
      <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getsuser.php?suserid=$_SESSION[suserid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $suserid=$sc["suserid"];
                                                                echo " <h3>Welcome $name";
                                                                }
                                      
                                                                
                                                                
                                        //get the name of the sector
                                        $ward_link=file_get_contents("http://www.prisconet.com/apps/county/getsector.php?sectorid=$sectorid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($ward_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $sectorname = $sc["name"];
                                                                $sectorid=$sc["sectorid"];
                                                                echo " - </small>$sectorname</small></h3><hr/>";
                                                                }
                                       ?>
      <h4>Reported event Details</h4>
                            
                               
                                <?php
                                //get the reported events in this sector and display them in a table
                                
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?reportedid=$_GET[reportid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
             
                                        foreach ($data as $sc) {
                                                                $reportid=$sc['reportid'];
                                                                $rname = $sc['name'];
                                                                $email=$sc['email'];
                                                                $telephone=$sc['telephone'];
                                                                $report=$sc['report'];
                                                                $photo=$sc['photo'];
                                                                $longitude=$sc['longitude'];
                                                                $latitude=$sc['latitude'];
                                                                $date=$sc['reportdate'];
                                                                $status=$sc['status'];
                                                                $attachment=$sc['attachment'];
                                                                
                                                                
                                                                
                                                                }

                                      
                                ?>
                                
                            <div class="row"> 
                                <div class="col-sm-9"> <?php echo "<b>$rname:</b> $report<br/> <b>Date: </b>$date";?></div>
                                    <a href="#cf" data-rel="popup" class="ui-btn ui-btn-inline ui-corner-all">Resolve</a>

                                        <div id="cf"  data-role="popup" >
                                        Kindly give feedback to this reported event.
                                        
                                        <form action="feedback.php" method="post" class="form-horizontal">
                                            <input type="hidden" name="reportid" value="<?php echo $_GET['reportid'];?>"/>
                                            <textarea class="form-input" name="reason" Placeholder="Reason" required="Required"></textarea><br>
                                            <input type="submit" Value="Proceed"/>
                                        </form>
                                        </div>
                                
                                </div>
                            </div>
                           
    
  </div>

  <div data-role="footer" data-position="fixed">
    <h1>Monitoring Service Delivery</h1>
  </div>

</div>
</body>

</html>