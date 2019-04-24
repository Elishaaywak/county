<?php
session_start();
//check if the session is set
if (!isset($_SESSION['muserid']))
{
   header("Location:index.php");
}
//the url to call the json data
                                        $monitoring_link=file_get_contents("http://www.prisconet.com/apps/county/getmonitoring.php?muserid=$_SESSION[muserid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($monitoring_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $sub_countyid=$sc["sub_countyid"];
                                                                $bla=$sub_countyid;
                                                              
                                                                }
//Get the start and end dates
$startdate=$_GET['startdate'];
$enddate=$_GET['enddate'];
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
                <li class="active">
                    <a href="mhome.php">
                        <i class="pe-7s-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li >
                    <a href="#"data-toggle="modal" data-target="#filter">
                        <i class="pe-7s-home"></i>
                        <p>Filter Search</p>
                    </a>
                </li>
                <li >
                    <a href="muser.php">
                        <i class="pe-7s-user"></i>
                        <p>My Account</p>
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
                    <a class="navbar-brand" href="#">Filter Records by Date - 
                    <?php
                                       $monitoring_link=file_get_contents("http://www.prisconet.com/apps/county/getmonitoring.php?muserid=$_SESSION[muserid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($monitoring_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $sub_countyid=$sc["sub_countyid"];
                                                               
                                                                }
                                                                echo $name;
                                         //get the name of the sub county
                                        $sector_link=file_get_contents("http://www.prisconet.com/apps/county/getsubcounty.php?scountyid=$sub_countyid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($sector_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $sectorname = $sc["name"];
                                                                $sectorid=$sc["sectorid"];
                                                              
                                                                }

                                       ?>    - Mon. & Eva.
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
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getsubcounty.php?sub_countyid=$sub_countyid");
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
                            <h3><?php echo " Reported events  - <small> in $sectorname Sub-County "; ?><a href="convert_filter.php?page=filterpdf.php&sub_countyid=<?php echo $sub_countyid; ?>&startdate=<?php echo $startdate; ?>&enddate=<?php echo $enddate; ?>" target="_blank"> Download PDF</a></small></h3>
                            <?php echo "convert_filter.php?page=filterpdf.php&sub_countyid=$sub_countyid&startdate=$startdate&enddate=$enddate"; ?>
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
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                //get the reported events in this sector and displaythem in a table
                                
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?startdate=$startdate&enddate=$enddate");
                                      
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
                                                                $status=$sc['status'];
                                                                $wardid=$sc['wardid'];
                                                                
                                                                //get the ward and check if they come from the same sub-county
                                                                //the url to call the json data
                                                                $ward_link=file_get_contents("http://www.prisconet.com/apps/county/getward.php?wardid=$wardid");
                                                                error_reporting(E_ERROR | E_PARSE);
                                                                $thedata = json_decode($ward_link,true);
                                                                foreach ($thedata as $wd) {
                                                                                $thesubcounty=$wd['scountyid'];
                                                                                
                                                                 
                                                                                        }
                                                                                        
                                                                                        //if the report is ftom that ward
                                                                                        if ($thesubcounty==$bla)
                                                                                        {
                                                                                             ?>
                                                                                                 <tr><td><?php echo $name;?></td><td><?php echo $email;?></td><td><?php echo $telephone;?></td><td><?php echo $report;?></td><td><?php echo $nearest;?></td>
                                                                                                 <td><?php echo $date;?></td><td><?php echo $time;?></td><td><?php echo $status; ?></td></tr>
                                                                                             <?php
                                                                                        }
                                                               
                                                                }

                                      
                                ?>
                            </tbody>
                            </table>
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
<!-- Filter Modal -->
<div id="filter" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search Records by date</h4>
      </div>
      <div class="modal-body">
        <p>Enter the start and end date to search</p>
        <form method="get" action="monitoring_filter.php">
        	<label for="search">Start Date (YYYY-MM-DD)</label>
        	<input type="date" name="startdate" placeholder="Start Date" required="required" class="form-control">
        	<label for="search">End Date(YYYY-MM-DD)</label>
        	<input type="date" name="enddate" placeholder="End Date" required="required" class="form-control">
        	<input type="submit" name="Filter" value="Filter by Date" class="form-control">
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
<label for="search">Search for...</label>
	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
