<?php
//include the database
require 'db.inc.php';
//if the reportid is set, get it
if (isset($_GET['reportedid']))
{
    $query="SELECT * FROM reports WHERE reportid='$_GET[reportedid]' ORDER BY reportid DESC";
}

//if the wardid, startdate and enddate is set
else if ((isset($_GET['startdate']))&&(isset($_GET['enddate'])))
{
    $startdate=$_GET['startdate'];
    $enddate=$_GET['enddate'];
    $query="SELECT * FROM reports WHERE reportdate BETWEEN '$startdate' AND '$enddate' ORDER BY reportid DESC";
}
//if the wardid and the status is set, get it
else if ((isset($_GET['wardid'])) && (isset($_GET['status'])))
{
    $query="SELECT * FROM reports WHERE wardid='$_GET[wardid]' AND status='$_GET[status]' ORDER BY reportid DESC";
}
//if the wardid is set and the user is public
else if (isset($_GET['wardid']) &&($_GET['user']="public"))
{
    $query="SELECT * FROM reports WHERE wardid='$_GET[wardid]' ORDER BY reportid DESC";
}


//if the wardid is set, get it
else if (isset($_GET['wardid']))
{
    $query="SELECT * FROM reports WHERE wardid='$_GET[wardid]' ORDER BY reportid DESC";
}

//if the sectorid and the status is set, get it
else if ((isset($_GET['sectorid'])) && (isset($_GET['status'])))
{
    $query="SELECT * FROM reports WHERE serviceid='$_GET[sectorid]' AND status='$_GET[status]' ORDER BY reportid DESC";
}
//if the sectorid, the status and the resolver is set, get it
else if ((isset($_GET['sectorid'])) && (isset($_GET['status'])) && (isset($_GET['resolver'])))
{
    $query="SELECT * FROM reports WHERE serviceid='$_GET[sectorid]' AND status='$_GET[status]' AND resolver='Ward Administrator' ORDER BY reportid DESC";
}
//if the sectorid is set, get it
else if (isset($_GET['sectorid']))
{
    $query="SELECT * FROM reports WHERE serviceid='$_GET[sectorid]' ORDER BY reportid DESC";
}

//else get all of them
else 
{
    $query="SELECT * FROM reports ORDER BY reportid DESC";
}

$ad2=mysql_query($query);
$rows = array();
while($r = mysql_fetch_assoc($ad2)) {
    $rows[] = $r;
}
print json_encode($rows);

//json-encode the sub-counties

?>