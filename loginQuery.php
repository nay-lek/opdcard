<?php
@session_start();
include('config/define.php');
include('config/class.mysqldb.php');
include('config/config.inc.php');
//include('config/connect.php');

	
	//$com =$_SERVER['REMOTE_ADDR'];
	//$comname = gethostbyaddr($hostname);	
	
		$sql="select * from opduser where loginname ='".$_POST['username']."' and passweb ='".md5($_POST[password])."'" ;
	$db=$link->query($sql);
	$row=$link->getnext($db);
	if($row->name <> ''){
		$_SESSION['user']=$row->name;
		$_SESSION['Print']=strrpos($row->accessright,"[PRINT_OPDSCAN_DOCUMENT]");
		$_SESSION['Protect_visit']=strrpos($row->accessright,"[PROTECT_VISIT]");
		$pos=strrpos($row->accessright,"[Access_View_OPDCARD_SCAN]");
		if ($pos==true){
			 echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'index.php">';
		}else{
			echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'access.php">';
			//echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'/opdcard/LoginForm.php">';
			}
	}else{
		echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'LoginForm.php">';
		}
/*
if(($row->groupname =='CARD') ||($row1->groupname =='LABX'))
{
	echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'/access.php">';	
}else
{	
	$sqldel="delete from log_opdscan
where accesstime < date_add(curdate(),INTERVAL -90 DAY)";
	$link->query($sqldel);

   echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'/opdcard/index.php">';
} */
?>
