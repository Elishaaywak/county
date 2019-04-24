<?php
//start the session
session_start();
ob_start();
//connect to the database
require'db.inc.php';
//get the variables from the previous page
$name=$_POST['name'];
$email=$_POST['email'];
$telephone=$_POST['telephone'];
$wardid=$_POST['wardid'];
$serviceid=$_POST['serviceid'];
$report=$_POST['report'];
$report=mysql_real_escape_string($report);
$nearest=$_POST['nearest'];
$lat=$_POST['lat'];
$lon=$_POST['lon'];
$status="Pending";
$comment="NULL";
$photo="NULL";
$date= date('Y/m/d');
$time=time();

//insert into the database
$insert="INSERT INTO reports(name,email,telephone,wardid,serviceid,report,longitude,latitude,status,comments,photo,reportdate,reporttime,attachment,nearest)
         VALUES ('$name','$email','$telephone','$wardid','$serviceid','$report','$lon','$lat','$status','$comment','$photo','$date',NOW(),'','$nearest')";
mysql_query($insert) or trigger_error($insert);
//get the id of that uploaded file
$theid="SELECT * FROM reports WHERE name='$name' AND longitude='$lon' AND reportdate='$date'";
$theid2=mysql_query($theid);
while ($theid3= mysql_fetch_array($theid2))
{
    $thatid=$theid3['reportid'];
    echo"thatid: $thatid";
}


$info = pathinfo($_FILES['file']['name']);
$ext = $info['extension']; // get the extension of the file
$newname = "$thatid.".$ext; 

$target = 'uploads/'.$newname;
if (move_uploaded_file( $_FILES['file']['tmp_name'], $target))
{
    //update the database
    $update="UPDATE reports SET attachment='$newname' WHERE reportid='$thatid'";
    mysql_query($update);
}
//send email to the user

//upload the photo if there


//Go to the MOBILESASA API page


//set the session for success
$_SESSION['success']="Congratulations! You have successfully reported an event";
header("Location:index.php");
?>