<?php
//include the database
require 'db.inc.php';

//if the scountyid is set
if (isset($_GET['sectorid']))
{
    $sc="SELECT * FROM services WHERE serviceid='$_GET[sectorid]' ORDER BY name";
}
//if it is not set, get all the sub-counties
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