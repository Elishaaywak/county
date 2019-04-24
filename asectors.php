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
                            <a href="asectoruser.php">
                                <i class="pe-7s-users"></i>
                                <p>Sector Users</p>
                            </a>
                        </li>
                        <li>
                            <a href="amonitoring.php">
                                <i class="pe-7s-users"></i>
                                <p>Monitoring & Evaluation</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
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
                            <a class="navbar-brand" href="#">Services/Sectors
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
<?php
//if $_Session[success is set, display the message
if (isset($_SESSION['success'])) {
    ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong> <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php
                    }
                    //unset the session
                    unset($_SESSION['success']);
                    ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
<?php
//if the countyid is not set, display a message prompting the user to select a county
if ((!isset($_GET['sectorid'])) || ($_GET['sectorid'] < 1)) {
    echo "<h4>Please Select a service/sector from the right pane to edit or delete it</h4>";
} else {

    //get the details of the sector
    //the url to call the json data
    $sector_link = file_get_contents("http://www.prisconet.com/apps/county/getservice2.php?sectorid=$_GET[sectorid]");
    error_reporting(E_ERROR | E_PARSE);
    $data = json_decode($sector_link, true);

    foreach ($data as $sc) {
        $secname = $sc["name"];
        $sectorid = $sc["serviceid"];
    }
    ?>
                                        <div class="header">
                                            <h4 class="title">View Sector : <?php echo $secname; ?> <small><a href="deletesector.php?sectorid=<?php echo $sectorid; ?>" onclick="return confirm('Are you sure?')">Delete</a></small></h4>
                                        </div>
                                        <div class="content">
                                            <form action="updatesector.php" method="post">
                                                <div class="form-group">
                                                    <label for="sector">Update/ Edit Sector Name:</label>
                                                    <input type="text" class="form-control" id="sector" name="sector" required>
                                                    <input type="hidden" name="serviceid" value="<?php echo $sectorid; ?>"/>
                                                </div>
                                                <button type="submit" class="btn btn-default">Update</button>
                                            </form> 
                                            <hr/>
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
                                    //the url to call the json data
                                    $scounty_link = file_get_contents("http://www.prisconet.com/apps/county/getservice.php");
                                    error_reporting(E_ERROR | E_PARSE);
                                    $data = json_decode($scounty_link, true);

                                    foreach ($data as $sc) {
                                        $name = $sc["name"];
                                        $serviceid = $sc["serviceid"];
                                        //into the url
                                        ?>
                                                <a href="asectors.php?sectorid=<?php echo $serviceid; ?>"><?php echo $name; ?></a><br/>
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
