<?php
//include the database
require 'db.inc.php';
//if the sub-countyid id set
if (isset($_GET['scountyid']))
{
    $sc="SELECT * FROM wards WHERE scountyid='$_GET[scountyid]' ORDER BY name";
}
//if the wardid is set
else if (isset($_GET['wardid']))
{
    $sc="SELECT * FROM wards WHERE wardid='$_GET[wardid]' ORDER BY name";
}
//if it is SMS
else if (isset($_GET['sms']))
{
    $sc="SELECT * FROM wards ORDER BY wardid";
}
else 
   //if it is not set, get all the wards 
{
    $sc="SELECT * FROM wards ORDER BY name";
}


//get all the sub-counties

$sc2=mysql_query($sc);
$rows = array();
while($r = mysql_fetch_assoc($sc2)) {
    $rows[] = $r;
}
print json_encode($rows);

//json-encode the sub-counties
?>