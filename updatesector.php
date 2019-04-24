<?php
//start the session
session_start();

ob_start();
//if the session is no tset, redirect to the homepage

//include the database
require'db.inc.php';
//if the name is set, update it
echo $_POST['sector'];
echo $_POST['serviceid'];

 $query="UPDATE services SET name='$_POST[sector]' WHERE serviceid='$_POST[serviceid]'";
 mysql_query($query) or trigger_error($query);     
 
 $_SESSION['success']="Successfuly Updated";
 
 //redirect back to the auser page
header("Location:asectors.php?sectorid=$_POST[serviceid]");

 ?>
