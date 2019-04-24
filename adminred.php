<?php

//start the session
session_start();
//check if the session is set
if (isset($_SESSION['adminid'])) {
    header("Location:admin.php");
}

//include the database
require 'db.inc.php';
//get the email and the password
$email = $_POST['email'];
$password = $_POST['password'];
//check if the username and password is correct
$check = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
$check2 = mysql_query($check);
$number = mysql_num_rows($check2);
//if it is wrong, set the session for wrong username and password then redirect to the alogin page
if ($number == 0) {
    $_SESSION['wronglogin'] = "yes";
    header("Location:alogin.php");
}
//if it is correct, redirect to the admin.php page
else {
    //get the adminid
    while ($theadmin = mysql_fetch_array($check2)) {
        $theid = $theadmin['adminid'];
    }
    //set it as a session
    $_SESSION['adminid'] = $theid;
    header("Location:admin.php");
}
?>