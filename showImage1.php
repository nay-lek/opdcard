
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
function displayMessage(printContent) {

mywindow=window.open("http://192.168.0.251/print.php?id="+printContent,"_blank","toolbar=yes, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=550, height=600");

}
</script>
<? if($_GET['visit']){ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="96%">&nbsp;</td>
    <td width="4%"><a href="javascript:displayMessage(<? echo $_GET['visit']; ?>)"><img border=0 alt=tc-621028 src="print.png" width="32" height="32"></a></td>
  </tr>
</table>
<? }?>
</body>
<? 
	$results = glob("../opd/".$_GET['visit'].".png");
	foreach($results as $item) {
		if(substr($item,7,-4)==$_GET['visit']){									
        		//echo "<a href='javascript:displayEkg(".$rowdetail['vn'].")'>EKG</a>";    
				echo '<img src="http://192.168.0.251/opd/'.$_GET['visit'].'.png" width="100%" border="1"/>';
		}	
	}
	if(!$item)
	{
		include('opdcard.php');
	}
	//echo '<img src="http://192.168.0.251/opd/'.$visit.'.png" width="100%" border="1"/>'; 
?>