<?php
//include the database
require 'db.inc.php';
//get all the sub-counties
$sc="SELECT * FROM admin WHERE adminid='$_GET[adminid]'";
$sc2=mysql_query($sc);
$rows = array();
while($r = mysql_fetch_assoc($sc2)) {
    $rows[] = $r;
}
print json_encode($rows);

//json-encode the sub-counties
?>