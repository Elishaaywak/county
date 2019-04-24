<?php
//include the database
require 'db.inc.php';
//get the sub_countyid
$sub_countyid=$_GET['sub_countyid'];
$status=$_GET['status'];

//get all the wards in the sub_county
$getwards="SELECT * FROM wards WHERE scountyid='$sub_countyid'";
//get all the records in each ward depending on which value is set ie all records, pending, confirmed etc
$getwards2=mysql_query($getwards);

//get specific statuses
$x=0;
//get all the statuses
while ($getwards3=mysql_fetch_array($getwards2))
{
    //query to get the reported events
    $reported="SELECT * FROM reports WHERE wardid='$getwards3[wardid]'";
    $reported2=mysql_query($reported);
    while ($reported3=mysql_fetch_array($reported2))
    {
        //store the value in a variable and increment 
        if ($reported3['status']==$status)
        {
            $x++;
        }
        $y++;
        
        
    }
        
}
//if the status is set
if (isset($_GET['status']))
//if the status is noto set
{
    echo $x;
}
else
{
    echo $y;
}


?>