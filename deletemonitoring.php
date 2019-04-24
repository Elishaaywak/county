<?php
//start the session
session_start();
//check if the session is set
//include the database
require 'db.inc.php';
//get the variable from the previous page
$userid=$_GET['userid'];
//delete the ward
$delete="DELETE FROM monitoring WHERE userid='$userid'";
mysql_query($delete);

//set the session for success
$_SESSION['success']="yes";
//back to the awards page
header("Location:amonitoring.php");
?>
