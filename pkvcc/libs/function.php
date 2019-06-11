<?php
//include_once("conn/conn.php");

function get_year_begin($data){
		$y = (($data)-1);
		$m = "10";
		$d = "01";
		$date_begin = $y."/".$m."/".$d;
		return $date_begin;

}

function get_year_end($data){
		$y = (($data));
		$m = "09";
		$d = "30";
		$date_begin = $y."/".$m."/".$d;		
		return $date_begin;

}


function get_anc($d1,$d2){
		//$d1 = get_date_sql($d1);
		//$d2 = get_date_sql($d2);
		$sql = "select ifnull(count(*),0) as C_vn from person_anc_service where anc_service_date between '$d1' and '$d2' 
		    and anc_service_type_id = 1";
		$query = mysql_query($sql);
		$num_row = mysql_num_rows($query);
			while($result = mysql_fetch_array($query)){
				$CC = $result['C_vn'];
			}
		return $CC;
}

function get_pid($hn){

		$sql = "select person_id from  person where patient_hn = '$hn'";
		$query = mysql_query($sql);
		$num_row = mysql_num_rows($query);
			while($result = mysql_fetch_array($query)){
				$pid = $result['person_id'];
			}
			if($pid==""){
				$pid="00000";
			}else{
				$pid = $pid;
			}
		return $pid;

}

function get_pt_detail($hn){

		$sql = "select  concat(pname ,' ',fname,' ',lname) as pt_name   from  patient where hn = '$hn'";
		$query = mysql_query($sql);
		$num_row = mysql_num_rows($query);
			while($result = mysql_fetch_array($query)){
				$pt_name = $result['pt_name'];
			}
		return $pt_name;

}

function get_date_show($date_f){		
		$date_show  =  substr($date_f,8,2);
		$date_show  =  $date_show."-".substr($date_f,5,2);
		$date_show  =  $date_show."-".(substr($date_f,0,4)+543);
		return $date_show;
}










?>