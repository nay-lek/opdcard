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


function get_fp($d1,$d2){
		//$d1 = get_date_sql($d1);
		//$d2 = get_date_sql($d2);
		$sql = "select count(*) as women_fp from person_women_service where women_service_id = 1 and  service_date between '$d1' and '$d2'";
		$query = mysql_query($sql);
		$num_row = mysql_num_rows($query);
			while($result = mysql_fetch_array($query)){
				$CC = $result['women_fp'];
			}
		return $CC;
}




function get_mch($d1,$d2){
		//$d1 = get_date_sql($d1);
		//$d2 = get_date_sql($d2);
		$sql = "select ifnull(count(distinct(person_anc_id)),0) as C_pid,ifnull(count(*),0) as C_vn from person_anc_preg_care
		        where care_date between '$d1' and '$d2'";
		$query = mysql_query($sql);
		$num_row = mysql_num_rows($query);
			while($result = mysql_fetch_array($query)){
				$C_pid = $result['C_pid'];
				$C_vn  = $result['C_vn'];

			}
		return $C_pid . " : " .$C_vn   ;
}





function get_pp($d1,$d2){
		//$d1 = get_date_sql($d1);
		//$d2 = get_date_sql($d2);
		$sql = "select ifnull(count(distinct(person_wbc_id)),0) as C_pid , ifnull(count(*),0) as C_vn from person_wbc_post_care
		        where care_date between '$d1' and '$d2'";
		$query = mysql_query($sql);
		$num_row = mysql_num_rows($query);
			while($result = mysql_fetch_array($query)){
				$C_pid = $result['C_pid'];
				$C_vn  = $result['C_vn'];

			}
		return $C_pid . " : " .$C_vn   ;
}



function get_vaccine($d1,$d2){
		//$d1 = get_date_sql($d1);
		//$d2 = get_date_sql($d2);
		$sql_wbc = "select ifnull(count(*),0) as C_wbc from person_wbc_vaccine_detail wbc_vac
		left join person_wbc_service wbc_service on wbc_vac.person_wbc_service_id = wbc_service.person_wbc_service_id
		where wbc_service.service_date between '$d1' and '$d2' " ;
		$query_wbc = mysql_query($sql_wbc);
		$num_row = mysql_num_rows($query_wbc);
			while($result_wbc = mysql_fetch_array($query_wbc)){
				$CC_wbc = $result_wbc['C_wbc'];
			}

		$sql_epi =  "select ifnull(count(*),0) as C_epi from person_epi_vaccine_list epi_vac
		left join person_epi_vaccine epi_service on epi_vac.person_epi_vaccine_id = epi_service.person_epi_vaccine_id
		where epi_service.vaccine_date between '$d1' and '$d2'  " ;
		$query_epi = mysql_query($sql_epi);
		$num_row = mysql_num_rows($query_epi);
			while($result_epi = mysql_fetch_array($query_epi)){
				$CC_epi = $result_epi['C_epi'];
			}


		return  ($CC_wbc) + ($CC_epi) ; 
		//return  $sql_wbc . " union ". $sql_epi ; 

}



function get_nutrition($d1,$d2){
		//$d1 = get_date_sql($d1);
		//$d2 = get_date_sql($d2);
		$sql_wbc = "select ifnull(count(distinct(person_wbc_id)),0) as C_hn_wbc, ifnull(count(person_wbc_id),0) as C_nutri from person_wbc_nutrition
					where nutrition_date  between '$d1' and '$d2'" ;
		$query_wbc = mysql_query($sql_wbc);
		$num_row = mysql_num_rows($query_wbc);
			while($result_wbc = mysql_fetch_array($query_wbc)){
				$CC_wbc = $result_wbc['C_nutri'];
				$CC_wnc_hn = $result_wbc['C_hn_wbc'];
			}

		$sql_epi =  "select ifnull(count(distinct(person_epi_id)),0) as C_hn_epi,ifnull(count(person_epi_id),0) as C_nutri from person_epi_nutrition
					where nutrition_date  between '$d1' and '$d2'" ;
		$query_epi = mysql_query($sql_epi);
		$num_row = mysql_num_rows($query_epi);
			while($result_epi = mysql_fetch_array($query_epi)){
				$CC_epi = $result_epi['C_nutri'];
				$CC_epi_hn = $result_epi['C_hn_epi'];
			}


		return     ($CC_wnc_hn+$CC_epi_hn)." : ". ($CC_wbc+$CC_epi); 
		//return  $sql_epi ;

}




function get_development($d1,$d2){
		//$d1 = get_date_sql($d1);
		//$d2 = get_date_sql($d2);
		$sql_wbc = "select ifnull(count(*),0) as C_develop  from person_wbc_service  
					where wbc_development_assess_id is not null and service_date between '$d1' and '$d2' " ;
		$query_wbc = mysql_query($sql_wbc);
		$num_row = mysql_num_rows($query_wbc);
			while($result_wbc = mysql_fetch_array($query_wbc)){
				$C_wbc = $result_wbc['C_develop'];
			}

		$sql_epi =  "select ifnull(count(*),0) as C_develop from person_epi_vaccine  
					where wbc_development_assess_id is not null and vaccine_date  between '$d1' and '$d2'" ;
		$query_epi = mysql_query($sql_epi);
		$num_row = mysql_num_rows($query_epi);
			while($result_epi = mysql_fetch_array($query_epi)){
				$C_epi = $result_epi['C_develop'];
			}


		return  (($C_wbc) + ($C_epi)) ; 
		//return  $sql_wbc ;

}


function get_survey($d1,$d2){

		$sql_house = "select ifnull(count((house_id)),0) as C_house from house_survey
		where survey_date between '$d1' and '$d2'  " ;
		$query_house = mysql_query($sql_house);
		$num_row = mysql_num_rows($query_house);
			while($result_house = mysql_fetch_array($query_house)){
				$CC_house = $result_house['C_house'];
			}

		$sql_person_vist =  "select ifnull(count((person_id)),0) as C_pid from person_visit
		where visit_date between '$d1' and '$d2'    " ;
		$query_person_vist = mysql_query($sql_person_vist);
		$num_row = mysql_num_rows($query_person_vist);
			while($result_person_vist = mysql_fetch_array($query_person_vist)){
				$CC_person_vist = $result_person_vist['C_pid'];
			}


		return  $CC_house ." : ". $CC_person_vist ; 

}




function get_date_sql($date_th_format){
		
		$date_insert  =  substr($date_th_format,6,4)-543;
		$date_insert  =  $date_insert."/".substr($date_th_format,3,2);
		$date_insert  =  $date_insert."/".(substr($date_th_format,0,2));
		return $date_insert;
}

function get_date_show($date_f){		
		$date_show  =  substr($date_f,8,2);
		$date_show  =  $date_show."-".substr($date_f,5,2);
		$date_show  =  $date_show."-".(substr($date_f,0,4)+543);
		return $date_show;
}


function  get_date_end($m){			
			switch($m) {
					case 1  : $d = "31" ;
					 case 2  : $d = "28" ;
					  case 3  : $d = "31" ;
					   case 4  : $d = "30" ;
					    case 5  : $d = "31" ;
					     case 6  : $d = "30" ;
					      case 7  : $d = "31" ;
					 	   case 8  : $d = "31" ;
						    case 9  : $d = "30" ;
							 case 10  : $d = "31" ;
							  case 11  : $d = "30" ;
							   case 12  : $d = "31" ;
			}	
			
			return $d;
}




function get_anc_table($d1,$d2){
		$sql = "select year(anc_service_date) as year_,month(anc_service_date) as month_, concat(month(anc_service_date),'-',year(anc_service_date)) as month_show,ifnull(count(*),0) as C_vn from person_anc_service 
				where anc_service_date between '$d1' and '$d2' group by month(anc_service_date) order by year(anc_service_date) , month(anc_service_date) ";
		$query = mysql_query($sql);
		$num_row = mysql_num_rows($query);
		$tb  = "<table class='table table-bordered table-hover table-striped'>
                                <thead>
                                    <tr>
                                        <th>เดือน</th>
                                        <th>จำนวน </th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tbody> ";

			$sum_C_vn = 0;

			while($result = mysql_fetch_array($query)){
					
					$C_vn  = $result['C_vn'];
					$month_show = $result['month_show'];
					$month_ = $result['month_'];
					$year_  = $result['year_'];
					$sum_C_vn  = $sum_C_vn + $C_vn ;
					$tb = $tb."	<tr>
									<td>$month_show</td>
									<td>$C_vn</td>
									<td><a target='bank_' href='showdetail.php?id=anc&Y=$year_&M=$month_'>...</a></td> 
                                 </tr> ";
			}

					   $tb = $tb."  
								<tr>
									<th>รวม</td>
									<th>$sum_C_vn</td>
									<td>-:-</td> 
                                 </tr>
								</tbody>
                            </table> ";
					return $tb;

	}//-------get_anc_table --------------------











?>