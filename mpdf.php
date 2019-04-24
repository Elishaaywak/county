<?php
session_start();
//check if the session is set
if (!isset($_SESSION['muserid']))
{
   header("Location:index.php");
}
//the url to call the json data
                                        $monitoring_link=file_get_contents("http://www.prisconet.com/apps/county/getmonitoring.php");
                                        error_reporting(E_ERROR | E_PARSE);        
                                        $data = json_decode($monitoring_link,true);
                                        
                                        foreach ($data as $sc) {
                                                                $name = $sc["name"];
                                                                $sub_countyid=$sc["sub_countyid"];
                                                               
                                                                }
                                         //get the name of the sub county
                                        $sector_link=file_get_contents("http://www.prisconet.com/apps/county/getsubcounty.php?scountyid=$sub_countyid");
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
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
        function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#mainbody')[0];

    // we support special element handlers. Register them with jQuery-style 
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors 
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 0,
        bottom: 0,
        left: 0,
        width: 700
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('Download.pdf');
    }, margins);
}
    </script>

    <script async defer
                                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA6UsI3A8Y5gA70h2LMKCKFyXOMq9VE8w&callback=initMap">
                                        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
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
       <a href="convert_monitoring.php?page=pdf2&sub_countyid=<?php echo $sub_countyid; ?>" class="btn btn-default">Download PDF</a>&nbsp;&nbsp;&nbsp;<a href="index.php" class="btn btn-default">Homepage</a>
        <div id="mainbody">
        <div id="header"align="center">
            <h1>MONITORING SERVICE DELIVERY IN COUNTY GOVERNMENT</h1>
            <h2>A case of Nairobi County</h2>
            <hr/>
           
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
                Reports in this Sub-County - <?php echo $sectorname; ?>
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
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                //get the reported events in this sector and displaythem in a table
                                
                                       //the url to call the json data
                                        $scounty_link=file_get_contents("http://www.prisconet.com/apps/county/getreport.php?scountyid=$sub_countyid");
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
                                                                                        if ($thesubcounty==$sub_countyid)
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
        
         <div>
            <h3 id="header2">
                Summary
            </h3>
             <b>All reported Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getmpdf.php?sub_countyid=$sub_countyid");
              echo $thesummary;
              ?>
             <br/>
             <b>Pending Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getmpdf.php?sub_countyid=$sub_countyid&status=Pending");
              echo $thesummary;
              ?>
             <br/>
             <b>Solved Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getmpdf.php?sub_countyid=$sub_countyid&status=Resolved");
              echo $thesummary;
              ?>
             <br/>
             <b>Fowarded Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getmpdf.php?sub_countyid=$sub_countyid&status=Fowarded");
              echo $thesummary;
              ?>
             <br/>
             <b>Dismissed Events: </b>
             <?php
               //the url to call
              $thesummary=file_get_contents("http://www.prisconet.com/apps/county/getmpdf.php?sub_countyid=$sub_countyid&status=Dismissed");
              echo $thesummary;
              ?>
             <br/>
         </div> 
    </body>
</html>