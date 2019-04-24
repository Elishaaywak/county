
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

    <style type="text/css">
       body {
    

   background-size:100%;}
       
    </style>

</head>
<body>
    
    <div>
        <nav class="navbar navbar-inverse navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Service Delivery Monitoring
                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        
                        
                        <li>
                           <a data-toggle="modal" href="#search">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                 
                        <li>
                           <a href="index.php">
                               Home
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-3">
                    <h3>Search Results</h3>
                    <h4>Results for Sectors</h4>
                    <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/searchsector.php?search=$_GET[search]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $serviceid = $sc["serviceid"];
                                                                //into a drop down menu
                                                                ?><li><a href="secreport.php?secid=<?php echo $serviceid;?>"><?php echo $name;?></a></li><?php
                                                                }

                                       ?>  
                                                                <hr/>
                    <h4>Results for Sub-Counties</h4>
                     <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/searchscounty.php?search=$_GET[search]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $scid = $sc["subcountyid"];
                                                                //into a drop down menu
                                                                ?><li><a href="screport.php?scid=<?php echo $scid;?>"><?php echo $name;?></a></li><?php
                                                                }

                                       ?>  
                                                                <hr/>
                    <h4>Results for Wards</h4>
                    <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/searchward.php?search=$_GET[search]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $scid = $sc["scountyid"];
                                                                $wardid=$sc[wardid]
                                                                //into a drop down menu
                                                                ?><li><a href="screport.php?scid=<?php echo $scid;?>&wardid=<?php echo $wardid;?>"><?php echo $name;?></a></li><?php
                                                                }

                                       ?> 
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
