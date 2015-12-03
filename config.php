<?php // config.php

// connect to MySQL database

$dbhost = 'localhost';
$dbname = 'social';
$dbuser = 'root';
$dbpass = '';
$appname = 'social_netwrok';

mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

?>