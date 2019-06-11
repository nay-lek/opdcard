<?php
@session_start();
include('config/define.php');
echo '<img src=http://'.ImagePath.'/OPD/'.intval($_SESSION['HN']).'/'.$_GET['id'].'.png width=100% heigth=100%>';
/*
include('config/define.php');
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    //echo 'Username or Password not found !';
    exit;
} else {
    if ($_SERVER['PHP_AUTH_USER']=='pkd' && $_SERVER['PHP_AUTH_PW']=='h11037')
	{
		
		echo '<img src=http://'.ImagePath.'/opd/'.intval($_SESSION['HN']).'/'.$_GET['id'].'.png width=100% heigth=100%>';
		unset($_SERVER['PHP_AUTH_USER']);
	}else
	{
		header('WWW-Authenticate: Basic realm="My Realm"');
    	header('HTTP/1.0 401 Unauthorized');
		echo 'Username or Password not found !';
    	exit;
	}	
}
*/
?>

