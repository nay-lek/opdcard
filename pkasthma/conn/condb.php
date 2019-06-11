<?php

try {

	   $db = new PDO('mysql:host=192.168.1.200;dbname=hos;charset=utf8','sa','myadmin');
	   $db -> exec("set names utf8");
	  //echo "Hellow DB";

		//$person = $select->fetchAll();
} catch (Exception $e) {
	echo 'Can not connect to Database';
	throw new Exception($e);
	

}
?>