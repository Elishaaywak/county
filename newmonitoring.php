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
 $subcountyid=$_POST['subcounty'];
 $password=$_POST['password'];
//insert into the database
$insert="INSERT INTO monitoring(name,email,telephone,sub_countyid,password) VALUES('$name','$email','$telephone','$subcountyid','$password')";
mysql_query($insert);
//set the session for successful
$_SESSION['success']="You have successfully added a new Monitoring and Evaluation Officer";
//redirect back to the admin homepage
header("Location:admin.php")
?>
                                    
                                    
