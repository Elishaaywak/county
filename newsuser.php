<?php
session_start();

ob_start();
//if the session is not set

//include the database
require'db.inc.php';
//get the variables from the other form
 $name=$_POST['name'];
 $email=$_POST['email'];
 $telephone=$_POST['telephone'];
 $serviceid=$_POST['service'];
 $password=$_POST['password'];
//insert into the database
$insert="INSERT INTO sector_users(name,email,telephone,serviceid,password) VALUES('$name','$email','$telephone','$serviceid','$password')";
mysql_query($insert);
//set the session for successful
$_SESSION['success']="You have successfully added a new Sector user";
//redirect back to the admin homepage
header("Location:admin.php")
?>
                                    
                                    
