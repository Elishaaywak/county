<html>
    <head>
        <!-- Include the jQuery library -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function () {
        // Handler for .ready() called.
        window.setTimeout(function () {
        location.href = "viewreport.php?secid=<?php echo $_GET['secid'];?>";
        }, 2000);
        });
    </script>
    </head>
    
        
</html>
<body>
    <blockquote>loading...</blockquote>
</body>