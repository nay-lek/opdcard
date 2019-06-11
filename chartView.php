<?php 
	include('config/class.mysqldb.php');
    include('config/config.inc.php');
	include('config/connect.php'); 
	include('config/thaidate.php');
	include('config/define.php');
	$_GET['an']=$_SESSION['an'];
//echo $_SESSION['an'];

$sqlyear="select year(vstdate) as viewyear from ovst
where an='".$_GET['an']."'
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

mywindow=window.open("http://"+LOCALPATH+"chartprint.php?id="+printContent,"_blank","toolbar=yes, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=550, height=600");

}
function displayEkg(printContent) {

mywindow=window.open("http://"+LOCALPATH+"/opdcard/ekg.php?id="+printContent,"_blank","toolbar=yes, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=1096, height=775");

}
//-----
function open_win()
{
var str = document.getElementById("txtSearch").value;
mywindow=window.open("http://"+LOCALPATH+"/profile_dm_ht.php?hn="+str,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=1400, height=775");
mywindow.document.title="???????????";

}
function open_Dent()
{
var str = document.getElementById("txtSearch").value;
mywindow=window.open("http://"+LOCALPATH+"/dent/dentProfile.php?hn="+str,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=1400, height=775");
mywindow.document.title="???????????";

}

function main()
{
	parent.frames[1].location.href = 'leftindex.php'
//mywindow=window.open("http://www.khammotoproduct.com");
//document.form1.searchclick.value=values;//????????? post
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
		<style type="text/css">
	.fcolor {
	color: #FFF;
}
    </style>
	</head>
<body>
	
	   <!--<h1 id="banner"><a href="http://bassistance.de/jquery-plugins/jquery-plugin-treeview/">jQuery Treeview Plugin</a> Demo</h1>-->
  <!--<div id="main">-->
       <!--<h4>Sample 1 - default</h4>-->
    
    <ul id="browser" class="filetree">
   <table width="100%" height="58" border="0" cellspacing="0" cellpadding="0" background="bar.png">
        <tr>
          <td width="100%" height="20" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td ><h3 class="fcolor">
                <?php $sqlPt="select concat(pname,fname,' ',lname) as fullname
                              from patient
                              inner join ipt on  patient.hn = ipt.hn  where ipt.an='$_GET[an]'";
                              $dbqueryPt=mysql_db_query($dbname,$sqlPt);
                              while ($pt=mysql_fetch_array($dbqueryPt))
                              {
                              echo $pt['fullname'] .'<br>'. 'AN :'.$_GET['an'];
                              }?>
                </h4></td>
            </tr>
          </table></td>
        </tr>
      </table>
    <br />
      <br />   
       
        <br />
      <span class="file"><?php echo "<a href=chartprint.php?p=1 target=chapter>TOTAL VIEW</a>";?></span><br />


       <?php // echo 'http://'.ImagePath.'IPD/'.intval($_SESSION['an']).'.pdf'; ?>


  </div>
</body></html>

