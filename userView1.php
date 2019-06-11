<?php
@session_start();
	include('config/class.mysqldb.php');
    include('config/config.inc.php');
	include('config/connect.php'); 
	include('config/thaidate.php');
 	include('config/define.php');
	
	$ptHN=AutoZero($_POST['txtSearch']);
$sqlyear="select year(vstdate) as viewyear from ovst
where hn='".$ptHN."'
group by viewyear
order by vn desc
limit ".LimitY;
$query=$link->query($sqlyear);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" language="JavaScript">

function displayMessage(printContent) {

mywindow=window.open("http://"+LOCALPATH+"/print.php?id="+printContent,"_blank","toolbar=yes, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=550, height=600");

}
function displayEkg(printContent) {
mywindow=window.open("http://"+LOCALPATH+"/ekg.php?id="+printContent,"_blank","toolbar=yes, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=1096, height=775");
}
//-----
function open_win()
{
var str = document.getElementById("txtSearch").value;
mywindow=window.open("http://"+LOCALPATH+"/profile_dm_ht.php?hn="+str,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=1400, height=775");
mywindow.document.title="รายการใช้ยา";

}
function open_Dent()
{
var str = document.getElementById("txtSearch").value;
mywindow=window.open("http://"+LOCALPATH+"/dent/dentProfile.php?hn="+str,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=1400, height=775");
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
function reloadpage()
{
	parent.frames[1].location.href=parent.frames[1].location.href = 'opdcardViewImage.php?visit=0'
	location.reload();

}
//window.onload = main;
</script>

	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>jQuery treeview</title>
	
	<link rel="stylesheet" href="jquery.treeview/jquery.treeview.css" />
	<link rel="stylesheet" href="screen1.css" />
	
	<script src="jquery.treeview/lib/jquery.js" type="text/javascript"></script>
	<script src="jquery.treeview/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview/jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="demo.js"></script>
		<style type="text/css">
	.fcolor {
	color: #FFF;
}
    </style>
<script language="javascript" src="jquery-2.1.1.min.js"></script>  
<script type="text/javascript">  
var name = "#float_banner";   
var locateY= null;    
$(function(){  
    locateY=parseInt($(name).css("top").replace("px",""));  
    $(window).scroll(function(){  
        offset=locateY+$(document).scrollTop()+"px";  
        $(name).animate({top:offset},{duration:1000,queue:false});  
    });  
});  
</script> 
<style type="text/css">  
div#float_banner{  
    position:absolute;  
    width:150px;  
    display:block;  
    top:20px;  
	left:250px;
    height:61px;  
}  
</style>    
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body>
	
	<!--<h1 id="banner"><a href="http://bassistance.de/jquery-plugins/jquery-plugin-treeview/">jQuery Treeview Plugin</a> Demo</h1>-->
<form id="form1" name="form1" method="post" action="" >
  <div id="main">
    <!--<h4>Sample 1 - default</h4>-->
    <ul id="browser" class="filetree">
   <table width="100%" height="58" border="0" cellspacing="0" cellpadding="0" background="bar.png">
        <tr>
          <td width="100%" height="20" align="center">
          <div><!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td >--><h3 class="fcolor">
            </h4>
            <!--</td>
            </tr>
          </table>-->
            <?php 
				
				
				$sqlPt="select concat(pt.pname,pt.fname,' ',pt.lname) as fullname from patient pt
				where pt.hn='$ptHN'";
				
$dbqueryPt=mysql_db_query($dbname,$sqlPt);
while ($pt=mysql_fetch_array($dbqueryPt))
{
	 
	//echo 'show_personimage.php?patient_id="'.$pt['hn'].'"';
//echo 
'<div id="float_banner"><img src="show_personimage.php?patient_hn=0 width="100" height="10%" align="center" class="img-thumbnail" /> </div>';
echo '<h4>'.$pt['fullname'].'</h4>';
}?>
          </div></td>
        </tr>
      </table>
    <br />
    
      <label for="txtSearch"><b>ค้นหา :</b></label>
      <input name="txtSearch" type="text" id="txtSearch" value="<? echo $ptHN; ?>" />
      <input type="submit" name="button" id="button" class="btn btn-success btn-xs" value="ค้นหา" onclick="parent.frames[1].location.href=parent.frames[1].location.href = 'opdcardViewImage.php?visit=0'" />
     <br />
     <B>OPD</B>
      <?php 
	  $_SESSION['HN']=$ptHN;
	 
	  while($row=$link->getnext($query)) { 
	//Month Detail
			$sqlMonth ="select concat(year(vstdate),'-',month(vstdate)) as viewmonth,replace(vstdate,'/','-') as newdate from ovst
where hn='$ptHN'
and year(vstdate)='".$row->viewyear."'
group by viewmonth
order by vn desc";
$queryMonth =mysql_db_query($dbname,$sqlMonth);

	?>
      <li class="closed"><span class="folder"><?php echo intval($row->viewyear+543); ?></span>
        <ul>
          <?php while($viewMonth=mysql_fetch_array($queryMonth)) { ?>
          <li class="closed"><span class="folder"><?php echo thai_month(strtotime($viewMonth['newdate'])); ?></span>
            <ul id="folder21">
              <?php 
			 /* 	$sqlChkClinic="select hn from clinicmember where hn='".$ptHN."' and clinic in ('001','002')";
				$dbqueryChkClinic=mysql_db_query($dbname,$sqlChkClinic);
				$Cnumrow=mysql_num_rows($dbqueryChkClinic);
				if ($Cnumrow > 0){
							$sqldetail="select ov.vn,replace(ov.vstdate,'/','-') as newdate,ov.vsttime,s.name as spclty from ovst ov
							inner join spclty s on ov.spclty=s.spclty
							inner join vn_stat v on ov.vn=v.vn
							where  ov.hn='".$ptHN."'
							and concat(year(ov.vstdate),'-',month(ov.vstdate))='".$viewMonth['viewmonth']."'
							order by ov.vn desc";
					}else{*/
							$sqldetail="select ov.vn,replace(ov.vstdate,'/','-') as newdate,ov.vsttime,s.name as spclty,ov.an from ovst ov
							inner join spclty s on ov.spclty=s.spclty
							where ov.hn='".$ptHN."'
							and concat(year(ov.vstdate),'-',month(ov.vstdate))='".$viewMonth['viewmonth']."'
							order by ov.vn desc";
					//	}


					//	$sqldetail="select * from view_visit where hn='".$ptHN."' and viewMonth ='".$viewMonth['viewmonth']."'";
						$dbquery=mysql_db_query($dbname,$sqldetail);
						while($rowdetail=mysql_fetch_array($dbquery)){ ?>
              <li><span class="file"><?php echo "<a href='opdcardViewImage.php?visit=".$rowdetail['vn']."' target='chapter'>".thai_date(strtotime($rowdetail['newdate']))." (".date("H:i",strtotime($rowdetail['vsttime'])).")</a> &nbsp [$rowdetail[spclty]] ";
              if($rowdetail['an']<>''){
                  echo '<font color="red">Admit</font>';
              }
			  ?>
              </span></li>
              <?php }?>
            </ul>
          </li>
          <?php }?>
        </ul>
      </li>
      <?php } ?>
<!--    </ul>
  </div>
  <div id="main">
  	 <ul id="browser" class="filetree">-->
     <br />
     <B>IPD</B>
        <?php
		$sql_year_ipd="select year(dchdate) as viewyear from ipt
where hn='".$ptHN."'
group by viewyear
order by vn desc
limit ".LimitY;
			$dbquery=mysql_db_query($dbname,$sql_year_ipd);
			while ($result = mysql_fetch_array($dbquery)){
		?>
		<li class="closed"><span class="folder"><? echo intval($result['viewyear']+543); ?></span>
			<ul>
            <?php 
			$sql_ipd_visit="select regdate,an from ipt where hn='".$ptHN."' and year(dchdate) ='".$result['viewyear']."' order by an desc"; 
			$dbquery_ipd = mysql_db_query($dbname,$sql_ipd_visit);
			while($row_ipd = mysql_fetch_array($dbquery_ipd)){
			?>
				<li><span class="file"><? echo "<a href='viewchart.php?an=".$row_ipd['an']."' target='chapter'>".thai_date_short(strtotime($row_ipd['regdate']))."</a>"; ?></span></li>
            <?php } ?>
			</ul>
		</li>
        <?php }?>
             <br />
     	<B>EKG</B>
        <?php
		$sql_year_ekg="select year(e.vstdate) as viewyear from er_regist e 
		inner join ovst o on e.vn=o.vn
where o.hn='".$ptHN."'
and e.er_list like '%EKG%'
group by viewyear
order by e.vn desc";
			$dbquery=mysql_db_query($dbname,$sql_year_ekg);
			while ($result_ekg = mysql_fetch_array($dbquery)){
		?>
		<li class="closed"><span class="folder"><? echo intval($result_ekg['viewyear']+543); ?></span>
			<ul>
            <?php 
		//	$sql_ipd_visit="select vn from er_regist where hn='".$_POST['txtSearch']."' and year(dchdate) ='".$result['viewyear']."' order by an desc"; 
	//		$sql_ekg="select vn,replace(vstdate,'/','-') as newdate from ovst where hn='".$_POST['txtSearch']."'";
			$sql_ekg="select e.vn,replace(e.vstdate,'/','-') as newdate  from er_regist e
inner join ovst o on e.vn=o.vn
where o.hn='".$ptHN."'
and er_list like '%EKG%'";

			$dbquery_ekg = mysql_db_query($dbname,$sql_ekg);
			while($row_ekg = mysql_fetch_array($dbquery_ekg)){
			?>
				<?php //echo "<a href='viewchart.php?an=".$row_ekg['an']."' target='chapter'>".$row_ekg['an']."</a>";
                        $dir = '../EKG/'.intval($ptHN).'/';
						
    					$ext = '.png';
    					$search =$row_ekg['vn'];//$_POST['searchclick'];
    					/*$results = glob("$dir".$search."*.png");
						//echo $search;
						$filecount=count(glob("$dir".$search."*.png"));
						        foreach($results as $item) {
									//echo substr($item,7,-4);
									//echo $item;
									//if($filecount>1){
										$ekg=basename($item,".png");
									//}else{
									//	$ekg=substr($item,7,-4);
									//}
									if(substr($ekg,0,12)==$row_ekg['vn']){	
									
									//echo $ekg."#".$i;
										if(substr($result_ekg['viewyear']+543,2,2)==substr($ekg,0,2)){*/
											//$i++;
											if($filecount>1){
												echo "<li><span class='file'><a href='javascript:displayEkg(".$row_ekg['vn']."0".++$i.")'>".thai_date(strtotime($row_ekg['newdate']))." # ".$i."</a> </span></li>";
											}else{
												echo "<li><span class='file'><a href='javascript:displayEkg(".$row_ekg['vn'].")'>".thai_date(strtotime($row_ekg['newdate']))."</a> </span></li>";
											}   
										//}
									//}
        						//}
		?>
                
            <?php } ?>
			</ul>
		</li>
        <?php }?> <br />
        <?php
		if($_SESSION['Protect_visit']){ ?>
        <B>ปกปิด visit </B>
<?php echo $_SESSION['Protect_visit']; ?>
        <li class="closed"><span class="folder">2557</span>
            <ul>
            	<li><span class="file">ทดสอบ</span></li>
            </ul>
        </li>
        <?php } ?>
 <br/><br/>       
<?php $sqlClinic="select hn from clinicmember where hn='".$ptHN."' and clinic in ('001','002','014')";
$dbqueryClinic=mysql_db_query($dbname,$sqlClinic);
$numrow=mysql_num_rows($dbqueryClinic);
if ($numrow !=0){
?>
      <span class="file"><?php echo "<a href=pkckd/index.php?hn=$ptHN target=chapter>CKD Stage</a>";?></span><br />
      <span class="file"><?php echo "<a href=profile_dm_ht.php?hn=$ptHN target=chapter>DM HT Profile</a>";?></span><br /><?php }?> 
      <span class="file"><?php echo "<a href=dentProfile.php?hn=$ptHN target=chapter>Dent Profile</a>";?></span><br />
      <span class="file"><?php echo "<a href=pkvcc/index.php?hn=$ptHN target=chapter>VACCINE List</a>";?></span><br />
      <span class="file"><?php echo "<a href=pkasthma/index.php?hn=$ptHN target=chapter>ASTHMA & COPD</a>";?></span> <br />
      <span class="file"><?php echo "<a href=hdcservice/index.php?hn=$ptHN target=chapter>SERVICE_HDC </a>";?></span> <br />



<B>รับบริการที่อื่น HDC--VISIT </B>
   	<span class="file"><?php echo "<a href=hdcservice/index.php?hn=$ptHN target=chapter> HDC </a>";?></span> <br />



  </div>
</form>
</body></html>