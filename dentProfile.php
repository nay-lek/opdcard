<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php 
	include('config/class.mysqldb.php');
	include('config/config.inc.php');	
	include('config/connect.php');
	include('config/thaidate.php');
	
	$sql="select dtm.vstdate,dtm.vn,d.name as doctor from dtmain dtm
	inner join doctor d on dtm.doctor=d.code
	where dtm.hn='".$_GET['hn']."' group by vstdate order by vstdate desc";
	$dbquery=$link->query($sql);
	while($row=mysql_fetch_array($dbquery))
	{
		//echo $row['vstdate'];
	
?>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#000000"><table width="1024" border="0" cellspacing="1" cellpadding="0">
      <tr>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="19%" bgcolor="#9999FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td width="13%">วันที่ : <?php  echo thai_date_short(strtotime($row['vstdate'])); ?></td>
                  <td width="87%">[<?php  echo $row['doctor'] ?>]</td>
                </tr>
            </table></td>
            </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="93%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="24%" bgcolor="#CACAFF">ผลการวินิจฉัย</td>
                    <td width="23%" bgcolor="#CACAFF">การรักษา</td>
                    <td width="17%" bgcolor="#CACAFF">ตำแหน่ง</td>
                    </tr>
                  <?php 
                  	$sqlTm="select dt.tmcode,tm.name,dt.ttcode,dt.icd,icd.name as icd_name,dt.note,d.dental_note from dtmain dt
							left outer join dttm tm on dt.tmcode = tm.code
							left outer join icd101 icd on dt.icd=icd.code
							left outer join dt_list d on dt.vn= d.vn
							where dt.vn='".$row['vn']."'";
					$dbqueryTm=$link->query($sqlTm);
					$i=0;
					while($result=mysql_fetch_array($dbqueryTm))
					{
						$dentalNote =$result['dental_note'];
						if($i % 2)
						{
				  ?>
                  <tr>
                    <td bgcolor="#ECECFF"><?php  echo $result['icd'] ?></td>
                    <td bgcolor="#ECECFF"><?php  echo $result['name'] ?></td>
                    <td bgcolor="#ECECFF"><?php  echo $result['ttcode'] ?></td>
                    </tr>
                  <?php  }else
				  { ?>
					<tr>
                    <td bgcolor="#FFFFFF"><?php  echo $result['icd'] ?></td>
                    <td bgcolor="#FFFFFF"><?php  echo $result['name'] ?></td>
                    <td bgcolor="#FFFFFF"><?php  echo $result['ttcode'] ?></td>
                    </tr>
                    
					<?php  } $i++;} ?>
                </table></td>
              </tr>
            </table></td>
            </tr>
          <tr>
            <td><?php  if($dentalNote) {?><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td width="10%" bgcolor="#FFE3B9">Dental Note :</td>
                <td width="90%" bgcolor="#FFE3B9"><?php  echo $dentalNote; ?></td>
              </tr>
            </table><?php  }?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php echo "<br>"; } ?>
</body>
</html>