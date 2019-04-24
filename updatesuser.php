<?php
//start the session
session_start();
//if the session is not set, redirect to the homepage
if (!isset($_SESSION['suserid']))
{
    header("Location:index.php");
}
//include the database
require'db.inc.php';
//if the name is set, update it
if ($_POST['name'] != '')
{
 $query="UPDATE sector_users SET name='$_POST[name]' WHERE userid='$_SESSION[suserid]'";
 mysql_query($query);        
}
//if the email is set, update it
if ($_POST['email'] != '')
{
 $query="UPDATE sector_users SET email='$_POST[email]' WHERE userid='$_SESSION[suserid]'";
 mysql_query($query);        
}
//if the telephone number is set, update it
if ($_POST['telephone'] != '')
{
 $query="UPDATE sector_users SET telephone='$_POST[telephone]' WHERE userid='$_SESSION[suserid]'";
 mysql_query($query);        
}
//if about is set, update it
if ($_POST['about'] != '')
{
 $query="UPDATE sector_users SET about='$_POST[about]' WHERE userid='$_SESSION[suserid]'";
 mysql_query($query);        
}
//if the password is set, update it
if ($_POST['password'] != '')
{
 $query="UPDATE sector_users SET password='$_POST[password]' WHERE userid='$_SESSION[suserid]'";
 mysql_query($query);        
}
//if the profile picture is set, update it
$suserid=$_SESSION['suserid'];

$info = pathinfo($_FILES['file']['name']);
$ext = $info['extension']; // get the extension of the file
$newname = "suser/$suserid.".$ext; 
echo $newname;
$target = 'pictures/'.$newname;
if (move_uploaded_file( $_FILES['file']['tmp_name'], $target))
{
    //update the database
    $update="UPDATE sector_users SET profilepic='$newname' WHERE userid='$suserid'";
    mysql_query($update);
}

$_SESSION['success']="You have successfilly updated your profile";
//redirect back to the auser page
header("Location:suser.php");
?>