<?php
//start the session
session_start();
//if the session is not set, redirect to the homepage
if (!isset($_SESSION['wuserid']))
{
    header("Location:index.php");
}
//include the database
require'db.inc.php';
//if the name is set, update it
if ($_POST['name'] != '')
{
 $query="UPDATE ward_admin SET name='$_POST[name]' WHERE adminid='$_SESSION[wuserid]'";
 mysql_query($query);        
}
//if the email is set, update it
if ($_POST['email'] != '')
{
 $query="UPDATE ward_admin SET email='$_POST[email]' WHERE adminid='$_SESSION[wuserid]'";
 mysql_query($query);        
}
//if the telephone number is set, update it
if ($_POST['telephone'] != '')
{
 $query="UPDATE ward_admin SET telephone='$_POST[telephone]' WHERE adminid='$_SESSION[wuserid]'";
 mysql_query($query);        
}
//if about is set, update it
if ($_POST['about'] != '')
{
 $query="UPDATE ward_admin SET about='$_POST[about]' WHERE adminid='$_SESSION[wuserid]'";
 mysql_query($query);        
}
//if the password is set, update it
if ($_POST['password'] != '')
{
 $query="UPDATE ward_admin SET password='$_POST[password]' WHERE adminid='$_SESSION[wuserid]'";
 mysql_query($query);        
}
//if the profile picture is set, update it
$wuserid=$_SESSION['wuserid'];

$info = pathinfo($_FILES['file']['name']);
$ext = $info['extension']; // get the extension of the file
$newname = "wuser/$wuserid.".$ext; 
echo $newname;
$target = 'pictures/'.$newname;
if (move_uploaded_file( $_FILES['file']['tmp_name'], $target))
{
    //update the database
    $update="UPDATE ward_admin SET profilepic='$newname' WHERE adminid='$wuserid'";
    mysql_query($update);
}

$_SESSION['success']="You have successfilly updated your profile";
//redirect back to the auser page
header("Location:wuser.php");
?>