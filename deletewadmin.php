<?php
//start the session
session_start();
//check if the session is set
//include the database
require 'db.inc.php';
//get the variable from the previous page
$adminid=$_GET['adminid'];
//delete the ward
$delete="DELETE FROM ward_admin WHERE adminid='$adminid'";
mysql_query($delete);

//set the session for success
$_SESSION['success']="yes";
//back to the awards page
header("Location:awadmin.php");
?>
