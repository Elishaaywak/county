<?php
//start the session
session_start();
//check if the session is set

//include the database
require 'db.inc.php';
//get the variables of the sub-county
$scountyid=$_GET['scountyid'];
//delete the sub-county
$delete="DELETE FROM sub_county WHERE subcountyid='$scountyid'";
mysql_query($delete);


//get the wards in the sub-county
$thewards="SELECT * FROM wards WHERE scountyid='$scountyid'";
$thewards2=mysql_query($thewards);
while ($thewards3=mysql_fetch_array($thewards2))
{
    //get the wardid
    $wardid=$thewards['wardid'];
    //delete the ward administrators
    $deleteadmin="DELETE FROM ward_admin WHERE wardid='$wardid'";
    mysql_query($deleteadmin);
    //delete the reported events
    $deleteevent="DELETE FROM reports WHERE wardid='$wardid'";
    mysql_query($deleteevent);
}
//
//delete the wards in that sub-county
$deletewards="DELETE FROM wards WHERE scountyid='$scountyid'";
mysql_query($deletewards);

//set the session for success
$_SESSION['success']="yes";
//back to the awards page
header("Location:awards.php");
?>