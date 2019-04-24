<?php
//include the database
require 'db.inc.php';

//if the sectorid is set
if (isset($_GET['sectorid']))
{
    $sc="SELECT * FROM services WHERE serviceid='$_GET[sectorid]' ORDER BY name";
}
//if it is SMS
else if (isset($_GET['sms']))
{
    $sc="SELECT * FROM services ORDER BY serviceid";
}
//if it is not set, get all the sectors
else 
    
{
    $sc="SELECT * FROM services ORDER BY name";
}

$sc2=mysql_query($sc);
$rows = array();
while($r = mysql_fetch_assoc($sc2)) {
    $rows[] = $r;
}
print json_encode($rows);

//json-encode the sub-counties
?>