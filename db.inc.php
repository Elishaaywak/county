<?php
$link = mysql_connect('localhost', 'priscone_admin', 'manzis24');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$dbname="priscone_counties";
mysql_select_db($dbname, $link);
?>