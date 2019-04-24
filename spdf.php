<?php
session_start();
//check if the session is set
if (!isset($_SESSION['suserid']))
{
   header("Location:index.php");
}
//the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getsuser.php?suserid=$_SESSION[suserid]");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $sectorid=$sc["serviceid"];
                                                                $thesector=$sectorid;
                                                                }

                                       //get the name of the ward
                                        $sector_link=file_get_contents("http://www.prisconet.com/apps/county/getsector.php?sectorid=$sectorid");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($sector_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $sectorname = $sc["name"];
                                                                $sectorid=$sc["sectorid"];
                                                                
                                                                }
                                ?>
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
            <a href="convert_sector.php?page=pdf2&sectorid=<?php echo $thesector; ?>" class="btn btn-default">Download PDF</a>&nbsp;&nbsp;&nbsp;<a href="index.php" class="btn btn-default">Homepage</a>
            <h1>MONITORING SERVICE DELIVERY IN COUNTY GOVERNMENT</h1>
            <h2>A case of Nairobi County</h2>
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
                Reports in this sector - <?php echo $sectorname; ?>
            </h3>
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
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                //get the reported events in this sector in a table
                                
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?sectorid=$thesector");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($scounty_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $reportid=$sc['reportid'];
                                                                $name = $sc['name'];
                                                                $email=$sc['email'];
                                                                $telephone=$sc['telephone'];
                                                                $report=$sc['report'];
                                                                $nearest=$sc['nearest'];
                                                                $status=$sc['status'];
                                                                $date=$sc['reportdate'];
                                                                $time=$sc['reporttime'];
                                                                
                                                                //into the table
                                                                
                                                                ?>
                                    <tr><td><?php echo $name;?></td><td><?php echo $email;?></td><td><?php echo $telephone;?></td><td><?php echo $report;?></td><td><?php echo $nearest;?></td>
                                        <td><?php echo $date;?></td><td><?php echo $time;?></td><td><?php echo $status;?></td><td><a href="sdetails.php?reportid=<?php echo $reportid;?>">Details</a></td></tr>
                                                              <?php
                                                                }

                                      
                                ?>
                            </tbody>
                            </table>
        </div>
        
         <div>
            <h3 id="header2">
                Summary
            </h3>
             <b>All reported Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getsummary.php?sectorid=$thesector");
              echo $thesummary;
              ?>
             <br/>
             <b>Pending Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getsummary.php?status=Pending&sectorid=$thesector");
              echo $thesummary;
              ?>
             <br/>
             <b>Solved Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getsummary.php?status=Resolved&sectorid=$thesector");
              echo $thesummary;
              ?>
             <br/>
             <b>Fowarded Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getsummary.php?status=Fowarded&sectorid=$thesector");
              echo $thesummary;
              ?>
             <br/>
             <b>Dismissed Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getsummary.php?status=Dismissed&sectorid=$thesector");
              echo $thesummary;
              ?>
             <br/>
         </div> 
    </body>
</html>