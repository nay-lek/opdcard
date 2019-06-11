<?php
@session_start();
include('config/class.mysqldb.php');
include('config/config.inc.php');
include('config/connect.php');
include('config/define.php');
	
	$com =$_SERVER['REMOTE_ADDR'];
	//$comname = gethostbyaddr($hostname);	
	
		$sql="select o.computername,o.kskloginname ,u.accessright
from onlineuser o
left outer join opduser u on u.loginname = o.kskloginname
left outer join  computer_bandwidth c on c.computer_name = o.servername
where o.computername ='".$com."'";
	$db=$link->query($sql);
	$row=$link->getnext($db);
	$_SESSION['user']=$row->kskloginname;
	$pos=strrpos($row->accessright,"[Access_View_OPDCARD_SCAN]");
if($pos==true)
{
		$sqldel="delete from log_opdscan
where accesstime < date_add(curdate(),INTERVAL -90 DAY)";
	$link->query($sqldel);

	
	echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'main.php">';	
}else
{	
echo $row->kskloginname;
   echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'access.php">';
}
?>
