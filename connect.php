<?php
date_default_timezone_set('Asia/Calcutta');
$hostname="localhost";
$username="root";
$password="";
$dbname="ss";

$link = mysql_connect($hostname, $username, $password);
if (!$link) {
    die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db($dbname, $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}
?>