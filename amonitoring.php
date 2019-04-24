<?php
session_start();
//check if the session is set
if (!isset($_SESSION['adminid'])) {
    header("Location:alogin.php");
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
                            <a href="admin.php">
                                <i class="pe-7s-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li >
                            <a href="auser.php">
                                <i class="pe-7s-user"></i>
                                <p>My Account</p>
                            </a>
                        </li>
                        <li>
                            <a href="awards.php">
                                <i class="pe-7s-map-marker"></i>
                                <p>Sub-Counties & Wards</p>
                            </a>
                        </li>
                        <li>
                            <a href="awadmin.php">
                                <i class="pe-7s-users"></i>
                                <p>Ward Administrators</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="pe-7s-users"></i>
                                <p>Sector Users</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="amonitoring.php">
                                <i class="pe-7s-users"></i>
                                <p>Monitoring & Evaluation</p>
                            </a>
                        </li>
                        <li>
                            <a href="asectors.php">
                                <i class="pe-7s-helm"></i>
                                <p>Sectors</p>
                            </a>
                        </li>
                        <li>
                            <a href="areports.php">
                                <i class="pe-7s-note2"></i>
                                <p>Reports</p>
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
                            <a class="navbar-brand" href="#">Monitoring & Evaluation
                                <?php
                                //the url to call the json data
                                $scounty_link = file_get_contents("http://www.prisconet.com/apps/county/getadmin.php?adminid=$_SESSION[adminid]");
                                error_reporting(E_ERROR | E_PARSE);
                                $data = json_decode($scounty_link, true);

                                foreach ($data as $sc) {
                                    $name = $sc["name"];
                                    echo " - <small>$name</small></a>";
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
                                    <a href="auser.php">
                                        Account
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Reported (S-County)
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
<?php
//the url to call the json data
$scounty_link = file_get_contents("http://www.prisconet.com/apps/county/getsubcounty.php");
error_reporting(E_ERROR | E_PARSE);
$data = json_decode($scounty_link, true);

foreach ($data as $sc) {
    $name = $sc["name"];
    $subcountyid = $sc["subcountyid"];
    //into a drop down menu
    ?><li><a href="screport.php?scid=<?php echo $subcountyid; ?>"><?php echo $name; ?></a></li><?php
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
$scounty_link = file_get_contents("http://www.prisconet.com/apps/county/getservice.php");
error_reporting(E_ERROR | E_PARSE);
$data = json_decode($scounty_link, true);

foreach ($data as $sc) {
    $name = $sc["name"];
    $serviceid = $sc["serviceid"];
    //into a drop down menu
    ?><li><a href="secreport.php?secid=<?php echo $serviceid; ?>"><?php echo $name; ?></a></li><?php
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
                            <div class="col-md-8">
                                <div class="card">
<?php
//if the countyid is not set, display a message prompting the user to select a county
if (!isset($_GET['subcountyid'])) {
    echo "<h4>Please Select a sub-county from the right pane to view the Moitoring & Evaluation officers in that sub-county</h4>";
} else {

    //get the details of the sector
    //the url to call the json data
    $sector_link = file_get_contents("http://www.prisconet.com/apps/county/getsubcounty.php?scountyid=$_GET[subcountyid]");
    error_reporting(E_ERROR | E_PARSE);
    $data = json_decode($sector_link, true);

    foreach ($data as $sc) {
        $thename = $sc["name"];
        $scubcountyid = $sc["subcountyid"];
    }
    ?>
                                        <div class="header">
                                            <h4 class="title">View Monitoring & Evaluation Officers : <?php echo "$thename"; ?></h4>
                                        </div>
                                        <div class="content">

                                            <hr/>                                
                                        <?php
                                        //get the details of the sector users
                                        //the url to call the json data
                                        $admin_link = file_get_contents("http://www.prisconet.com/apps/county/getmonitoring.php?subcountyid=$_GET[subcountyid]");
                                        error_reporting(E_ERROR | E_PARSE);
                                        $data = json_decode($admin_link, true);

                                        foreach ($data as $ad) {
                                            $username = $ad["name"];
                                            $userid = $ad["userid"];
                                            echo "<big>- $username </big>"
                                            ?><small><a href="deletemonitoring.php?userid=<?php echo $userid; ?>" onclick="return confirm('Are you sure?')">Delete</a></small><br/>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                            <?php
                                        }
                                        ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-user">

                                    <div class="content"><big>

                                    <?php
                                    //get the details of the wards
                                    //the url to call the json data
                                    $sector_link = file_get_contents("http://www.prisconet.com/apps/county/getsubcounty.php");
                                    error_reporting(E_ERROR | E_PARSE);

                                    $data = json_decode($sector_link, true);

                                    foreach ($data as $sec) {
                                        $name = $sec["name"];
                                        $subcountyid = $sec["subcountyid"];
                                        ?><small><a href="amonitoring.php?subcountyid=<?php echo $subcountyid; ?>"><?php echo "<big>- $name </big>" ?></a></small><br/>
                                                <?php
                                            }
                                            ?>   


                                        </big></div>
                                    <hr>

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
