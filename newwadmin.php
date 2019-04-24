<?php
session_start();

//if the session is not set

//include the database
require'db.inc.php';
//get the variables from the other form
 $name=$_POST['name'];
 $email=$_POST['email'];
 $telephone=$_POST['telephone'];
 $wardid=$_POST['ward'];
 $password=$_POST['password'];
//insert into the database
$insert="INSERT INTO ward_admin(name,email,telephone,wardid,password) VALUES('$name','$email','$telephone','$wardid','$password')";
mysql_query($insert);
//set the session for successful
$_SESSION['success']="You have successfully added a new Ward Administrator";
//redirect back to the admin homepage
header("Location:admin.php")
?>
                                    
                                    
