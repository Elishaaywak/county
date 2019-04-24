<?php
//check the session
session_start();
//include the database
require'db.inc.php';
//get the report id
$reportid=$_GET['reportid'];

//update the database
$update="UPDATE reports SET status= 'Fowarded' WHERE reportid='$reportid'";
mysql_query($update);
//redirect back to the ward admin homepage
$_SESSION['success']="yes";
header("Location:whome.php")
?>