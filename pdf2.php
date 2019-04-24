<html>
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

    <script async defer
                                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA6UsI3A8Y5gA70h2LMKCKFyXOMq9VE8w&callback=initMap">
                                        </script>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <script type="text/javascript" src="assets/canvasjs.min.js"></script> 
        <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
        <style>
            #header{
                width: 100%;
                background-color: #99ccff;
                border-style: outset;
            }
            #header2{
                width: 100%;
                background-color: #161616;
                color: #63d8f1;
                border-style: inset;
            }
            
        </style>
    </head>
    <body>
        <div id="header"align="center">
            <h1>MONITORING SERVICE DELIVERY IN COUNTY GOVERNMENT</h1>
            <h2>A case of Nairobi County</h2>
            <hr/>
        </div>
        <div>
            <h3 id="header2">
                About the system
            </h3>
            <p>This is a Mobile, Web and SMS based Systems that allows residents of Nairobi County in Kenya to report to the county government services that are not being delivered as required.</p>

<p>The system also allows the residents of the County to get feedback from the County Government on the status of various service delivery issues that have been reported by the residents of the county.</p>
      
        </div>
        <div>
            <h3 id="header2">
                Services in the county government
            </h3>
            <?php
            //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getservice.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        $x=1;
                                        foreach ($data as $sc) 
                                            {
                                                                $name = $sc["name"];
                                                                $serviceid = $sc["serviceid"];
                                                                $description=$sc["description"];
                                                                $parentid=$sc["parentid"];
                                                                
                                                                //if this is a sub-sector, display the sector first
                                                                if ($parentid>0)
                                                                {
                                                                     $parent_link=file_get_contents("http://www.prisconet.com/apps/county/getparent.php?parentid=$parentid");
                                                                     error_reporting(E_ERROR | E_PARSE);        
                                                                     $parent_data = json_decode($parent_link,true);
                                                                    foreach ($parent_data as $pr) 
                                                                        {
                                                                        $parent_name=$pr["name"];
                                                                        }
                                                                   echo "<h4>$x. $name -<small>$parent_name</small></h4><blockquote>$description</blockquote><hr/>";
                                                                       
                                                                } 
                                                                else
                                                                {
                                                                     echo "<h4>$x. $name</h4><blockquote>$description</blockquote><hr/>";
                                                                   
                                                                }
                                                             
                                                               $x++;
                                            }
                                       
                       //display the description of the service
                                                                
                                                                ?>
            <?php
            //get the services and their description
            
            ?>
        </div>
        <div>
            <h3 id="header2">
                Sub-counties and wards
            </h3>
            <?php
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getsubcounty.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $scountyid = $sc["subcountyid"];
                                                                //into the url
                                                                echo "<h4><u>$name Sub-County</u></h4>";?>
                                                                <?php
                                                                //get the wards as a link
                                                                $ward_link=file_get_contents("http://www.prisconet.com/apps/county/getward.php?scountyid=$scountyid");
                                                                error_reporting(E_ERROR | E_PARSE);        
                                                                $data = json_decode($ward_link,true);
                                                                    $z=1;
                                                                foreach ($data as $wd) 
                                                                    {
                                                                    $wardname = $wd["name"];
                                                                    $wardid = $wd["wardid"];
                                                                    ?><?php echo "$z. $wardname";?><br/>
                                                                    <?php
                                                                    $z++;
                                                                    }
                                                                    echo"<hr/>";
                                                                }

                                       ?>   
                                  
        </div>
        <div>
            <h3 id="header2">
                Reports per ward
            </h3>
            <?php
                        //get the name of the ward
                        //the url to call the json data
                                        $wards_link=file_get_contents("http://www.prisconet.com/apps/county/getward.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($wards_link,true);
                                        
                                        foreach ($data as $wd) {
                                                                $xx="no";
                                           
                                                                $ward_name = $wd["name"];
                                                                $wardid = $wd["wardid"];
                                                                ?><?php echo "<h4>$ward_name Ward</h4>";
                                                                
                                                                ?>
            <h6>
                Details
            </h6>
            <table class="table table-striped">
                                <thead>
                                    <tr>
                                      <th>Full Name</th>
                                      <th>Report</th>
                                      <th>Nearest Location</th>
                                      <th>Date</th>
                                      <th>Time</th>
                                      <th>Status</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>                            
                                                                   <?php
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
                                                                $status=$sc['status'];
                                                                $latitude=$sc['latitude'];
                                                                
                                                                //into the table                                          
                                                                ?>
                                    <tr><td><?php echo $name;?></td><td><?php echo $report;?></td><td><?php echo $nearest;?></td><td><?php echo $date;?></td><td><?php echo $time;?></td><td><?php echo $status;?></td>
                                        </tr>
                                                              <?php
                                                                }         
                                ?>                      
                                                </tbody>
                                                </table>
            <?php
                                        }
                    ?>
        </div>
        
        <div>
            <h3 id="header2">
                Reports per sector
            </h3>
            <?php
                        //get the name of the ward
                        //the url to call the json data
                                        $wards_link=file_get_contents("http://www.prisconet.com/apps/county/getsector.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($wards_link,true);
                                        
                                        foreach ($data as $wd) {
                                                                $xx="no";
                                           
                                                                $sector_name = $wd["name"];
                                                                $sectorid = $wd["serviceid"];
                                                                $parentid=$wd["parentid"];
                                                                
                                                                //if this is a sub-sector, display the sector first
                                                                if ($parentid>0)
                                                                {
                                                                     $parent_link=file_get_contents("http://www.prisconet.com/apps/county/getparent.php?parentid=$parentid");
                                                                     error_reporting(E_ERROR | E_PARSE);        
                                                                     $parent_data = json_decode($parent_link,true);
                                                                    foreach ($parent_data as $pr) 
                                                                        {
                                                                        $parent_name=$pr["name"];
                                                                        }
                                                                   echo "<h4>$x. $sector_name -<small>$parent_name</small></h4>";
                                                                       
                                                                } 
                                                                else
                                                                {
                                                                     echo "<h4>$x. $sector_name</h4>";
                                                                   
                                                                }
                                                                ?>
            <h6>
                Details
            </h6>
            <table class="table table-striped">
                                <thead>
                                    <tr>
                                      <th>Full Name</th>
                                      <th>Report</th>
                                      <th>Nearest Location</th>
                                      <th>Date</th>
                                      <th>Time</th>
                                      <th>Status</th>                
                                    </tr>
                                </thead>
                                <tbody>                            
                                                                   <?php
                                                                   //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?sectorid=$sectorid");
                                      
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportid=$sc['reportid'];
                                                                $name = $sc['name'];
                                                                $report=$sc['report'];
                                                                $nearest=$sc['nearest'];
                                                                $date=$sc['reportdate'];
                                                                $time=$sc['reporttime'];
                                                                $status=$sc['status'];
                                                                $latitude=$sc['latitude'];
                                                                
                                                                //into the table                                          
                                                                ?>
                                    <tr><td><?php echo $name;?></td><td><?php echo $report;?></td><td><?php echo $nearest;?></td><td><?php echo $date;?></td><td><?php echo $time;?></td><td><?php echo $status;?></td>
                                        </tr>
                                                              <?php
                                                                }         
                                ?>                      
                                                </tbody>
                                                </table>
            <?php
                                        }
                    ?>
        </div>
         <div>
            <h3 id="header2">
                Summary
            </h3>
             <b>All reported Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getsummary.php");
              echo $thesummary;
              ?>
             <br/>
             <b>Pending Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getsummary.php?status=Pending");
              echo $thesummary;
              ?>
             <br/>
             <b>Solved Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getsummary.php?status=Solved");
              echo $thesummary;
              ?>
             <br/>
             <b>Fowarded Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getsummary.php?status=Fowarded");
              echo $thesummary;
              ?>
             <br/>
             <b>Dismissed Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getsummary.php?status=Dismissed");
              echo $thesummary;
              ?>
             <br/>
         </div> 
    </body>
</html>