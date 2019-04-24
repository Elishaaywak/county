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

    </head>
    <body>
<div data-role="page">

  <div data-role="header">
      <a href="#myPanel" class="ui-btn ui-btn-inline">Menu</a>
    <h1>Report a new Event</h1>
  </div>
    <div data-role="panel" id="myPanel">
  <h2>Menu</h2>
  <p>
      <div data-role="controlgroup" data-type="vertical">
      <a href="index.php" class="ui-btn">Home</a>
      <a href="reported.php" class="ui-btn">Reported Events</a>
      <a href="login.php" class="ui-btn">Login (Sector user/ Ward Admin)</a>
      <a href="help.php" class="ui-btn">Help & Support</a>
    </div>
      
      
      
  </p>
</div>
  <div data-role="main" class="ui-content">
    <p>Welcome To service Delivery Monitoring in County Government. This is a mobile, web and SMS based system that enable citizens to monitor how the county government is delivering services in Nairobi City County</p>
  
     <div data-role="controlgroup" data-type="vertical">
      <a href="report.php" class="ui-btn">Report an Event</a>
      <a href="reported.php" class="ui-btn">Reported Events</a>
      <a href="login.php" class="ui-btn">Login (Sector user/ Ward Admin)</a>
      <a href="help.php" class="ui-btn">Help & Support</a>
    </div>
  </div>

  <div data-role="footer" data-position="fixed">
    <h1>Monitoring Service Delivery</h1>
  </div>

</div>
</body>

</html>