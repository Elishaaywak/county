<?php
//include the database
require 'db.inc.php';
//if the wardid is set, get the administrators from that ward
if (isset($_GET['sectorid']))
{
    $ad="SELECT * FROM sector_users WHERE serviceid='$_GET[sectorid]' ORDER BY name";
}
//if the sector user id is set get the details
else if (isset($_GET['suserid']))
{
    $ad="SELECT * FROM sector_users WHERE userid='$_GET[suserid]'";
}
//if nothing is set
else
{
    $ad="SELECT * FROM sector_users";
}
$ad2=mysql_query($ad);
$rows = array();
while($r = mysql_fetch_assoc($ad2)) {
    $rows[] = $r;
}
print json_encode($rows);

//json-encode the sub-counties
?>