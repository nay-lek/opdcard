<?php
@session_start();
include('config/define.php');
include('config/connect.php'); 
$page = $_GET['p'];
$an = $_GET['an'];
$exists = "";
function chk_filename($an){
			//$filename = 'http';
			

			$file = 'http://'.ImagePath.'IPD/'.$an.'.pdf';

			$file_headers = @get_headers($file);
			if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {

				$exists = "non";
			}
			else {
			    $exists = "ok";
			}
				//echo $file;
			return $exists;

}
//echo chk_filename($an);
if(chk_filename($an)=="ok"){
 echo '<object data="http://'.ImagePath.'IPD/'.$an.'.pdf#page='.$page.'" type="application/pdf" width="100%"" height="100%"">';
}else{  
	echo '<h1>HTTP/1.1 404 Not Found ! <br> Please Scan Chart For <code>AN:'.$an.' </code>Again</h1>';

}




    //===================================================
        $result_refer_number = "";
        $sql_select_refer  = "select * from referout where vn ='".$an."'";
        $dbquery=mysql_db_query($dbname,$sql_select_refer);
        while ($result_refernum = mysql_fetch_array($dbquery)) {
            $result_refer_number = $result_refernum['hn'].'-'.$result_refernum['refer_number'];
        }

       // echo  $result_refer_number;


    $resultsReferBack = glob("../docscan/Refer/ReferBack/".$result_refer_number.".png");
               //echo $results[0];
                foreach($resultsReferBack as $item) {
                      //  if(basename($item,'.png')==$_GET['visit']){                  
                              echo '<img src="http://'.ImagePath.'/Refer/ReferBack/'.basename($item,'.png').'.png" width="100%" border="1"/>';

                     //   } 
      }




//echo '<img src=http://'.ImagePath.'IPD/'.'600003432'.'.pdf width=100% heigth=100%>';
 //echo '<object data="http://192.168.1.201/docscan/IPD/600003432.pdf#page=5" type="application/pdf" width="100%" height="100%">';
 //echo '<embed src="http://192.168.1.201/docscan/IPD/600003432.pdf#page=5" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">';
/*
include('config/define.php');
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    //echo 'Username or Password not found !';
    exit;
} else {
    if ($_SERVER['PHP_AUTH_USER']=='pkd' && $_SERVER['PHP_AUTH_PW']=='h11037')
	{
		
		echo '<img src=http://'.ImagePath.'/opd/'.intval($_SESSION['HN']).'/'.$_GET['id'].'.png width=100% heigth=100%>';
		unset($_SERVER['PHP_AUTH_USER']);
	}else
	{
		header('WWW-Authenticate: Basic realm="My Realm"');
    	header('HTTP/1.0 401 Unauthorized');
		echo 'Username or Password not found !';
    	exit;
	}	
}
*/
?>


