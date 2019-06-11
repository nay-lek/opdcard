<?php
@session_start();
include('config/define.php');

if($_SESSION['user']){
	 echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'main.php">';
}else
{
		 echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'LoginForm.php">';
}
?>