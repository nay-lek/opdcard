<?php 
  $thai_month_arr=array(  
    "0"=>"",  
    "1"=>"มกราคม",  
    "2"=>"กุมภาพันธ์",  
    "3"=>"มีนาคม",  
    "4"=>"เมษายน",  
    "5"=>"พฤษภาคม",  
    "6"=>"มิถุนายน",   
    "7"=>"กรกฎาคม",  
    "8"=>"สิงหาคม",  
    "9"=>"กันยายน",  
    "10"=>"ตุลาคม",  
    "11"=>"พฤศจิกายน",  
    "12"=>"ธันวาคม"                    
);
$thai_month_short_arr=array(  
    "0"=>"",  
    "1"=>"ม.ค.",  
    "2"=>"ก.พ.",  
    "3"=>"มี.ค.",  
    "4"=>"เม.ย.",  
    "5"=>"พ.ค.",  
    "6"=>"มิ.ย.",   
    "7"=>"ก.ค.",  
    "8"=>"ส.ค.",  
    "9"=>"ก.ย.",  
    "10"=>"ต.ค",  
    "11"=>"พ.ย.",  
    "12"=>"ธ.ค."                    
);

function thai_month($d){  
    $thai_month_return = "";
    global $thai_day_arr,$thai_month_arr;  
	date_default_timezone_set('UTC');
    //$thai_date_return="วัน".$thai_day_arr[date("w",$time)];  
    //$thai_date_return.= "ที่ ".date("j",$time);  
    $thai_month_return.=$thai_month_arr[date("n",$d)];  
    $thai_month_return.= " ".(date("Y",$d)+543);  
   // $thai_date_return.= "  ".date("H:i",$time)." น.";  
    return $thai_month_return;  
} 
function thai_date($d){  
    $thai_date_return = "";
    global $thai_day_arr,$thai_month_arr;  
	date_default_timezone_set('UTC');
    //$thai_date_return="วัน".$thai_day_arr[date("w",$time)];  
    $thai_date_return.= date("j",$d);  
    $thai_date_return.=" ".$thai_month_arr[date("n",$d)];  
    $thai_date_return.= " ".(date("Y",$d)+543);  
   // $thai_date_return.= "  ".date("H:i",$time)." น.";  
    return $thai_date_return;  
} 
function thai_date_short($d){  
    $thai_date_short_return = "";
    global $thai_day_arr,$thai_month_short_arr;  
	date_default_timezone_set('UTC');
    //$thai_date_return="วัน".$thai_day_arr[date("w",$time)];  
    $thai_date_short_return.= date("j",$d);  
    $thai_date_short_return.=" ".$thai_month_short_arr[date("n",$d)];  
    $thai_date_short_return.= " ".(date("Y",$d)+543);  
   // $thai_date_return.= "  ".date("H:i",$time)." น.";  
    return $thai_date_short_return;  
} 


function get_date_show($date_f) {
    $date_show = substr($date_f, 8, 2);
    $date_show = $date_show . "-" . get_thaimonth_short(substr($date_f, 5, 2));
    $date_show = $date_show . "-" . (substr($date_f, 0, 4) + 543);
    return $date_show;
}



function get_thaimonth_short($m){  
    switch ($m) {
        case '01':
            $m = "ม.ค.";
            break;
        case '02':
            $m = "ก.พ.";
            break;       
        case '03':
            $m = "มี.ค.";
            break; 
        case '04':
            $m = "เม.ย.";
            break;
        case '05':
            $m = "พ.ค.";
            break;
        case '06':
            $m = "มิ.ย.";
            break;
        case '07':
            $m = "ก.ค.";
            break;
        case '08':
            $m = "ส.ค.";
            break;
        case '09':
            $m = "ก.ย.";
            break;
        case '10':
            $m = "ต.ค";
            break;
        case '11':
            $m = "พ.ย.";
            break;
        case '12':
            $m = "ธ.ค.";
            break;            
        default:
            $m = "";
            break;
    }  

    return $m ;                  
};
?>