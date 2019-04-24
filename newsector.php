<?php
session_start();

//if the session is not set

//include the database
require'db.inc.php';
//get the variables from the other form
$sector=$_POST['sector'];
$description=$_POST['description'];
//insert into the database
$insert="INSERT INTO services(name, description) VALUES('$sector','$description')";
mysql_query($insert);
//set the session for successful
$_SESSION['success']="You have successfully added a new sector";
//redirect back to the admin homepage
header("Location:admin.php")
?>