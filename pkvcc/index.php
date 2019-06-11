<?php 
		@session_start();
		//include("../../conn_/conn.php");
   // include("fig/connect.php");

  $hostname = "192.168.1.200";
  $username = "sa";
  $password = "myadmin";
  $dbname = "hos";
  $Conn = mysql_connect($hostname,$username,$password) or die("Can't conncet database");
        mysql_select_db($dbname) or die("Can't connect table");
        mysql_query("SET NAMES UTF8");


		include("libs/function.php");
		$HN = $_SESSION['HN'];
   // $HN = '0062769';
    $pid = get_pid($HN);


			$sql = " select 'ovst_vcc' as VCC_TYPE,ovst.hn,ovst.vstdate as VCC_DATE,ovst.vsttime as VCC_TIME,person_vaccine.vaccine_name as VCC_NAME ,
                concat('สถานที่รับ=: ','11039') as remark_detail , ( year(ovst.vstdate)-year(patient.birthday)) as age          
                from ovst_vaccine 
                inner join ovst on ovst_vaccine.vn = ovst.vn
                INNER JOIN person_vaccine on ovst_vaccine.person_vaccine_id = person_vaccine.person_vaccine_id
                inner join patient on ovst.hn = patient.hn
                where ovst.hn = $HN  GROUP BY person_vaccine.vaccine_code

                union all

                select 'epi_vcc' as VCC_TYPE,ovst.hn,ovst.vstdate as VCC_DATE ,ovst.vsttime as VCC_TIME,epi_vaccine.epi_vaccine_name  as VCC_NAME ,
                concat('สถานที่รับ=: ','11039') as remark_detail , ( year(ovst.vstdate)-year(person.birthdate)) as age
                from person_epi_vaccine_list
                INNER JOIN person_epi_vaccine on person_epi_vaccine_list.person_epi_vaccine_id = person_epi_vaccine.person_epi_vaccine_id
                INNER JOIN person_epi on person_epi_vaccine.person_epi_id = person_epi.person_epi_id
                INNER JOIN person on person_epi.person_id = person.person_id
                INNER JOIN ovst on person_epi_vaccine.vn = ovst.vn
                INNER JOIN epi_vaccine on person_epi_vaccine_list.epi_vaccine_id = epi_vaccine.epi_vaccine_id
                where person.person_id = $pid GROUP BY epi_vaccine.vaccine_code

                UNION ALL

                select 'other_vcc' as VCC_TYPE,p.patient_hn,pw.vaccine_date as VCC_DATE ,'' as VCC_TIME,person_vaccine.vaccine_name  as VCC_NAME ,
                concat('สถานที่รับ=: ',pw.hospcode ) as remark_detail , ( year(pw.vaccine_date)-year(p.birthdate)) as age
                FROM person_vaccine_elsewhere pw
                INNER JOIN person_epi_vaccine pv ON pw.person_vaccine_id=pv.person_epi_id
                left JOIN person p ON pw.person_id = p.person_id
                INNER JOIN person_vaccine on pw.person_vaccine_id = person_vaccine.person_vaccine_id
                where p.person_id = $pid GROUP BY person_vaccine.vaccine_code

                UNION ALL    

                select 'anc_vcc' as VCC_TYPE,p.patient_hn,p2.anc_service_date  as VCC_DATE ,p2.anc_service_time as VCC_TIME,person_vaccine.vaccine_name  as VCC_NAME ,
                concat('ครรภ์ที่=: ',p3.preg_no ) as remark_detail , ( year(p2.anc_service_date)-year(p.birthdate)) as age              
                FROM person_anc_service_detail p_anc
                LEFT JOIN anc_service a1 ON p_anc.anc_service_id = a1.anc_service_id 
                LEFT JOIN person_anc_service p2 ON p_anc.person_anc_service_id = p2.person_anc_service_id
                LEFT OUTER JOIN person_anc p3 ON p2.person_anc_id = p3.person_anc_id 
                LEFT OUTER JOIN ovst_seq oq on oq.vn = p2.vn
                LEFT OUTER JOIN person p ON p3.person_id = p.person_id
                left JOIN person_vaccine on a1.export_vaccine_code = person_vaccine.export_vaccine_code
                where p.person_id = $pid  GROUP BY person_vaccine.vaccine_code

                 order by  VCC_DATE desc ,VCC_TYPE ";
			//echo $sql;			
			$query = mysql_query($sql) or die(mysql_error());
		//	$rows  = mysql_num_rows($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

   <!-- <title>SB Admin - Bootstrap Admin Template</title>-->
		<title>โรงพยาบาลผาขาว[ประวัติการรับวัคคซีน]</title>
	
	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>

<body>
		<div id="page-wrapper">

                <div class="row">
                        <h1 class="page-header"> ----------> ข้อมูลประวัติการรับวัคซีน</h1>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
							
							<table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="7"> HN := <?php echo $HN; ?>   ชื่อ :=  <?php echo get_pt_detail($HN); ?>  </th>
                                    </tr>
                  								<tr>
                                    <th>ประเภทวัคซีน</th>
                  									<th>วันที่รับวัคซีน</th>
                                    <th>เวลารับวัคซีน</th>
                                    <th>วัคซีน</th>
                                    <th>อายุ</th>
                                    <th>หมายเตุ</th>
                                  </tr>
                                  </thead>
                                  <tbody>

								<?php  
                  $VCC_TYPE_NAME = "";
                    while($result=mysql_fetch_array($query)){ 
									$vstdate  = get_date_show($result['VCC_DATE']);
									$vsttime=  $result['VCC_TIME'];
									$VCC_TYPE =  $result['VCC_TYPE'];
									$VCC_NAME  =  $result['VCC_NAME'];
									$age = $result['age'];
									$remark_detail  = $result['remark_detail'];
									//$ckd  = $result['ckd_stage'];
                  switch ($VCC_TYPE) {
                    case 'ovst_vcc':
                        $VCC_TYPE_NAME = "วัคซีนไม่ระบอายุ";
                      break;

                    case 'epi_vcc':
                        $VCC_TYPE_NAME = "วัคซีนเด็กเกิด";
                      break;
                    
                    case 'other_vcc':
                        $VCC_TYPE_NAME = "วัคซีนจากที่อื่น";
                      break;
                    
                    case 'anc_vcc':
                        $VCC_TYPE_NAME = "วัคซีนหญิงตั้งครรภ์";
                      break;

                    default:
                        $VCC_TYPE_NAME = "";
                      break;
                  }
                 echo "<tr>
											 <td>$VCC_TYPE_NAME</td>
  											<td>$vstdate</td>
  											<td>$vsttime</td>
  											<td>$VCC_NAME</td>
                        <td>$age</td>
                        <td>$remark_detail</td>
                      </tr>";
						         } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

		</div>
		<!-- /wrapper -->












    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>



</body>

</html>
