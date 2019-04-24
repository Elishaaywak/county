<?php
//check the session

//include the database
require'db.inc.php';
//get the variables from the previous page
$reportid=$_POST['reportid'];
$reason=$_POST['reason'];
$status="Rejected";
echo $reason;
//update the database
//update the database
$update="UPDATE reports SET status= 'Dismissed' WHERE reportid='$reportid'";
mysql_query($update);


//update the database
$update2="UPDATE reports SET comments= '$reason' WHERE reportid='$reportid'";
mysql_query($update2);

//set the session for success
$_SESSION['success']="yes";

//go to the homepage
header("Location:whome.php");
?>
