<?php
//include the database
require 'db.inc.php';

//if the serviceid is set
if (isset($_GET['parentid']))
{
    $sc="SELECT * FROM parent_sector WHERE parentid='$_GET[parentid]'";
}
 else 
    
 {
    //get all the services
$sc="SELECT * FROM parent_sector ORDER BY name";
 }

$sc2=mysql_query($sc);
$rows = array();
while($r = mysql_fetch_assoc($sc2)) {
    $rows[] = $r;
}
print json_encode($rows);

//json-encode the sub-counties
?>