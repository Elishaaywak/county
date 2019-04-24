<?php
session_start();
//check if the session is set
if (!isset($_SESSION['wuserid']))
{
    header("Location:index.php");
}


                                //get the reported events in this ward and display them in a table
                                
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
       #map {
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
                    <a href="whome.php">
                        <i class="pe-7s-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li >
                    <a href="wuser.php">
                        <i class="pe-7s-user"></i>
                        <p>My Account</p>
                    </a>
                </li>
               
                <li>
                    <a href="wreports.php">
                        <i class="pe-7s-note2"></i>
                        <p>All Reports (My Ward)</p>
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
                    <a class="navbar-brand" href="#">Reported Event
                    <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getwadmin.php?adminid=$_SESSION[wuserid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $wardid=$sc["wardid"];
                                                                echo " - <small>$name";
                                                                }
                                      
                                                                
                                                                
                                        //get the name of the ward
                                        $ward_link=file_get_contents("http://www.prisconet.com/apps/county/getward.php?wardid=$wardid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($ward_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $wardname = $sc["name"];
                                                                $wardid=$sc["wardid"];
                                                                echo " - $wardname</small></a>";
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
                           <a href="">
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
                            <h3>Reported Event Details</h3>
                            <div class="row"> 
                                <div class="col-sm-9"> <?php echo "<b>Reported By $rname:</b> $report<br/> <b>Date: </b>$date";?></div>
                                <div class="col-sm-3"><a href="wfoward.php?reportid=<?php echo $_GET['reportid'];?>">Forward </a> | 
                                    <a href="#rj" data-toggle="collapse">Reject</a>

                                        <div id="rj" class="collapse">
                                        Kindly state the reason for rejecting this reported event.
                                        
                                        <form action="wreject.php" method="post" class="form-horizontal">
                                            <input type="hidden" name="reportid" value="<?php echo $_GET['reportid'];?>"/>
                                            <textarea class="form-input" name="reason" required="Required"></textarea><br>
                                            <input type="submit" Value="Proceed"/>
                                        </form>
                                        </div>
                                    | <a href="#rs" data-toggle="collapse">Resolve</a>

                                        <div id="rs" class="collapse">
                                        Resolve this issue.
                                        
                                        <form action="wresolve.php" method="post" class="form-horizontal">
                                            <input type="hidden" name="reportid" value="<?php echo $_GET['reportid'];?>"/>
                                            <textarea class="form-input" name="reason" required="Required"></textarea><br>
                                            <input type="submit" Value="Proceed"/>
                                        </form>
                                        </div>
                                
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-lg-6"><h4>Map of location:</h4>
                                   <?php
                                   if ($latitude!="")
                                   {
                                     ?>  
                                   

                                    <div id="map"></div>
                                        <script>
                                          function initMap() {
                                            var uluru = {lat: <?php echo $latitude;?>, lng: <?php echo $longitude;?>};
                                            var map = new google.maps.Map(document.getElementById('map'), {
                                              zoom: 10,
                                              center: uluru
                                            });
                                            var marker = new google.maps.Marker({
                                              position: uluru,
                                              map: map
                                            });
                                          }
                                        </script>
                                        <script async defer
                                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA6UsI3A8Y5gA70h2LMKCKFyXOMq9VE8w&callback=initMap">
                                        </script>
                                   <?php } ?>
                                </div>
                                <div class="col-lg-6"><h4>Photo/Video</h4>
                                    
                                <?php
                                //check if there is an attachment which is a photo
                                if ((strpos($attachment, 'PNG') !== false)|| (strpos($attachment, 'png') !== false)||(strpos($attachment, 'jpg') !== false)||(strpos($attachment, 'JPEG') !== false)||(strpos($attachment, 'jpeg') !== false)||(strpos($attachment, 'JPG') !== false)||(strpos($attachment, 'GIF') !== false) || (strpos($attachment, 'gif') !== false))
                                        {
                                        ?><img class="img-responsive" width="100%" src="<?php echo "uploads/$attachment" ;?>"/><?php
                                        }
                                else if ((strpos($attachment, 'mp4') !== false)|| (strpos($attachment, 'MP4') !== false)||(strpos($attachment, 'WebM') !== false)||(strpos($attachment, 'FLV') !== false)||(strpos($attachment, 'Ogg') !== false))
                                        {
                                        ?><video width="400" controls>
                                            <source src="<?php echo "uploads/$attachment" ;?>" type="video/mp4">
                                            <source src="<?php echo "uploads/$attachment" ;?>" type="video/ogg">
                                            Your browser does not support HTML5 video.
                                          </video>
                                    <?php
                                        }
                                else
                                    {
                                        echo"<strong>Sorry, No video or image is available for display</strong>";
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

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
