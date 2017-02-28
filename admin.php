<?php
session_start();
//check if the session is set
if (!isset($_SESSION['adminid']))
{
    //header("Location:alogin.php");
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
                    Monitoring Service Delivery in County Government
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li>
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
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Admin Homepage
                    <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://localhost/county/getadmin.php?adminid=$_SESSION[adminid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                echo " - <small>$name</small></a>";
                                                                }

                                       ?>    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        
                        
                        <li>
                           <a href="">
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
                                    Reports
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">sub-county1</a></li>
                                <li><a href="#">sub-county2</a></li>
                                <li><a href="#">sub-county3</a></li>
                                
                                <li class="divider"></li>
                                <li><a href="areports.php">All Sub-Counties</a></li>
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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sector Users</h4>
                                <p class="category">Input a new Sector user</p>
                            </div>
                            <div class="content">
                              <form action="newsuser.php" method="post">
                                    <div class="form-group">
                                    <label for="name">Full Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                  <div class="form-group">
                                    <label for="email">Email Address:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                  <div class="form-group">
                                    <label for="telephone">Telephone Number:</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" required>
                                    </div>
                                  <div class="form-group">
                                      <label for="service">Service/Sector:</label>
                                    <select class="form-control" id="service" name="service">
                                       <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://localhost/county/getservice.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $serviceid = $sc["serviceid"];
                                                                //into a drop down menu
                                                                ?><option value="<?php echo $serviceid;?>"><?php echo $name;?></option><?php
                                                                }

                                       ?>                                      
                          </select>
                                    </div>
                                  <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="pwd">Confirm Password:</label>
                                    <input type="password" class="form-control" id="pwd" name="pwd" required>
                                    </div>
                                    <button type="submit" class="btn btn-default">Add</button>
                                </form>  

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Ward Administrators</h4>
                                <p class="category">Input a new Ward Administrator</p>
                            </div>
                            <div class="content">
                                <form action="newwadmin.php" method="post">
                                    <div class="form-group">
                                    <label for="name">Full Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                  <div class="form-group">
                                    <label for="email">Email Address:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                  <div class="form-group">
                                    <label for="text">Telephone Number:</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" required>
                                    </div>
                                  <div class="form-group">
                                      <label for="Ward">Ward:</label>
                                    <select class="form-control" id="ward" name="ward">
                                       <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://localhost/county/getward.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $wardid = $sc["wardid"];
                                                                //into a drop down menu
                                                                ?><option value="<?php echo $wardid;?>"><?php echo $name;?></option><?php
                                                                }

                                       ?>
                                        </select>
                                    </div>
                                  <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="pwd">Confirm Password:</label>
                                    <input type="password" class="form-control" id="pwd" name="pwd" required>
                                    </div>
                                    <button type="submit" class="btn btn-default">Add</button>
                                </form>  
 

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sub-Counties</h4>
                                <p class="category">Input a new Sub-County</p>
                            </div>
                            <div class="content">
                              <form action="newsubcounty.php" method="post">
                                    <div class="form-group">
                                    <label for="scounty">Sub-County Name:</label>
                                    <input type="text" class="form-control" id="scounty" name="scounty" required>
                                    </div>
                                    <button type="submit" class="btn btn-default">Add</button>
                                </form>  
  

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Wards</h4>
                                <p class="category">Input a ward</p>
                            </div>
                            <div class="content">
                               <form action="newward.php" method="post">
                                    <div class="form-group">
                                    <label for="text">Ward Name:</label>
                                    <input type="text" class="form-control" id="ward" name="ward" required>
                                    </div>
                                   <div class="form-group">
                                       <label for="scounty">Sub-County:</label>
                                        <select class="form-control" id="scounty" name="scounty">
                                       <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://localhost/county/getsubcounty.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $subcountyid = $sc["subcountyid"];
                                                                //into a drop down menu
                                                                ?><option value="<?php echo $subcountyid;?>"><?php echo $name;?></option><?php
                                                                }

                                       ?>
                                       
                                       
                                       
                                       
                                       
                                        </select>
                                       
                                 
                                    </div>
                                    <button type="submit" class="btn btn-default">Add</button>
                                </form>   

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sectors</h4>
                                <p class="category">Input a new Sector</p>
                            </div>
                            <div class="content">
                               <form action="newsector.php" method="post">
                                    <div class="form-group">
                                    <label for="sector">Sector Name:</label>
                                    <input type="text" class="form-control" id="sector" name="sector" required>
                                    </div>
                                    <button type="submit" class="btn btn-default">Add</button>
                                </form>   

                            </div>
                        </div>
                    </div>


                </div>




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
