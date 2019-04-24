<?php
//include the database
require 'db.inc.php';

//if the serviceid is set
if (isset($_GET['serviceid']))
{
    $sc="SELECT * FROM services WHERE serviceid='$_GET[serviceid]'";
}
 else 
    
 {
    //get all the services
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