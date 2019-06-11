<?php
	@session_start();
	//include('define.php');
	
	# configuration for database
	$_config['database']['hostname'] = "192.168.1.200";
	$_config['database']['username'] = "sa";
	$_config['database']['password'] = "myadmin";
	$_config['database']['database'] = "hos";
	
	# connect the database server
	$link = new mysqldb();
	$link->connect($_config['database']);
	$link->selectdb($_config['database']['database']);
	$link->query("SET NAMES 'utf8'");
	
	$db=$link->query('select o.hospitalcode,h.name as hospital from opdconfig o
inner join hospcode h on o.hospitalcode=h.hospcode');
	$row=$link->getnext($db);
	$hospitalname=$row->hospital;
?>
