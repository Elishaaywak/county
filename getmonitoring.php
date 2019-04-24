<?php
session_start();
ob_start();
//include the database
require 'db.inc.php';
//if the monitoringid is set, get the exact monitoring and evaluation officer

if (isset($_GET['muserid']))
{
    $ad="SELECT * FROM monitoring WHERE userid='$_GET[muserid]'";
}
//if sub-county is set
else if (isset($_GET['subcountyid']))
{
    $ad="SELECT * FROM monitoring WHERE sub_countyid='$_GET[sub_countyid]'";
}
//if nothing is set
else
{
    $ad="SELECT * FROM monitoring";
}
$ad2=mysql_query($ad);
$rows = array();
while($r = mysql_fetch_assoc($ad2)) {
    $rows[] = $r;
}
print json_encode($rows);
//json-encode the sub-counties
?>

