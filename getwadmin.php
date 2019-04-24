<?php
//include the database
require 'db.inc.php';
//if the wardid is set, get the administrators from that ward
if (isset($_GET['wardid']))
{
    $ad="SELECT * FROM ward_admin WHERE wardid='$_GET[wardid]' ORDER BY name";
}
//if the adminid is set, get the adimin
else if (isset($_GET['adminid']))
{
    $ad="SELECT * FROM ward_admin WHERE adminid='$_GET[adminid]'";
}
//if nothing is set
else
{
    $ad="SELECT * FROM ward_admin";
}
$ad2=mysql_query($ad);
$rows = array();
while($r = mysql_fetch_assoc($ad2)) {
    $rows[] = $r;
}
print json_encode($rows);

//json-encode the sub-counties
?>