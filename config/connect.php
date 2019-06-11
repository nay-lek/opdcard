<?php
//include('define.php');
	$hostname = "localhost";
	$username = "root";
	$password = "4444";
	$dbname = "hos_local";
	mysql_connect($hostname, $username, $password) or die("connect server fail");

	mysql_select_db($dbname) or die("connect database fail");
	
	$sql = 'SET CHARACTER SET UTF8';
	mysql_query($sql);
	$sql ="SET collation_connection = 'utf8_unicode_ci' ";
	mysql_query($sql);
	date_default_timezone_set('UTC');
//	require_once dirname( __FILE__ ) . '/init.inc.php';
?>