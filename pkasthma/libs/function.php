<?php
include("conn/condb.php");

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

function get_date_show($date_f){		
		$date_show  =  substr($date_f,8,2);
		$date_show  =  $date_show."-".substr($date_f,5,2);
		$date_show  =  $date_show."-".(substr($date_f,0,4)+543);
		return $date_show;
}



function get_ptname($hn){
		//$d1 = get_date_sql($d1);
		//$d2 = get_date_sql($d2);
		include("conn/condb.php");



		$sql = "select concat(pname,'' ,fname,' ',lname) as ptname from patient where hn = :hn_param";
		$result = $db->prepare($sql);
		$result->execute(array(':hn_param'=>$hn));
		while ($row = $result->fetch()){
			 $ptname = $row['ptname'];
		}
		return $ptname;
}




function get_value_universal_detail_24_34($unversal_head_id){
		$sql = "select universal_item_id,universal_item_value_text,case WHEN universal_item_value_text ='0' THEN 'ได้' ELSE 'ไม่ได้' END as 'TXT_Value' , (universal_item_id -23) as _items
				from universal_detail
				where universal_item_id BETWEEN '24' and '32' and universal_head_id ='$unversal_head_id'
				ORDER BY universal_item_id ";
		/*$query = mysql_query($sql);
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

				*/
			return $sql;
	}//-------get_anc_table --------------------











?>