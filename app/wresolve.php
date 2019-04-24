<?php
//check the session

ob_start();
//include the database
require'db.inc.php';
//get the variables from the previous page
$reportid=$_POST['reportid'];
$reason=$_POST['reason'];
$status="Resolved";
echo $reason;
//update the database
//update the database
$update="UPDATE reports SET status= 'Resolved' WHERE reportid='$reportid'";
mysql_query($update);


//update the database
$update2="UPDATE reports SET comments= '$reason' WHERE reportid='$reportid'";
mysql_query($update2);

//update the database
$update3="UPDATE reports SET resolver= 'Ward Administrator' WHERE reportid='$reportid'";
mysql_query($update3);

//get the email address of the person who sent

$get_email="SELECT * FROM reports WHERE reportid='$reportid'";
$get_email2=mysql_query($get_email);
while ($get_email3=mysql_fetch_array($get_email2))
{
    $email_address=$get_email3['email'];
}
//send an email to the user with the message from the ward admin
mail($email_address,"Monitoring Service Delivery in Nairobi County",$reason, "Service Delivery Monitoring");



//set the session for success
$_SESSION['success']="yes";

//go to the homepage
header("Location:whome.php");
?>
