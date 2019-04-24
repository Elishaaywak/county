<?php
session_start();

//if the session is not set

//include the database
require'db.inc.php';
//get the variables from the other form
$scounty=$_POST['scounty'];
$ward=$_POST['ward'];

echo $scounty;
//insert into the database
$insert="INSERT INTO wards(name,scountyid) VALUES('$ward','$scounty')";
mysql_query($insert);
//set the session for successful
$_SESSION['success']="You have successfully added a new Ward.";
//redirect back to the admin homepage
header("Location:admin.php")
?>