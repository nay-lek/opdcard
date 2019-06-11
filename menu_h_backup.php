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
	date_default_timezone_set('UTC');
    //$thai_date_return="วัน".$thai_day_arr[date("w",$time)];  
    //$thai_date_return.= "ที่ ".date("j",$time);  
    $thai_month_return.=$thai_month_arr[date("n",$d)];  
    $thai_month_return.= " ".(date("Y",$d)+543);  
   // $thai_date_return.= "  ".date("H:i",$time)." น.";  
    return $thai_month_return;  
} 
function thai_date($d){  

    global $thai_day_arr,$thai_month_arr;  
	date_default_timezone_set('UTC');
    //$thai_date_return="วัน".$thai_day_arr[date("w",$time)];  
    $thai_date_return.= date("j",$d);  
    $thai_date_return.=" ".$thai_month_arr[date("n",$d)];  
    $thai_date_return.= " ".(date("Y",$d)+543);  
   // $thai_date_return.= "  ".date("H:i",$time)." น.";  
    return $thai_date_return;  
} 
$sqlyear="select year(vstdate) as viewyear from ovst
where hn='".$_POST['txtSearch']."'
group by viewyear
order by vn desc";
$query=$link->query($sqlyear);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

function main()
{
	parent.frames[1].location.href = 'leftindex.php'
//mywindow=window.open("http://www.khammotoproduct.com");
//document.form1.searchclick.value=values;//ส่งค่าแบบ post
//document.form1.submit();
location.reload();

//return true;
} 
//window.onload = main;
</script>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>jQuery treeview</title>
	
	<link rel="stylesheet" href="jquery.treeview/jquery.treeview.css" />
	<link rel="stylesheet" href="screen.css" />
	
	<script src="jquery.treeview/lib/jquery.js" type="text/javascript"></script>
	<script src="jquery.treeview/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview/jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="demo.js"></script>
	
	</head>
<body>
	
	<!--<h1 id="banner"><a href="http://bassistance.de/jquery-plugins/jquery-plugin-treeview/">jQuery Treeview Plugin</a> Demo</h1>-->
<form id="form1" name="form1" method="post" action="" >
  <div id="main">
    <!--<h4>Sample 1 - default</h4>-->
    
    <ul id="browser" class="filetree">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="30%" bgcolor="#FFCC99" valign="middle"><h5>ชื่อ-สกุล :</h5></td>
        <td width="70%" bgcolor="#FFCC99" valign="middle"><h5>
          <? $sqlPt="select concat(pname,fname,' ',lname) as fullname from patient where hn='$_POST[txtSearch]'";
$dbqueryPt=mysql_db_query($dbname,$sqlPt);
while ($pt=mysql_fetch_array($dbqueryPt))
{
echo $pt['fullname'];
}?>
        </h5></td>
      </tr>
    </table>
    <br />
      <label for="txtSearch"><b>ค้นหา :</b></label>
      <input name="txtSearch" type="text" id="txtSearch" value="<? echo $_POST['txtSearch']; ?>" />
      <input type="submit" name="button" id="button" value="ค้นหา" onclick="parent.frames[1].location.href = 'showimage.php?visit=0'" />
     <br />
     <B>OPD</B>
      <? while($row=$link->getnext($query)) { 
	//Month Detail
			$sqlMonth ="select concat(year(vstdate),'-',month(vstdate)) as viewmonth,replace(vstdate,'/','-') as newdate from ovst
where hn='".$_POST['txtSearch']."'
and year(vstdate)='".$row->viewyear."'
group by viewmonth
order by vn desc ";
$queryMonth =mysql_db_query($dbname,$sqlMonth);

	?>
      <li class="closed"><span class="folder"><? echo intval($row->viewyear+543); ?></span>
        <ul>
          <? while($viewMonth=mysql_fetch_array($queryMonth)) { ?>
          <li class="closed"><span class="folder"><? echo thai_month(strtotime($viewMonth['newdate'])); ?></span>
            <ul id="folder21">
              <? 
						$sqldetail="select vn,replace(vstdate,'/','-') as newdate,vsttime from ovst
									where hn='".$_POST['txtSearch']."'
									and concat(year(vstdate),'-',month(vstdate))='".$viewMonth['viewmonth']."'
									order by vn desc ";
						$dbquery=mysql_db_query($dbname,$sqldetail);
						while($rowdetail=mysql_fetch_array($dbquery)){ ?>
              <li><span class="file"><? echo "<a href='showImage?visit=".$rowdetail['vn']."' target='chapter'>".thai_date(strtotime($rowdetail['newdate']))." (".date("H:i",strtotime($rowdetail['vsttime'])).")</a> &nbsp"; 
              			$dir = '../EKG/';
    					$ext = '.png';
    					$search =$rowdetail['vn'];//$_POST['searchclick'];
    					$results = glob("$dir".$search.".png");
						//echo $search;
						        foreach($results as $item) {
									//echo substr($item,7,-4);
									if(substr($item,7,-4)==$rowdetail['vn']){									
            							echo "<a href='javascript:displayEkg(".$rowdetail['vn'].")'>EKG</a>";    
									}
        }
			  ?>
              </span></li>
              <? }?>
            </ul>
          </li>
          <? }?>
        </ul>
      </li>
      <? } ?>
<!--    </ul>
  </div>
  <div id="main">
  	 <ul id="browser" class="filetree">-->
     <br />
     	<B>IPD</B>
        <?
		$sql_year_ipd="select year(dchdate) as viewyear from ipt
where hn='".$_POST['txtSearch']."'
group by viewyear
order by vn desc";
			$dbquery=mysql_db_query($dbname,$sql_year_ipd);
			while ($result = mysql_fetch_array($dbquery)){
		?>
		<li class="closed"><span class="folder"><? echo intval($result['viewyear']+543); ?></span>
			<ul>
            <? 
			$sql_ipd_visit="select an from ipt where hn='".$_POST['txtSearch']."' and year(dchdate) ='".$result['viewyear']."' order by an desc"; 
			$dbquery_ipd = mysql_db_query($dbname,$sql_ipd_visit);
			while($row_ipd = mysql_fetch_array($dbquery_ipd)){
			?>
				<li><span class="file"><? echo "<a href='viewchart.php?an=".$row_ipd['an']."' target='chapter'>".$row_ipd['an']."</a>"; ?></span></li>
            <? } ?>
			</ul>
		</li>
        <? }?> <br /><p><? $sqlClinic="select hn from clinicmember where hn='".$_POST[txtSearch]."' and clinic in ('001','002')";
$dbqueryClinic=mysql_db_query($dbname,$sqlClinic);
$numrow=mysql_num_rows($dbqueryClinic);
if ($numrow !=0){
?>
      <span class="file"><? echo "<a href=dmProfile.php?hn=$_POST[txtSearch] target=chapter>DM Profile</a>";?></span><br /><? }?>
      <span class="file"><? echo "<a href=dentProfile.php?hn=$_POST[txtSearch] target=chapter>Dent Profile</a>";?></span>
    </ul> 
    
  </div>
</form>
</body></html>

