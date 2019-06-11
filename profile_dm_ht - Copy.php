<?php  
  include('config/connect.php');
  include('config/class.mysqldb.php');
  include('config/config.inc.php');
  include ('config/thaidate.php');
  include('config/define.php');
  
function SerachDrug($var1,$var2){
include('config/connect.php');
$sql1="select o.icode,d.name,o.drugusage,u.code from opitemrece o 
left outer join drugitems d on o.icode=d.icode
left outer join drugusage u on o.drugusage=u.drugusage
where o.vn='".$var1."'
and o.icode not like '3%'
and o.icode in ('".$var2."')"; 
//$result=mysql_query($sql1);

	//$link->query($sql1);
	$dbquery1=mysql_db_query($dbname,$sql1);
    while($result1 = mysql_fetch_array($dbquery1)){
	$icode=$result1['icode'];
	$drug=$result1['name'];
	$usage=$result1['code'];
	
	}
	$usage = "";
	//return $icode;
	if($usage==''){
		$usage='-';
	}
	return $usage;
  }
function LabResult($var1,$var2){
	include('config/connect.php');
	$sqlLab='select lo.lab_order_result from lab_head lh
  left outer join lab_order lo on lo.lab_order_number=lh.lab_order_number
  where lh.vn="'.$var1.'"
  and lo.lab_items_code ="'.$var2.'"
  and lo.confirm="Y"
  order by lh.order_date desc';
  $dbquery2=mysql_db_query($dbname,$sqlLab);
    while($result2 = mysql_fetch_array($dbquery2)){
		//if($result2['lab_order_result'] <> ""){
		   $lab=$result2['lab_order_result'];
		}
		$lab = "";
		if($lab==''){
			$lab='-';
		}
		   return $lab;
		
		//}
		//if(trim($result2['lab_order_result'])==""){return "-";}
//	}
	
}  
function oapp($var1){
	include('config/connect.php');
	$sqlScr='select nextdate from oapp where vn="'.$var1.'"';
  $dbquery2=mysql_db_query($dbname,$sqlScr);
    while($result2 = mysql_fetch_array($dbquery2)){
		$oapp=$result2['nextdate'];
	}
	if($oapp==''){
		$oapp='-';
	}
	return $oapp;
}
function Screen($var1,$chk){
	include('config/connect.php');
	$sqlScr='select bps,bpd,pulse,bw from opdscreen where vn="'.$var1.'"';
  $dbquery2=mysql_db_query($dbname,$sqlScr);
    while($result2 = mysql_fetch_array($dbquery2)){
		$bp=intval($result2['bps'])."/".intval($result2['bpd']);	
		$pulse=intval($result2['pulse']);
		$bw=intval($result2['bw']);
		
	}
	if($chk=='bp'){
		return $bp;
	}
	if($chk=='pulse'){
		return $pulse;
	}
	if($hck=='bw'){
		return $bw;
	}
} 

  $sql='select o.vn,o.rxdate from opitemrece o 
left outer join drugitems d on o.icode=d.icode
left outer join drugusage u on o.drugusage=u.drugusage
where o.hn ="'.$_REQUEST['hn'].'"
and o.icode not like "3%"
and o.icode in ("1460179","1000255","1421102","1460012","1460013","1440105","1440601",
"1530011","1421201","1000310","1000139","1550001","1460402","1430101","1019001","1550005","1460026",
"1460327","1460168","1000039","1000016","1419041")
group by o.vn desc 
limit 5';
		$index=0;
		$dbquery=mysql_db_query($dbname,$sql);
		$link->query($sql);
		$num_rows = mysql_num_rows($dbquery);
		while ($result = mysql_fetch_array($dbquery)){
			$vn[$index]=$result['vn'];
			$rxdate[$index]=$result['rxdate'];
			
		$index++;	
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DM - HT Profile</title>
<link href="profile.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="table">
    <p><span class="col1" id="col-pink">วันที่มา</span>
    <?php  foreach($rxdate as $value){ echo '<span class="col2" id="col-pink">'.thai_date_short(strtotime($value)).'</span>';} ?> </p>
    <p><span class="col1">วันที่นัด</span><?php  foreach ($vn as $oap){ echo '<span class="col2">'.thai_date_short(strtotime(oapp($oap))).'</span>';} ?></p>
    <p><span class="col1" id="col-pink">BP (mmHg)</span><?php  foreach ($vn as $bp){ echo '<span class="col2" id="col-pink">'.Screen($bp,'bp').'</span>';} ?>
    <p><span class="col1">P (ครั้ง/นาที)</span><?php  foreach ($vn as $p){ echo '<span class="col2">'.Screen($p,'pulse').'</span>';} ?>
    <p><span class="col1" id="col-pink">HCTZ (50)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,'1460179').'</span>';} ?>
  	<p><span class="col1">Propranolol (10)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Propranolol_10).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Propranolol (40)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Propranolol_40).'</span>';} ?>
  	<p><span class="col1">Methyldopa (125)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Methyldopa_125).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Methyldopa (250)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Methyldopa_250).'</span>';} ?>
  	<p><span class="col1">Amlodipine (5)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Amlodipine).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Atenolol (50)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Atenolol).'</span>';} ?>
  	<p><span class="col1">Enalapril (5)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Enalapril).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Prazosin (2)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Prazosin).'</span>';} ?>
  	<p><span class="col1">Verapamil (40)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Verapamil).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Furosemide (40)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Furosemide).'</span>';} ?>
  	<p><span class="col1">Losartan (50)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Losartan).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Glibenclamide (5)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Glibenclamide).'</span>';} ?>
  	<p><span class="col1">Metformin (500)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Metformin).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Glipizide (5)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Glipizide).'</span>';} ?>
  	<p><span class="col1">Pioglitazone (30)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Pioglitazone).'</span>';} ?>
  <!--	<p><span class="col1">NPH</span>-->
  	<p><span class="col1" id="col-pink">Mix insulin 70/30</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,MixInsulin).'</span>';} ?>
  	<p><span class="col1">Simvastatin (10)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Simvastatin).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Gemfibrozil (300)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Gemfibrozil).'</span>';} ?>
  	<p><span class="col1">Aspirin (81)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Aspirin).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Allopurinol (10)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Allopurinol).'</span>';} ?>
  	<p><span class="col1">Colchicine (0.6)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Colchicine).'</span>';} ?>
  	<p><span class="col1">-</span>
  	<p><span class="col1" id="col-pink">FBS (mg %)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.LabResult($visit,'600').'</span>';} ?>
  	<p><span class="col1">Cholesterol</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.LabResult($visit,'111').'</span>';} ?>
  	<p><span class="col1" id="col-pink">Triglyceride</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.LabResult($visit,'109').'</span>';} ?>
  	<p><span class="col1">Cr</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.LabResult($visit,'114').'</span>';} ?>
</div>
</body>
</html>