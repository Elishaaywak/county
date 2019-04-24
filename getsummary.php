<?php
require'db.inc.php';

//if the sectorid and the status is set
if ((isset ($_GET['status'])) && (isset ($_GET['sectorid'])))
{
    //the query
    $query="SELECT * FROM reports WHERE status='$_GET[status]' AND serviceid='$_GET[sectorid]'";
} 
//if the wardid and the status is set
else if ((isset ($_GET['status'])) && (isset ($_GET['wardid'])))
{
    //the query
    $query="SELECT * FROM reports WHERE status='$_GET[status]' AND wardid='$_GET[wardid]'";
} 
//if the sectorid is set
else if (isset ($_GET['sectorid']))
{
    //the query
    $query="SELECT * FROM reports WHERE serviceid='$_GET[sectorid]'";
} 
//if the wardid is set
else if (isset ($_GET['wardid']))
{
    //the query
    $query="SELECT * FROM reports WHERE wardid='$_GET[wardid]'";
} 
//if the status is set
else if (isset ($_GET['status']))
{
    //the query
    $query="SELECT * FROM reports WHERE status='$_GET[status]'";
} 
//if the status  and the sectorid is not set
else
{
    $query="SELECT * FROM reports";
}

$query2=mysql_query($query);
$query3=mysql_num_rows($query2);

echo $query3;