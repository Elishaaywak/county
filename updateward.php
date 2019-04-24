<?php
//start the session
session_start();

ob_start();
//if the session is no tset, redirect to the homepage

//include the database
require'db.inc.php';
//if the name is set, update it
echo $_POST['name'];
echo $_POST['wardid'];
echo $_POST['scountyid'];

 $query="UPDATE wards SET name='$_POST[name]' WHERE wardid='$_POST[wardid]'";
 mysql_query($query) or trigger_error($query);     
 
 $_SESSION['success']="Successfuly Updated";
 
 //redirect back to the auser page
header("Location:awards.php?scountyid=$_POST[scountyid]");

 ?>
