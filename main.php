<?php
@session_start();
/*if(!isset($_SESSION['EXPIRES'])||$_SESSION['EXPIRES'] < time()+36000){
	session_destroy();
	$_SESSION=array();
}
$_SESSION['EXPIRES'] = time() + 3600;*/

include('config/define.php');
if(!isset($_SESSION['user'])){
		 echo '<meta http-equiv="refresh" content="0;url=http://'.LOCALPATH.'index.php">';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OPDCARD VIEWER</title>

</head>
<frameset rows="*" cols="29%,72%">
<frame name="menu" src="userView.php">
<frame src="notfound.php" name="chapter">
</frameset>
<noframes>เบราเซอร์์ของคุณไม่ support frame</noframes>
<body>
<script language=JavaScript> 
<!-- 

//Disable right mouse click Script 
//By Maximus (maximus@nsimail.com) w/ mods by DynamicDrive 
//For full source code, visit http://www.dynamicdrive.com 

var message="ห้าม copy น่ะ เจ้านาย"; 

/////////////////////////////////// 
function clickIE4(){ 
/*var name=prompt("Please enter Password","");
document.captureEvents(Event.MOUSEDOWN); 
if (name=="h11037")
  {
  x="Hello " + name + "! How are you today?";
  document.getElementById("demo").innerHTML=x;
  return true;
  }*/
if (event.button==2){ 
alert(message); 
return false; 
} 
} 

function clickNS4(e){ 
if (document.layers||document.getElementById&&!document.all){ 
if (e.which==2||e.which==3){ 
alert(message); 
return false; 
} 
} 
} 

if (document.layers){ 
document.captureEvents(Event.MOUSEDOWN); 
document.onmousedown=clickNS4; 
} 
else if (document.all&&!document.getElementById){ 
document.onmousedown=clickIE4; 
} 

document.oncontextmenu=new Function("alert(message);return false") 
// --> 
function disableselect(e){
return false
}
function reEnable(){
return true
}
//if IE4+
document.onselectstart=new Function ("return false")
//if NS6
if (window.sidebar){
document.onmousedown=disableselect
document.onclick=reEnable
}
</script>
</body>
</html>
