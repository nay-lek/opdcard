<?php  
  include('config/connect.php');
  include('config/class.mysqldb.php');
  include('config/config.inc.php');
  include ('config/thaidate.php');
  include('config/define.php');
  $_GET['hn']=$_SESSION['HN'];

  
function SerachDrug($var1,$var2){
	 $qty = '';
	 $icode= '';
	 $unit = '';
	 $usage = "";
include('config/connect.php');
$sql1="select o.icode,d.name,o.drugusage,u.code ,o.qty, d.units from opitemrece o 
left outer join drugitems d on o.icode=d.icode
left outer join drugusage u on o.drugusage=u.drugusage
where o.vn='".$var1."'
and o.icode not like '3%'
and o.icode in ('".$var2."')"; 
//echo $sql1;
//$result=mysql_query($sql1);

	//$link->query($sql1);
	$dbquery1=mysql_db_query($dbname,$sql1);
    while($result1 = mysql_fetch_array($dbquery1)){
	$icode=$result1['icode'];
	$drug=$result1['name'];
	$usage=$result1['code'];
	$qty = $result1['qty'];
	$unit = $result1['units'];
	
	}
	
	//return $icode;


    if($usage=="") {
    	$usage='-';

    }else{
    	$usage=$usage;

	    if($qty==''){
			$qty='-';
		}else{
			$qty = 'x'.$qty.$unit;
		}
    }


	return  $usage;
  }





function LabResult($var1,$var2){
	include('config/connect.php');
	$lab = "";
	$sqlLab='select lo.lab_order_result from lab_head lh
  left outer join lab_order lo on lo.lab_order_number=lh.lab_order_number
  where lh.vn="'.$var1.'"
  and lo.lab_items_code ="'.$var2.'"
  and lo.confirm="Y"
  order by lh.order_date desc';
   
   // $sqlLab;

  $dbquery2=mysql_db_query($dbname,$sqlLab);
    while($result2 = mysql_fetch_array($dbquery2)){
		//if($result2['lab_order_result'] <> ""){
		   $lab=$result2['lab_order_result'];
		}
		
		if($lab==''){
			$lab='-';
		}else{
            $lab= $lab;
		}	

			if($var2=='114'){

				if(get_ckd_stage($var1)=="-"){
					$lab = $lab ;
				}else{
					$lab = $lab . "  : st = " . get_ckd_stage($var1);
				}
				
			}else{

				$lab = $lab;
			}

		   return $lab;
		
		
		//}
		//if(trim($result2['lab_order_result'])==""){return "-";}
//	}	
}  


function get_ckd_stage($var1){
	include('config/connect.php');
	$ckd_stage = '';
		$sqlegfr= "select concat(p.pname,' ',p.fname,' ',p.lname) as full_name , p.hn,
lh.order_date , lh.vn,lh.department,concat(p.addrpart,' ม. ',p.moopart,thai.full_name) as full_addre,
lo.lab_order_result as Cr_,
if(lo.lab_order_result = '' , '' ,
if((CASE  WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and lo.lab_order_result > 0.7   THEN 
  ROUND((144*((pow((lo.lab_order_result/0.7),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and (lo.lab_order_result < 0.8 )   THEN
   ROUND((144*((pow((lo.lab_order_result/0.7),-0.329)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and lo.lab_order_result > 0.9   THEN 
   ROUND((141*((pow((lo.lab_order_result/0.9),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and (lo.lab_order_result < 1 )   THEN
    ROUND((141*((pow((lo.lab_order_result/0.9),-0.411)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
 END) > 90 , 1 ,

        if((CASE  WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and lo.lab_order_result > 0.7   THEN 
  ROUND((144*((pow((lo.lab_order_result/0.7),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and (lo.lab_order_result < 0.8 )   THEN
   ROUND((144*((pow((lo.lab_order_result/0.7),-0.329)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and lo.lab_order_result > 0.9   THEN 
   ROUND((141*((pow((lo.lab_order_result/0.9),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and (lo.lab_order_result < 1 )   THEN
    ROUND((141*((pow((lo.lab_order_result/0.9),-0.411)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
 END)>60,2,

           if((CASE  WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and lo.lab_order_result > 0.7   THEN 
  ROUND((144*((pow((lo.lab_order_result/0.7),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and (lo.lab_order_result < 0.8 )   THEN
   ROUND((144*((pow((lo.lab_order_result/0.7),-0.329)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and lo.lab_order_result > 0.9   THEN 
   ROUND((141*((pow((lo.lab_order_result/0.9),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and (lo.lab_order_result < 1 )   THEN
    ROUND((141*((pow((lo.lab_order_result/0.9),-0.411)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
 END)>45,'3a',

					if((CASE  WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and lo.lab_order_result > 0.7   THEN 
	ROUND((144*((pow((lo.lab_order_result/0.7),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
					WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and (lo.lab_order_result < 0.8 )   THEN
	 ROUND((144*((pow((lo.lab_order_result/0.7),-0.329)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
					WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and lo.lab_order_result > 0.9   THEN 
	 ROUND((141*((pow((lo.lab_order_result/0.9),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
					WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and (lo.lab_order_result < 1 )   THEN
		ROUND((141*((pow((lo.lab_order_result/0.9),-0.411)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
 END)>30,'3b',

           if((CASE  WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and lo.lab_order_result > 0.7   THEN 
  ROUND((144*((pow((lo.lab_order_result/0.7),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and (lo.lab_order_result < 0.8 )   THEN
   ROUND((144*((pow((lo.lab_order_result/0.7),-0.329)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and lo.lab_order_result > 0.9   THEN 
   ROUND((141*((pow((lo.lab_order_result/0.9),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
          WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and (lo.lab_order_result < 1 )   THEN
    ROUND((141*((pow((lo.lab_order_result/0.9),-0.411)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
 END)>15,4,


					 if((CASE  WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and lo.lab_order_result > 0.7   THEN 
	ROUND((144*((pow((lo.lab_order_result/0.7),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
					WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 2 and (lo.lab_order_result < 0.8 )   THEN
	 ROUND((144*((pow((lo.lab_order_result/0.7),-0.329)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
					WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and lo.lab_order_result > 0.9   THEN 
	 ROUND((141*((pow((lo.lab_order_result/0.9),-1.209)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
					WHEN lo.lab_items_code = (select lab_items_code from lab_items where lab_items_name = (select sys_value from sys_var where sys_name like '%lab_link_cr%')
)  and p.sex = 1 and (lo.lab_order_result < 1 )   THEN
		ROUND((141*((pow((lo.lab_order_result/0.9),-0.411)) * pow(0.993,(if(lh.department ='OPD',(select age_y from vn_stat where vn=lh.vn limit 1),(select age_y from an_stat where an=lh.vn limit 1)))))),2)
 END)>1,5, ''

))))))) as ckd_stage ,GROUP_CONCAT(clinic.`name`) as chronic_name

from lab_head lh
INNER JOIN lab_order lo on lh.lab_order_number = lo.lab_order_number
left JOIN patient p on lh.hn = p.hn
left join thaiaddress thai on concat(p.chwpart,p.amppart,p.tmbpart) = thai.addressid
LEFT JOIN clinicmember on lh.hn = clinicmember.hn
LEFT JOIN clinic on clinicmember.clinic = clinic.clinic

where lh.vn = '$var1'
and lo.lab_items_code = '114' and lo.lab_order_result <> '' and lo.confirm = 'Y' " ;
//echo $sqlegfr;
		  $dbquery2=mysql_db_query($dbname,$sqlegfr);
		    while($result2 = mysql_fetch_array($dbquery2)){
				$ckd_stage=$result2['ckd_stage'];
			}
			if($ckd_stage==''){
				$ckd_stage='-';
			}else{
				$ckd_stage = $ckd_stage;
			}

			return $ckd_stage;
}


function oapp($var1){
	 $oapp = "";
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
	$sqlScr='select bps,bpd,pulse,bw,bmi from opdscreen where vn="'.$var1.'"';
  $dbquery2=mysql_db_query($dbname,$sqlScr);
    while($result2 = mysql_fetch_array($dbquery2)){
		$bp=intval($result2['bps'])."/".intval($result2['bpd']);	
		$pulse=intval($result2['pulse']);
		$bw=intval($result2['bw']);
		$bmi=$result2['bmi'];
	}
	if($chk=='bp'){
		return $bp;
	}
	if($chk=='pulse'){
		return $pulse;
	}
	if($chk=='bw'){
		return $bw;
	}

	if($chk=='bmi'){
		return $bmi;
	}
} 

  $sql='select o.vn,o.rxdate from opitemrece o 
left outer join drugitems d on o.icode=d.icode
left outer join drugusage u on o.drugusage=u.drugusage
where o.hn ="'.$_GET['hn'].'"
and o.icode in (select icode from pk_drug_clinic)
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
		//print_r($vn);
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
    <p><span class="col1" id="col-pink">BMI</span><?php  foreach ($vn as $bmi){ echo '<span class="col2" id="col-pink">'.Screen($bmi,'bmi').'</span>';} ?>

    <p> <span class="col1" style="background-color:green">รายการยาความดัน</span>

    <p><span class="col1" id="col-pink">Amlodipine (5)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Amlodipine).'</span>';} ?>
  	<p><span class="col1" >Atenolol (50)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" >'.SerachDrug($visit,Atenolol).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Methyldopa (250)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink"> '.SerachDrug($visit,Methyldopa_250).'</span>';} ?>
  	<p><span class="col1" >Hydralazine (25)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" >'.SerachDrug($visit,Hydralazine).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Furosemide (40)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Furosemide).'</span>';} ?>
  	<p><span class="col1">Enalapril (5)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Enalapril).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Losartan (100)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Losartan).'</span>';} ?>
	<p><span class="col1">Propranolol (10)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Propranolol_10).'</span>';} ?>
    <p><span class="col1" id="col-pink">HCTZ (50)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Hctz).'</span>';} ?>



    <p> <span class="col1" style="background-color:blue">รายการยาเบาหวาน</span>

  	<p><span class="col1"  id="col-pink">Metformin (500)</span><?php  foreach ($vn as $visit){ echo '<span class="col2"  id="col-pink">'.SerachDrug($visit,Metformin).'</span>';} ?>
  	 <p><span class="col1">Pioglitazone (30)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" >'.SerachDrug($visit,Pioglitazone).'</span>';} ?>  	 
  	<p><span class="col1" id="col-pink">Glipizide (5)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Glipizide).'</span>';} ?>
  	<p><span class="col1">Glibenclamide (5)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Glibenclamide).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Mixtard</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Mixtard).'</span>';} ?>
  	<p><span class="col1">NPH (p)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Nph_p).'</span>';} ?>
  	<p><span class="col1" id="col-pink">NPH (k)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Nph_k).'</span>';} ?>


     <p> <span class="col1" style="background-color:orange">รายการยาลดไขมัน</span>

  	<p><span class="col1" id="col-pink">Simvastatin (20)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Simvastatin).'</span>';} ?>

  	<p><span class="col1" >Gemfibrozil (600)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Gemfibrozil).'</span>';} ?>


    <p> <span class="col1" style="background-color:#D02090">รายการยาอื่นๆ</span>
  	<p><span class="col1" id="col-pink">ASA (81)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Asa).'</span>';} ?>
  	<p><span class="col1">ISDN (10)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,Isdn).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Clopidogrel (75)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Clopidogrel).'</span>';} ?>
  	<p><span class="col1">Sodium (300)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.SerachDrug($visit,SodiumBicarbonate).'</span>';} ?>
  	<p><span class="col1" id="col-pink">Calcium (1000)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.SerachDrug($visit,Calciumcarbonate).'</span>';} ?>

  	


  	<p> <span class="col1" style="background-color:yellow">รายการ LAB</span>
  	
  	<p><span class="col1" id="col-pink">FBS (Finger)</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.LabResult($visit,'780').'</span>';} ?>
  	<p><span class="col1" >FBS (Veins)</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.LabResult($visit,'116').'</span>';} ?>
  	<p><span class="col1" id="col-pink">Triglyceride</span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.LabResult($visit,'109,615').'</span>';} ?>
  	<p><span class="col1">Cholesterol</span><?php  foreach ($vn as $visit){ echo '<span class="col2">'.LabResult($visit,'111,164').'</span>';} ?>

  	<p><span class="col1" id="col-pink">Cr : CKD </span><?php  foreach ($vn as $visit){ echo '<span class="col2" id="col-pink">'.LabResult($visit,'114').'</span>';} ?>
</div>
</body>
</html>