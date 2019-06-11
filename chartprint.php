<?php
@session_start();
include('config/define.php');
$page = $_GET['p'];
 echo '<object data="http://'.ImagePath.'IPD/'.$_SESSION['an'].'.pdf#page='.$page.'" type="application/pdf" width="100%"" height="100%"">';
//echo '<img src=http://'.ImagePath.'IPD/'.'600003432'.'.pdf width=100% heigth=100%>';
 //echo '<object data="http://192.168.1.201/docscan/IPD/600003432.pdf#page=5" type="application/pdf" width="100%" height="100%">';
 //echo '<embed src="http://192.168.1.201/docscan/IPD/600003432.pdf#page=5" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">';
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

