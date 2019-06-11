<?php
    $urlpath = $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];  
	define('IPSERV',$urlpath);

	define("ImagePath",IPSERV."/docscan/");
	define('LOCALPATH',IPSERV."/opdcard/");
	//define("er_oper_code","175,176,177,180,160,118");
	define("er_oper_code","117,171,175,180");
	define("LimitY","5");
	define("LimitVisitDoctor","30");
	#Config Databases
	/*define("hostname","192.168.0.123");
	define("database","hos");
	define("username","sa");
	define("password","sa");*/
	
	#Config icode Drug DM-HT Profile
	define("Hctz","1900255");//ok
	define("Propranolol_10","1000255");//ok
	//define("Propranolol_40","1421102");
	//define("Methyldopa_125","1460012");
	define("Methyldopa_250","1460013"); //ok
	define("Amlodipine","1440105"); //ok
	define("Atenolol","1480207");//ok
	define("Hydralazine","1570023");//ok

	define("Enalapril","1000122");//ok
	define("Prazosin","1421201");
	define("Verapamil","1000310");
	define("Furosemide","1000139"); //ok
	define("Losartan","1580025");//ok
	define("Glibenclamide","1480156");//ok
	define("Metformin","1000184");// ok
	define("Glipizide","1900250");//ok
	define("Pioglitazone","1600018");//ok
	//define("MixInsulin","1460026");
	define("Mixtard","1540003");//ok
	define("Nph_p","1900349");//ok
	define("Nph_k","1900348");//ok

	define("Simvastatin","1900458"); //ok
	define("Gemfibrozil","1460168");//ok
	define("Asa","1900050"); //ok  
    define("Isdn","10000159"); // ok
    define("Clopidogrel","1570001"); // ok
    define("SodiumBicarbonate","1000278"); // ok
    define("Calciumcarbonate","1900102"); // ok

	
	function AutoZero($txt){
		//echo strlen($txt);
		$strZero = "";
		$len=strlen($txt);
		switch($len)
		{
			case 1:
				$strZero='000000'.$txt;
				break;
			case 2:
				$strZero='00000'.$txt;
				break;
			case 3:
				$strZero='0000'.$txt;
				break;
			case 4:
				$strZero='000'.$txt;
				break;
			case 5:
				$strZero='00'.$txt;
				break;
			case 6:
				$strZero='0'.$txt;
				break;
			case 7:
				$strZero=$txt;
				break;
		}
		return $strZero;
	}
?>