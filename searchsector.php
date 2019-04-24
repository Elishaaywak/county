<?php
//include the database
require 'db.inc.php';

//if the sectorid is set
if (isset($_GET['search']))
{
    $sc="SELECT * FROM services WHERE name LIKE '%$_GET[search]%' ORDER BY name";

$sc2=mysql_query($sc);
$rows = array();
while($r = mysql_fetch_assoc($sc2)) {
    $rows[] = $r;
}
print json_encode($rows);
}
//json-encode the sub-counties
?>