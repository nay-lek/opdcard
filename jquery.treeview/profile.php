<? 
  include('connect.php');
  include('class.mysqldb.php');
  include('config.inc.php');
  
  
function SerachDrug($var1,$var2){
include('connect.php');
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
	//$a++;
	//return $icode;
	return $usage;
  }
function LabResult($var1,$var2){
	include('connect.php');
	$sqlLab='select lo.lab_order_result from lab_head lh
  left outer join lab_order lo on lo.lab_order_number=lh.lab_order_number
  where lh.vn="'.$var1.'"
  and lo.lab_items_code ="'.$var2.'"
  and lo.confirm="Y"
  order by lh.order_date desc';
  $dbquery2=mysql_db_query($dbname,$sqlLab);
    while($result2 = mysql_fetch_array($dbquery2)){
		$lab=$result2['lab_order_result'];	
	}
	return $lab;
}  
function oapp($var1){
	include('connect.php');
	$sqlScr='select nextdate from oapp where vn="'.$var1.'"';
  $dbquery2=mysql_db_query($dbname,$sqlScr);
    while($result2 = mysql_fetch_array($dbquery2)){
		$oapp=$result2['nextdate'];
	}
	return $oapp;
}
function Screen($var1,$chk){
	include('connect.php');
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
where o.hn ="00018362"
and o.icode not like "3%"
and o.icode in ("1460179","1000255","1421102","1460012","1460013","1440105","1440601",
"1530011","1421201","1000310","1000139","1550001","1460402","1430101","1019001","1550005","1460026",
"1460327","1460168","1000039","1000016","1419041")
group by o.vn  desc
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
<title>Untitled Document</title>
<style type="text/css">
<!--
.style17 {font-family: Arial, Helvetica, sans-serif; font-size: small; }
.style18 {font-size: small}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%" valign="top"><table width="100%" height="695" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td width="114" height="20" class="style17">วันที่มา</td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">วันที่นัด</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">BP (mmHg)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">P (ครั้ง/นาที)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">HCTZ (50)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Propranolol (10)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Propranolol (40)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Methyldopa (125)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Methyldopa (250)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Amlodipine (5)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Atenolol (50)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Enalapril (5)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Prazosin (2)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Verapamil (40)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Furosemide (40)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Losartan (50)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Glibenclamide (5)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Metformin (500)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Glipizide (5)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Pioglitazone (30)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">NPH</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Mix insulin 70/30</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Simvastatin (10)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Gemfibrozil (300)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Aspirin (81)</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Allopurinol (10)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Colchicine (0.6)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style18"></span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">FBS (mg %)</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Cholesterol</span></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFDDEE"><span class="style17">Triglyceride</span></td>
      </tr>
      <tr>
        <td height="20"><span class="style17">Cr</span></td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
      </tr>
    </table></td>
    <td width="93%" valign="top">
   <!-- <table width="100%" border="1" cellspacing="0" cellpadding="0">
    
    <? 
			
			for($i=0;$i<33;$i++){

				echo'<tr>';
				for($j=0;$j<$num_rows;$j++){
					echo'<td height="20"><span class="style18">'.$rxdate[$j].'</span></td>';
				}
				echo'</tr>';
			}
		//} 
	?>
	</table>-->
    <table width="90%" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <?
			
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.$rxdate[$j].'</span></td>';
			}
		?>
      </tr>
      <tr>
      	<?
			
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.oapp($vn[$j]).'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.Screen($vn[$j],"bp").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.Screen($vn[$j],"pulse").'</span></td>';
			}
		?>
      </tr>
      <tr>
       	<?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1460179").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1000255").'</span></td>';
			}
		?>
      </tr>
      <tr>
       	<?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1421102").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1460012").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1460013").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1440105").'</span></td>';
			}
		?>
      </tr>
      <tr>
       <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1440601").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1530011").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1421201").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1000310").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1000139").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1550001").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1460402").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1430101").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1019001").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1550005").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18"></span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1460026").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1460327").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1460168").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1000039").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.SerachDrug($vn[$j],"1000016").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.SerachDrug($vn[$j],"1419041").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18"></span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.LabResult($vn[$j],"600").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" ><span class="style18">'.LabResult($vn[$j],"111").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" bgcolor="#FFDDEE"><span class="style18">'.LabResult($vn[$j],"109").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20" ><span class="style18">'.LabResult($vn[$j],"114").'</span></td>';
			}
		?>
      </tr>
      <tr>
        <?
			for($j=0;$j<$num_rows;$j++){
				echo'<td height="20"><span class="style18">'.$rxdate[$j].'</span></td>';
			}
		?>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
