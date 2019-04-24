<?php
//start the session
session_start();
//if the session is not set, redirect to the homepage
if (!isset($_SESSION['muserid']))
{
    header("Location:index.php");
}
//include the database
require'db.inc.php';
//if the name is set, update it
if ($_POST['name'] != '')
{
 $query="UPDATE monitoring SET name='$_POST[name]' WHERE userid='$_SESSION[muserid]'";
 mysql_query($query);        
}
//if the email is set, update it
if ($_POST['email'] != '')
{
 $query="UPDATE monitoring SET email='$_POST[email]' WHERE userid='$_SESSION[muserid]'";
 mysql_query($query);        
}
//if the telephone number is set, update it
if ($_POST['telephone'] != '')
{
 $query="UPDATE monitoring SET telephone='$_POST[telephone]' WHERE userid='$_SESSION[muserid]'";
 mysql_query($query);        
}
//if about is set, update it
if ($_POST['about'] != '')
{
 $query="UPDATE monitoring SET about='$_POST[about]' WHERE userid='$_SESSION[muserid]'";
 mysql_query($query);        
}
//if the password is set, update it
if ($_POST['password'] != '')
{
 $query="UPDATE monitoring SET password='$_POST[password]' WHERE userid='$_SESSION[muserid]'";
 mysql_query($query);        
}
//if the profile picture is set, update it
$muserid=$_SESSION['muserid'];

$info = pathinfo($_FILES['file']['name']);
$ext = $info['extension']; // get the extension of the file
$newname = "suser/$muserid.".$ext; 
echo $newname;
$target = 'pictures/'.$newname;
if (move_uploaded_file( $_FILES['file']['tmp_name'], $target))
{
    //update the database
    $update="UPDATE monitoring SET profilepic='$newname' WHERE userid='$muserid'";
    mysql_query($update);
}

$_SESSION['success']="You have successfilly updated your profile";
//redirect back to the muser page
header("Location:muser.php");
?>