<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
.f {
	font-family: Verdana, Geneva, sans-serif;
	font-size:x-small;
}
.usage {
	color: #000;
}
</style>
</head>
<body>
<?php 
	include('config/class.mysqldb.php');
    include('config/config.inc.php');
	include('config/connect.php');
	include('config/thaidate.php');
	$sql="select concat(pt.pname,pt.fname,' ',pt.lname) as fullname,scr.* from opdscreen scr
inner join patient pt on scr.hn=pt.hn
where scr.vn='$_GET[visit]'";
	$dbquery=$link->query($sql);
	while($row=mysql_fetch_array($dbquery))
	{

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#000000"><table width="100%" border="0" cellspacing="1" cellpadding="0">
      <tr>
        <td bgcolor="#999999"><table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%">HN :</td>
                    <td width="10%"><?php echo $row['hn']; ?></td>
                    <td width="11%">ชื่อ-นามสกุล :</td>
                    <td width="24%"><?php echo $row['fullname']; ?></td>
                    <td width="40%"><?php echo "VN : ".$row['vn']; ?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="70%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="3%" bgcolor="#3399FF"><strong><span class="f">Vital sign</span></strong></td>
                  </tr>
                  <tr>
                    <td>

                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td width="13%" bgcolor="#FFFFFF"><span class="f">วัน-เวลาที่วัด</span></td>
                        <td colspan="2" bgcolor="#FFFFFF" class="f"><?php echo thai_date(strtotime($row['vstdate'])); ?></td>
                        <td width="10%" bgcolor="#FFFFFF">&nbsp;</td>
                        <td width="7%" bgcolor="#FFFFFF">&nbsp;</td>
                        <td width="37%" bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#E1F0FF"><span class="f">น้ำหนัก</span></td>
                        <td width="9%" bgcolor="#FFFFFF"><span class="f"><?php echo intval($row['bw']); ?></span></td>
                        <td width="24%" bgcolor="#E1F0FF"><span class="f">kg.</span></td>
                        <td bgcolor="#E1F0FF"><span class="f">ส่วนสูง</span></td>
                        <td bgcolor="#FFFFFF"><span class="f"><?php echo intval($row['height']); ?></span></td>
                        <td bgcolor="#E1F0FF"><span class="f">cm.</span></td>
                      </tr>
                      <tr>
                        <td bgcolor="#E1F0FF"><span class="f">ความดัน</span></td>
                        <td bgcolor="#FFFFFF"><span class="f"><?php echo intval($row['bps']).'/'.intval($row['bpd']); ?></span></td>
                        <td bgcolor="#E1F0FF"><span class="f">mmHg.</span></td>
                        <td bgcolor="#E1F0FF"><span class="f">อุณหภูมิ</span></td>
                        <td bgcolor="#FFFFFF"><span class="f"><?php echo intval($row['temperature']); ?></span></td>
                        <td bgcolor="#E1F0FF"><span class="f">C</span></td>
                      </tr>
                      <tr>
                        <td bgcolor="#E1F0FF"><span class="f">ชีพจร</span></td>
                        <td bgcolor="#FFFFFF"><span class="f"><?php echo intval($row['pulse']); ?></span></td>
                        <td bgcolor="#E1F0FF"><span class="f">ครั้ง/นาที.</span></td>
                        <td bgcolor="#E1F0FF"><span class="f">อัตราการหายใจ</span></td>
                        <td bgcolor="#FFFFFF"><span class="f"><?php echo intval($row['rr']); ?></span></td>
                        <td bgcolor="#E1F0FF"><span class="f">ครั้ง/นาที</span></td>
                      </tr>
                    </table>

                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#3399FF"><strong><span class="f">รายการตรวจร่างกาย</span></strong></td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="1" cellpadding="0" >
                      <tr>
                        <td width="13%" bgcolor="#E1F0FF"><span class="f">CC</span></td>
                        <td width="87%" bgcolor="#FFFFFF"><span class="f"><?php echo $row['cc']; ?></span></td>
                      </tr>
                      <tr>
                        <td bgcolor="#E1F0FF"><span class="f">HPI</span></td>
                        <td bgcolor="#FFFFFF"><span class="f"><?php echo $row['hpi']; ?></span></td>
                      </tr>
                      <tr>
                        <td bgcolor="#E1F0FF"><span class="f">PMH</span></td>
                        <td bgcolor="#FFFFFF"><span class="f"><?php echo $row['pmh']; ?></span></td>
                      </tr>
                      <tr class="f">
                        <td valign="top" bgcolor="#E1F0FF">PE</td>
                        <td bgcolor="#FFFFFF">
						<?php 
            $PE = "";
						if($row['pe_ga_text']<>''){$PE="GA : ".$row['pe_ga_text'];}
						if($row['pe_heent_text']<>''){$PE.="<br>Heent : ".$row['pe_heent_text'];}
						if($row['pe_heart_text']<>''){$PE.="<br>Heart : ".$row['pe_heart_text'];}
						if($row['pe_lung_text']<>''){$PE.="<br> Lung : ".$row['pe_lung_text'];}
						if($row['pe_ab_text']<>''){$PE.="<br>Ab : ".$row['pe_ab_text'];}
						if($row['pe_ext_text']<>''){$PE.="<br>Ext : ".$row['pe_ext_text'];}
						if($row['pe_neuro_text']<>''){$PE.="<br>Neuro : ".$row['pe_neuro_text'];}
						echo $PE; 
						
						?>
                        </td>
                      </tr>
                      <tr class="f">
                        <td valign="top" bgcolor="#E1F0FF">ช่วยเหลือบรรเทาอาการ</td>
                        <td bgcolor="#FFFFFF">&nbsp;
                          <?php if($row['help1']=='Y'){echo"* นักพักวัด BP ซ้ำ เวลา $row[help1_time] น. BP : $row[help1_bps] / $row[help1_bpd] mmHg.";}
					if($row['help4']=='Y'){echo "<br>&nbsp; * อื่น ๆ : $row[help4_note]";} 
					?></td>
                      </tr>
                      <tr>
                        <td colspan="2" bgcolor="#3399FF"><span class="f"><strong>การวินิจฉัยโรค</strong></span></td>
                      </tr>
                      <?php 
						$sqlDx="select dx.icd10,dx.diagtype,if(i.name is null,i2.name,i.name) as icdname from ovstdiag dx
left outer join icd101 i on dx.icd10 = i.code
left outer join icd9cm1 i2 on dx.icd10 = i2.code
where dx.vn='$_GET[visit]'
order by dx.diagtype,dx.icd10 desc";
$dbQueryDx=mysql_db_query($dbname,$sqlDx);
while($resultDx=mysql_fetch_array($dbQueryDx))
{

					?>
                      <tr class="f">
                        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="29%">&nbsp;</td>
                            <td width="45%" class="f"><?php echo $resultDx['icd10'];?></td>
                            <td width="26%" class="f"><?php echo "[$resultDx[diagtype]] "; ?></td>
                          </tr>
                        </table></td>
                        <td bgcolor="#FFFFFF" class="f"><?php echo $resultDx['icdname'];?></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td colspan="2" bgcolor="#3399FF"><span class="f"><strong>Medication</strong></span></td>
                        </tr>
                        <?php
$sqlMed="select o.icode,o.item_no,concat(s.name,' ' 
,s.strength) as name ,s.units,o.qty,o.paidst,d.shortlist  
,o.sp_use,s.displaycolor  ,u.name1,u.name2,u.name3 
from opitemrece o
left outer join s_drugitems s on s.icode=o.icode
left outer join drugusage d on d.drugusage=o.drugusage
left outer join sp_use u on u.sp_use = o.sp_use
left outer join drugitems i on i.icode=o.icode
where o.vn='$_GET[visit]' and o.icode like '1%'
order by o.item_no";
$dbQueryMed=mysql_db_query($dbname,$sqlMed);
while($resultMed=mysql_fetch_array($dbQueryMed))
{
?>
                      <tr>
                        <td bgcolor="#FFFFFF" class="f"><?php echo $resultMed['icode']; ?></td>
                        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="f">
                          <tr>
                            <td width="39%"><?php echo $resultMed['name']; ?></td>
                            <td width="60%" class="usage"><?php echo $resultMed['shortlist']." X ".$resultMed['qty']; ?></td>
                            <td width="1%">&nbsp;</td>
                          </tr>
                        </table></td>
                        </tr>
                        <?php } ?>
                      <tr>
                        <td colspan="2" bgcolor="#3399FF" class="f"><strong>Service charge</strong></td>
                        </tr>
                      <?php
                        $sqlCharge="select o.icode,o.item_no,concat(s.name,' ' 
                        ,s.strength) as name ,s.units,o.qty,o.paidst,d.shortlist  
                        ,o.sp_use,s.displaycolor  ,u.name1,u.name2,u.name3 
                        from opitemrece o
                        left outer join s_drugitems s on s.icode=o.icode
                        left outer join drugusage d on d.drugusage=o.drugusage
                        left outer join sp_use u on u.sp_use = o.sp_use
                        left outer join drugitems i on i.icode=o.icode
                        where o.vn='$_GET[visit]' and o.icode not like '1%'
                        order by o.item_no";
                        $dbQueryCharge=mysql_db_query($dbname,$sqlCharge);
                        while($resultCharge=mysql_fetch_array($dbQueryCharge))
                    { ?>
                        <tr>
                        <td bgcolor="#FFFFFF" class="f"><?php echo $resultCharge['icode']; ?></td>
                        <td bgcolor="#FFFFFF" class="f"><?php echo $resultCharge['name']; ?></td>
                      </tr><?php } ?>
                      <tr>
                        <td colspan="2" bgcolor="#3399FF" class="f">
                            <strong>รายการนัดหมาย</strong>
                        </td>
                        </tr>
                       <?php
                					  $sqlOapp="select * from oapp where vn ='$_GET[visit]'"; 
                						$dbqueryOapp=mysql_db_query($dbname,$sqlOapp);
                						while($rowOapp=mysql_fetch_array($dbqueryOapp)){
                						$oapp="";	
            					  ?>
                      <tr>
                        <td valign="top" bgcolor="#FFFFFF" class="f">
                               <?php echo thai_date_short(strtotime($rowOapp['nextdate'])); ?>                          
                        </td>
                        <td valign="top" bgcolor="#FFFFFF" class="f">
                            <?php 
                							if($rowOapp['note']<>'') { $oapp=$rowOapp['note'];}
                							if($rowOapp['note1']<>'') { $oapp.="<br>".$rowOapp['note1'];} 
                							if($rowOapp['note2']<>'') { $oapp.="<br>".$rowOapp['note2'];}
                							echo $oapp;
        						        ?>                        
                        </td>
                      </tr>
                       <?php } ?>

                      <tr>
                        <td colspan="2" bgcolor="#3399FF" class="f">
                            <strong>การส่งต่อรักษาที่อื่น</strong>
                        </td>
                      </tr>
                       <?php
                            $sqlRefer="select * from referout 
                                        LEFT JOIN hospcode on refer_hospcode = hospcode.hospcode  
                                        left join  referout_status on referout.referout_status_id =  referout_status.referout_status_id 
                                        where vn ='$_GET[visit]'"; 
                            $dbqueryRefer=mysql_db_query($dbname,$sqlRefer);
                            while($rowRefer=mysql_fetch_array($dbqueryRefer)){
                            $Refer=""; 
                        ?>
                      <tr>
                          <table width="100%" border="0" cellspacing="1" cellpadding="0">
                            <tr>
                              <td width="20%" bgcolor="#FFFFFF" ><span class="f">เลขที่ส่งต่อ</span></td>
                              <td colspan="5" bgcolor="#FFFFFF" class="f"><?php echo $rowRefer['refer_number'] ; ?></td>

                            </tr>
                            <tr>
                              <td bgcolor="#E1F0FF" width="13%" ><span class="f">ส่งต่อไปที่ </span></td>
                              <td  bgcolor="#FFFFFF" colspan="5"><span class="f"><?php echo '['.$rowRefer['refer_hospcode'].']'.$rowRefer['name']; ?></span></td>
                              
                             </tr>
                            <tr>
                              <td bgcolor="#E1F0FF"><span class="f">แผนก</span></td>
                              <td bgcolor="#FFFFFF"><span class="f"><?php echo $rowRefer['department'] ; ?></span></td>
                              <td bgcolor="#E1F0FF"><span class="f">เวลาที่ส่งต่อ</span></td>
                              <td bgcolor="#FFFFFF"><span class="f"><?php echo  $rowRefer['refer_time']; ?></span></td>
                              <td bgcolor="#E1F0FF"><span class="f">สิทธิการักษา</span></td>
                              <td bgcolor="#FFFFFF"><span class="f"><?php echo  $rowRefer['pttype']; ?></span></td>
                            </tr>    

                            <tr>
                              <td bgcolor="#E1F0FF"><span class="f">แพทย์ผู้ส่ง</span></td>
                              <td bgcolor="#FFFFFF"><span class="f"><?php echo $rowRefer['doctor'] ; ?></span></td>
                            </tr> 
                            <tr>
                              <td bgcolor="#E1F0FF"><span class="f">การวินิจฉัยโรคขั้นต้น</span></td>
                              <td bgcolor="#FFFFFF" colspan="5"><span class="f"><?php echo $rowRefer['pre_diagnosis'] ; ?></span></td>                            
                            </tr>
                            <tr>                            
                              <td bgcolor="#E1F0FF"><span class="f">โรคที่ส่ง</span></td>
                              <td bgcolor="#FFFFFF"  colspan="5"><span class="f"><?php echo $rowRefer['pdx'] ; ?></span></td>
                            </tr>
                            <tr>
                              <td bgcolor="#E1F0FF" ><span class="f">ผู้บันทึกใบส่งตัว</span></td>
                              <td bgcolor="#FFFFFF" colspan="5"><span class="f"><?php echo $rowRefer['refer_write_staff'] ; ?></span></td>

                            </tr>  




                            <tr>
                              <td colspan="6" bgcolor="#3399FF" class="f">
                                  <strong>ติดตามผลการรักษา</strong>
                              </td>
                            </tr>
                            <tr>
                              <td bgcolor="#E1F0FF" ><span class="f">วันที่รับใบตอบกลับ</span></td>
                              <td bgcolor="#FFFFFF" colspan="5"><span class="f"><?php echo get_date_show($rowRefer['confirm_date']) ; ?></span></td>

                            </tr> 
                            <tr>
                              <td bgcolor="#E1F0FF" ><span class="f">ผลการักษา</span></td>
                              <td bgcolor="#FFFFFF" colspan="5"><span class="f"><?php echo $rowRefer['confirm_text'] ; ?></span></td>
                            </tr> 
                            <tr>
                              <td bgcolor="#E1F0FF" ><span class="f">ผลการวินิจฉัย</span></td>
                              <td bgcolor="#FFFFFF" colspan="5"><span class="f"><?php echo $rowRefer['confirm_diagnosis'] ; ?></span></td>
                            </tr> 
                            <tr>
                              <td bgcolor="#E1F0FF" ><span class="f">สถานะภาพ</span></td>
                              <td bgcolor="#FFFFFF" colspan="5"><span class="f"><?php echo $rowRefer['referout_status_name'] ; ?></span></td>
                            </tr> 
                          </table>
                      </tr>
                       <?php }?>

                    </table></td>
                  </tr>
                </table></td>
                <td width="30%" valign="top" bgcolor="#FFFFFF" class="f" ><?php include('labview.php'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php }?>
</body>
</html>