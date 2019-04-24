<?php
//start the session
session_start();

ob_Start();
//check if the session is set
if (isset($_SESSION['adminid']))
{
    header("Location:admin.php");
}
else if (isset($_SESSION['wuserid']))
{
    header("Location:whome.php");
}
else if (isset($_SESSION['suserid']))
{
    header("Location:shome.php");
}
else if (isset($_SESSION['muserid'])) {
    header("Location:mhome.php");
}

//include the database
require 'db.inc.php';
//get the variables
$email=$_POST['email'];
$password=$_POST['password'];
$type=$_POST['type'];

echo $type;
//check if the variables are correct

//if the type is ward administrator

//if the type is sector user
if ($type=="sector")
{
    $query="SELECT * FROM sector_users WHERE (email='$email' AND password='$password') OR (telephone='$email' AND password='$password')";      
    echo $query;
}
//if the type is ward administrator
else if ($type=="ward")
{
    $query="SELECT * FROM ward_admin WHERE (email='$email' AND password='$password') OR (telephone='$email' AND password='$password')";
}
//if the type is monitoring & evaluation officer
else if ($type=="monitoring")
{
    $query="SELECT * FROM monitoring WHERE (email='$email' AND password='$password') OR (telephone='$email' AND password='$password')";
    echo $query;
}
//set the session for userid (ward administrator or sector user)
   $query2=(mysql_query($query));
   $result=(mysql_num_rows($query2));
   echo $result;
//redirect to the required page using if
//if the type is sector user
if (($type=="sector") && ($result>0))
{
    //get the sectorid and sety it in teh session
    while ($getme=mysql_fetch_array($query2))
    {
        $_SESSION['suserid'] = $getme['userid'];
        header("Location:shome.php");
    }
}
//if the type is ward
else if (($type=="ward") && ($result>0))
{
    //get the adminid and set it intot the session
    while ($getme=mysql_fetch_array($query2))
    {
        $_SESSION['wuserid']= $getme['adminid'];
       //echo $_SESSION['wuserid'];
       header("Location:whome.php");
    }
}
//if the type is ward
else if (($type=="monitoring") && ($result>0))
{
    //get the adminid and set it intot the session
    while ($getme=mysql_fetch_array($query2))
    {
        $_SESSION['muserid']= $getme['userid'];
       echo $_SESSION['muserid'];
       header("Location:mhome.php");
    }
}
 else 
   //if they are wrong go back to the prevoius page with wronglogin set to true 
 {
     $_SESSION['wronglogin']= "You have entered the wrong Username/ Password combination or the wrong User Type. Please try again.";
    header("Location:index.php");
 }

?>