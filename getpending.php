
<?php
//include the database
require 'db.inc.php';
//if the day is set
if (isset($_GET['day']))
{
    $query="SELECT reportdate, COUNT(reportdate) AS number FROM reports WHERE reportdate ='$_GET[day]'AND status='Pending' GROUP BY reportdate ORDER BY reportdate";
}
//if the wardid is set is set
else if (isset($_GET['wardid']))
{
 $query="SELECT reportdate, COUNT(reportdate) AS number FROM reports WHERE wardid ='$_GET[wardid]' AND status='Pending' GROUP BY reportdate ORDER BY reportdate";
}
//if the sectorid is set
else if (isset($_GET['sectorid']))
{
    $query="SELECT reportdate, COUNT(reportdate) AS number FROM reports WHERE serviceid ='$_GET[sectorid]'AND status='Pending' GROUP BY reportdate ORDER BY reportdate";
}
 else 
{
    //else select all
$query="SELECT reportdate, COUNT(reportdate) AS number FROM reports WHERE status='Pending' GROUP BY reportdate ORDER BY reportdate";
}

$query2=mysql_query($query);
while($r = mysql_fetch_assoc($query2)) {
    $rows[] = $r;
}
//json_encode the data
print json_encode($rows);
?>