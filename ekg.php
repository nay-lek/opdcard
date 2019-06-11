<?php
include('class.mysqldb.php');
include('config.inc.php');
include('connect.php'); 

$sql="select hn from ovst where vn = '".substr($_GET['id'],0,12)."' limit 1";
$link->query($sql);
$row=$link->getnext($query);

$filename = 'D:\ekg\\'.intval($row->hn).'\\'.$_GET['id'].'.png';
$degrees = 90;
//echo $filename;
// Content type
header('Content-type: image/jpeg');

// Load
$source = imagecreatefromjpeg($filename);

// Rotate
$rotate = imagerotate($source, $degrees, 0);

// Output
imagejpeg($rotate);
//echo '<img src=http://192.168.0.251/ekg/'.$_GET['id'].'.png width=768 heigth=1024>';
?>