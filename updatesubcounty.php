<?php
//start the session
session_start();

ob_start();
//if the session is no tset, redirect to the homepage

//include the database
require'db.inc.php';
//if the name is set, update it
echo $_POST['scounty'];
echo $_POST['id'];

 $query="UPDATE sub_county SET name='$_POST[scounty]' WHERE subcountyid='$_POST[id]'";
 mysql_query($query) or trigger_error($query);     
 
 $_SESSION['success']="Successfuly Updated";
 
 //redirect back to the auser page
header("Location:awards.php?scountyid=$_POST[id]");

 ?>
