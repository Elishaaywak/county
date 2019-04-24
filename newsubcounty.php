<?php
session_start();

//if the session is not set

//include the database
require'db.inc.php';
//get the variables from the other form
$scounty=$_POST['scounty'];
//insert into the database
echo $scounty;
$insert="INSERT INTO sub_county(name) VALUES('$scounty')";
mysql_query($insert);
//set the session for successful
$_SESSION['success']="You have successfully added a new Sub-County";
//redirect back to the admin homepage
header("Location:admin.php")
?>