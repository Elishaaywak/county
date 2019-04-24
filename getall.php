<?php
//include the database
require 'db.inc.php';
//if the day is set

//if the countyid is set

//if the sectorid is set

//json_encode the data

//else select all
$query="SELECT * FROM reports WHERE wardid='$_GET[wardid]'";
$query2=mysql_query($query);
while($r = mysql_fetch_assoc($query2)) {
    $rows[] = $r;
}
print json_encode($rows);
?>