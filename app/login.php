<?php
session_start();
//check if the session is set
if (isset($_SESSION['adminid'])) {
    header("Location:admin.php");
} else if (isset($_SESSION['wuserid'])) {
    header("Location:whome.php");
} else if (isset($_SESSION['suserid'])) {
    header("Location:shome.php");
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
      <a href="#myPanel" class="ui-btn ui-btn-inline">Menu</a>
    <h1>Report a new Event</h1>
  </div>
    <div data-role="panel" id="myPanel">
  <h2>Menu</h2>
  <p>
      <div data-role="controlgroup" data-type="vertical">
      <a href="index.php" class="ui-btn">Home</a>
      <a href="reported.php" class="ui-btn">Reported Events</a>
      <a href="help.php" class="ui-btn">Help & Support</a>
    </div>
      
      
      
  </p>
</div>
  <div data-role="main" class="ui-content">
    <h2>Login</h2>
    <?php
     //if $_Session[success is set, display the message
            if (isset($_SESSION['wronglogin'])) {
                ?>
                <div class="alert alert-danger">
                    <strong>Warning!</strong> <?php echo $_SESSION['wronglogin']; ?><br/><hr/>
                </div>
                <?php
                //unset the session
                unset($_SESSION['wronglogin']);
            }
            ?>
    <form action="login_red.php" method="post">
                                                <div class="form-group">
                                                    <label for="email">Email address/Telephone :</label>
                                                    <input type="text" class="form-control" id="email" name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pwd">Password:</label>
                                                    <input type="password" class="form-control" id="password" name="password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pwd">User type:</label>
                                                    <Select class="form-control" id="type" name="type" required>
                                                        <option value="ward">Ward Administrator</option>
                                                        <option value="sector">Sector User</option>
                                                        <option value="monitoring">Monitoring & Evaluation</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-success">Login</button>
                                            </form>
    
  </div>

  <div data-role="footer" data-position="fixed">
    <h1>Monitoring Service Delivery</h1>
  </div>

</div>
</body>

</html>