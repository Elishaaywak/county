<?php
session_start();
//check if the session is set
if (isset($_SESSION['adminid']))
{
    header("Location:admin.php");
}
else if (isset($_SESSION['wuserid']))
{
    header("Location:whome.php");
}
else if (isset($_SESSION['suserid']))
{
    header("Location:shome.php");
}
else if (isset($_SESSION['muserid'])) {
    header("Location:mhome.php");
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
    <h1>Monitoring Service Delivery in County Government</h1>
  </div>

  <div data-role="main" class="ui-content">
      <p align="center"><img src="logo.JPG"/></p>
    <p align="center">Welcome To service Delivery Monitoring in County Government. This is a mobile, web and SMS based system that enable citizens to monitor how the county government is delivering services in Nairobi City County</p>
        <?php
    //if $_Session[success is set, display the message
    if (isset($_SESSION['success']))
    {
        ?>
            <div class="alert alert-success">
                <strong>Success!</strong> <?php echo $_SESSION['success'];?>
            </div>
    <?php
    }
    //unset the session
    unset($_SESSION['success']);
    
    //if $_Session[success is set, display the message
    if (isset($_SESSION['wronglogin']))
    {
        ?>
            <div class="alert alert-danger">
                <strong>Warning!</strong> <?php echo $_SESSION['wronglogin'];?>
                
            </div>
    <?php
    //unset the session
    unset($_SESSION['wronglogin']);
    ?>
    <meta content="2;index.php" http-equiv="refresh" />
    <?php
    }
    
    ?>
     <div data-role="controlgroup" data-type="vertical">
      <a href="report.php" class="ui-btn" data-transition="slide">Report an Event</a>
      <a href="reported.php" class="ui-btn" data-transition="slide">Reported Events</a>
      <a href="login.php" class="ui-btn" data-transition="slide">Login (Sector user/ Ward Admin/Monitoring & Evaluation)</a>
      <a href="help.php" class="ui-btn" data-transition="slide">Help & Support</a>
    </div>
  </div>

  <div data-role="footer" data-position="fixed">
    <h1>Monitoring Service Delivery</h1>
  </div>

</div>
</body>

</html>