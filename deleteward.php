<?php
//start the session
session_start();
//check if the session is set
//include the database
require 'db.inc.php';
//get the variable from the previous page
$wardid=$_GET['wardid'];
//delete the ward
$delete="DELETE FROM wards WHERE wardid='$wardid'";
mysql_query($delete);
//delete the ward administrators
$deletea="DELETE FROM ward_admin WHERE wardid='$wardid'";
mysql_query($deletea);
//delete the reported occurances
$deleter="DELETE FROM reports WHERE wardid='$wardid'";
mysql_query($deleter);
//set the session for success
$_SESSION['success']="yes";
//back to the awards page
header("Location:awards.php");
?>
