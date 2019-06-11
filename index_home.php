
<?php
	include('class.mysqldb.php');
    include('config.inc.php');
	include('connect.php'); 
	
	  $thai_month_arr=array(  
    "0"=>"",  
    "1"=>"มกราคม",  
    "2"=>"กุมภาพันธ์",  
    "3"=>"มีนาคม",  
    "4"=>"เมษายน",  
    "5"=>"พฤษภาคม",  
    "6"=>"มิถุนายน",   
    "7"=>"กรกฎาคม",  
    "8"=>"สิงหาคม",  
    "9"=>"กันยายน",  
    "10"=>"ตุลาคม",  
    "11"=>"พฤศจิกายน",  
    "12"=>"ธันวาคม"                    
);
function thai_month($d){  

    global $thai_day_arr,$thai_month_arr;  
	//date_default_timezone_set('UTC');
    //$thai_date_return="วัน".$thai_day_arr[date("w",$time)];  
    //$thai_date_return.= "ที่ ".date("j",$time);  
    $thai_month_return.=$thai_month_arr[date("n",$d)];  
    $thai_month_return.= " ".(date("Y",$d)+543);  
   // $thai_date_return.= "  ".date("H:i",$time)." น.";  
    return $thai_month_return;  
} 
function thai_date($d){  

    global $thai_day_arr,$thai_month_arr;  
	//date_default_timezone_set('UTC');
    //$thai_date_return="วัน".$thai_day_arr[date("w",$time)];  
    $thai_date_return.= date("j",$d);  
    $thai_date_return.=" ".$thai_month_arr[date("n",$d)];  
    $thai_date_return.= " ".(date("Y",$d)+543);  
   // $thai_date_return.= "  ".date("H:i",$time)." น.";  
    return $thai_date_return;  
} 

$sqlyear="select year(vstdate) as viewyear from ovst
where hn='00002648'
group by viewyear
order by vn desc";
$query=$link->query($sqlyear);
?>
<html>
<head>
	<link rel="stylesheet" href="jquery.treeview/jquery.treeview.css" />
	<link rel="stylesheet" href="screen.css" />
	
	<script src="jquery.treeview/lib/jquery.js" type="text/javascript"></script>
	<script src="jquery.treeview/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview/jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="demo.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"><style type="text/css">
<!--
body {
	background-color: #666666;
}

-->
</style>
<style type="text/css"> 
<!-- 
body  {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	background: #666666;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
}
.twoColHybLt #container { 
	width: 80%;  /* this will create a container 80% of the browser width */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
} 

/* Tips for sidebar1:
1. Since we are working in relative units, it's best not to use padding on the sidebar. It will be added to the overall width for standards compliant browsers creating an unknown actual width. 
2. Since em units are used for the sidebar value, be aware that its width will vary with different default text sizes.
3. Space between the side of the div and the elements within it can be created by placing a left and right margin on those elements as seen in the ".twoColHybLt #sidebar1 p" rule.
*/
.twoColHybLt #sidebar1 {
	float: left; 
	width: 15em; /* since this element is floated, a width must be given */
	background: #EBEBEB; /* the background color will be displayed for the length of the content in the column, but no further */
	padding: 15px 0; /* top and bottom padding create visual space within this div  */
}
.twoColHybLt #sidebar1 h3, .twoColHybLt #sidebar1 p {
	margin-left: 10px; /* the left and right margin should be given to every element that will be placed in the side columns */
	margin-right: 10px;
}

/* Tips for mainContent:
1. The space between the mainContent and sidebar1 is created with the left margin on the mainContent div.  No matter how much content the sidebar1 div contains, the column space will remain. You can remove this left margin if you want the #mainContent div's text to fill the #sidebar1 space when the content in #sidebar1 ends.
2. Be aware it is possible to cause float drop (the dropping of the non-floated mainContent area below the sidebar) if an element wider than it can contain is placed within the mainContent div. WIth a hybrid layout (percentage-based overall width with em-based sidebar), it may not be possible to calculate the exact width available. If the user's text size is larger than average, you will have a wider sidebar div and thus, less room in the mainContent div. You should be aware of this limitation - especially if the client is adding content with Contribute.
3. In the Internet Explorer Conditional Comment below, the zoom property is used to give the mainContent "hasLayout." This may help avoid several IE-specific bugs.
*/
.twoColHybLt #mainContent { 
	margin: 0 20px 0 13em; /* the right margin can be given in percentages or pixels. It creates the space down the right side of the page. */
} 

/* Miscellaneous classes for reuse */
.fltrt { /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class should be placed on a div or break element and should be the final element before the close of a container that should fully contain a float */
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}/*
a:link  {
	color: #135cae;
	text-decoration: none;
}
a:hover {
	color: #00FF00;
}
a:visited
{
	color: #FF0033;
}*/
a:link {color:#135cae;text-decoration: none;}
/*a:visited {background-color:#FFFF85;}*/
a:hover {background-color:#FF704D;}
a:active {background-color:#FF704D;}
.Ekg{
	color: #990000;
	text-decoration: none;
}
--> 
</style>
<script type="text/javascript" language="JavaScript">

function displayMessage(printContent) {

mywindow=window.open("http://192.168.0.251/print.php?id="+printContent,"_blank","toolbar=yes, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=550, height=600");

}
function displayEkg(printContent) {

mywindow=window.open("http://192.168.0.251/ekg.php?id="+printContent,"_blank","toolbar=yes, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=1096, height=775");

}
//-----
function open_win()
{
var str = document.getElementById("txtSearch").value;
mywindow=window.open("http://192.168.0.251/profile.php?hn="+str,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=1400, height=775");
mywindow.document.title="รายการใช้ยา";

}
function open_Dent()
{
var str = document.getElementById("txtSearch").value;
mywindow=window.open("http://192.168.0.251/dent/dentProfile.php?hn="+str,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=1400, height=775");
mywindow.document.title="รายการใช้ยา";

}

function main(values)
{

document.form1.searchclick.value=values;//ส่งค่าแบบ post
document.form1.submit();
//alert ("213");
//return true;
} 
//window.onload = main;
</script>
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

</script> <form name="form1" method="post" action="">
      <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td bgcolor="#000000"><table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="240" valign="top" bgcolor="#EBEBEB">
                    
                    <table width="100%" border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td width="30%"><input name="radio" type="radio" id="radio" value="opd" checked <?php if($_POST['radio']=='opd'){echo "checked";} ?>>OPD</td>
                        <td width="70%"><input name="radio" type="radio" id="radio" value="ipd" <?php if($_POST['radio']=='ipd'){echo "checked";} ?>>                          IPD</td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="">
                    <tr>
                      <td>&nbsp;</td>
                      <td class="twoColHybLt"><h3>ค้นหา (เฉพาะ HN)</h3></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>
                        <label>
                        <input name="txtSearch" type="text" id="txtSearch" value="<? echo $_POST['txtSearch']; ?>">
                        </label>
                        <label>
                        <input type="submit" name="button" id="button" value="ค้นหา">
                        <input type="hidden" name="searchclick" >
                        </label>
                                         </td>
                    </tr>
                  </table>
                  
                   <?php 
//		if($_POST['radio']=='opd'){
//      		$sql="select concat(pt.pname,pt.fname,' ',pt.lname) as fullname,o.vstdate,o.vn,o.hn	from ovst o 
//			left outer join patient pt on pt.hn=o.hn where o.hn = '".$_POST['txtSearch']."' order by o.vstdate desc limit 20";
//		}else
//		if($_POST['radio']=='ipd'){
//			$sql="select concat(pt.pname,pt.fname,' ',pt.lname) as fullname,concat(i.regdate,' - [',i.an,']') as vstdate,i.an as vn,i.hn	from ipt i 
//			left outer join patient pt on pt.hn=i.hn where i.hn='".$_POST['txtSearch']."' order by i.regdate desc limit 10";	
//		}
////		$link->query($sql);
////		$chkVisit=$link->num_rows($sql);
////		if($chkVisit>0)
////		{
////			include('queryscan.php');
////		}
//		//$sql="select vstdate,vn,hn from ovst where hn='".$hn."'";
//		$dbquery=mysql_db_query($dbname,$sql);
//		
//		$i=0;
//		//$dateTh = new DateTime();
//		while ($result = mysql_fetch_array($dbquery)){
//			$hn=$result['hn'];
//			$vn=$result['vn'];
//			$name=$result['fullname'];
//			$vstdate = $result['vstdate'];
//			//$dateTh->setDateTime($vstdate,'dd-m-yy');
//			//echo $dateTh;
//			echo"<table width=100% border=0 cellspacing=1 cellpadding=1>
//      				<tr>
//					
//        			<td>
//						
//						<a href='javascript:main(".$vn.")'>".$vstdate."</a>";
//					
//					if($vn==$_POST['searchclick']){	
//						
//						echo '<img src="arrleft.png"';
//						}
//			echo "<br>
//						
//					</td>
//					<td class=Ekg>";
//					$dir = 'ekg';
//    					$ext = '.png';
//    					$search =$vn;//$_POST['searchclick'];
//    					$results = glob("$dir/".$search.".png");
//						        foreach($results as $item) {
//									//echo substr($item,4,-4);
//									if(substr($item,4,-4)==$vn){									
//            							echo "<a href='javascript:displayEkg(".$vn.")'>EKG</a>";    
//									}
//        }
//		echo "</td>
//      				</tr>
//    			</table>";
//			$i++;
//		}
//	?>
					 <div id="main">	
                        <!--<h4>Sample 1 - default</h4>-->
                        <ul id="browser" class="filetree">
                        <? while($row=$link->getnext($query)) { 
                        //Month Detail
                                $sqlMonth ="select concat(pt.pname,pt.fname,' ',pt.lname)as fullname,concat(year(ov.vstdate),'-',month(ov.vstdate)) as viewmonth,replace(ov.vstdate,'/','-') as newdate from ovst ov
								inner join patient pt on ov.hn=pt.hn
                    where ov.hn='".$_POST['txtSearch']."'
                    and year(ov.vstdate)='".$row->viewyear."'
                    group by viewmonth
                    order by ov.vn desc ";
                    $queryMonth =mysql_db_query($dbname,$sqlMonth);
                    
                        ?>
                            <li class="closed"><span class="folder"><? echo intval($row->viewyear+543); ?></span>
                                <ul>
                                <? while($viewMonth=mysql_fetch_array($queryMonth)) { 
									$name=$viewMonth['fullname'];
								?>
                                    <li class="closed"><span class="folder"><? echo thai_month(strtotime($viewMonth['newdate'])); ?></span>
                                        <ul id="folder21">
                                        <? 
                                            $sqldetail="select vn,replace(vstdate,'/','-') as newdate from ovst
                                                        where hn='".$_POST['txtSearch']."'
                                                        and concat(year(vstdate),'-',month(vstdate))='".$viewMonth['viewmonth']."'
                                                        order by vn desc ";
                                            $dbquery=mysql_db_query($dbname,$sqldetail);
                                            while($rowdetail=mysql_fetch_array($dbquery)){ ?>
                                            
                                            <li><span class="file"><? echo "<a href='javascript:main(".$rowdetail['vn'].")'>".thai_date(strtotime($rowdetail['newdate']))."</a>"; ?></span></li>
                                            
                                        <? }?>
                                        </ul>
                                    </li>
                                <? }?>
                                </ul>
                            </li>
                        <? } ?>
                        </ul>	
                    </div>
                    <br>
                  </p> 
                  </td>                  
                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr bgcolor="#CCCCCC">
                      <td valign="middle"><?php echo "<h3><div align=center>$name</div></h3>"; ?>                        </td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr bgcolor="#EBEBEB">
                        <td width="2%">&nbsp;</td>
                        <td width="13%">
						<?php 
							$sqldm = "SELECT * FROM clinicmember where clinic in ('001','002') and hn ='".$hn."'";
							$dbquerydm=mysql_db_query($dbname,$sqldm);
							$num_rows = mysql_num_rows($dbquerydm);
							if($num_rows){
								echo "<a href='javascript:open_win(".$txtSearch.")'>Profile DM-HT</a>";
                        	} 
						?>
                        </td>
                        <td width="73%" align="left"><? if($vn){ echo "| <a href='javascript:open_Dent(".$txtSearch.")'>ประวัติทันตกรรม</a>"; }?></td>

                        <td width="12%" align="right"><?php echo "<a href='javascript:displayMessage(".$_POST['searchclick'].")'>Print..</a>"; ?></td>
                      </tr>
                  </table>
                    <div align="center">
					<?php
					if ($_POST['searchclick']=='')
					{
						echo '<img src="1" width="100%" border="1"/>';
					}
					if($_POST['radio']=='opd'){
						echo '<img src="http://192.168.0.251/opd/'.$_POST['searchclick'].'.png" width="100%" border="1"/>';
					}else if($_POST['radio']=='ipd'){
						//echo '<object type=application/pdf data=http://192.168.0.25/ipd/'.$_POST['searchclick'].'.pdf width=100% height=768 ></object>';			
						echo '<a href=viewchart.php?an='.$_POST['searchclick']. ' target="_new">คลิ๊กดูลายละเอียด</a>';
					}
					/*if($txtSearch!=''){
						include('queryscan.php'); 
					}*/
					?>
                    </div>                     
                  </td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </form> 
</body>
</html>
