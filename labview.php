	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<style type="text/css">
.Line {
	font-family: Verdana, Geneva, sans-serif;
	font-size:x-small;
	text-align: left;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: dotted;
	border-left-style: none;
	border-bottom-color: #CCC;
	border-bottom-width: 1px;
}
    </style>
	<link rel="stylesheet" href="jquery.treeview/jquery.treeview.css" />
	<link rel="stylesheet" href="screen.css" />
	
	<script src="jquery.treeview/lib/jquery.js" type="text/javascript"></script>
	<script src="jquery.treeview/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview/jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="demo.js"></script>

	
	<!--<h1 id="banner"><a href="http://bassistance.de/jquery-plugins/jquery-plugin-treeview/">jQuery Treeview Plugin</a> Demo</h1>-->
<form id="form1" name="form1" method="post" action="" >
  <div id="main">
  <ul id="browser" class="filetree"><!--    </ul>
  </div>
  <div id="main">
  	 <ul id="browser" class="filetree">--><B>LAB RESULT</B>
    <?php
		$sql_lab_group="select lh.sub_group_list,lg.lab_items_sub_group_name from lab_head lh
  left outer join lab_order lo on lo.lab_order_number=lh.lab_order_number
  left outer join lab_items li on lo.lab_items_code=li.lab_items_code
  left outer join lab_items_sub_group lg on lh.sub_group_list = lg.lab_items_sub_group_code
  where lh.vn='$_GET[visit]'
  and lo.confirm='Y'
  group by lh.sub_group_list
  order by lh.sub_group_list";
		$dbquery=mysql_db_query($dbname,$sql_lab_group);
		while ($result = mysql_fetch_array($dbquery)){
		?>
    
      <li class="closed"><span class="folder"><?php echo $result['lab_items_sub_group_name']; ?></span>
      		<ul>
            <?php 
			$sql_lab_result="select lo.lab_order_result,lo.lab_items_code,li.lab_items_name from lab_head lh
  left outer join lab_order lo on lo.lab_order_number=lh.lab_order_number
  left outer join lab_items li on lo.lab_items_code=li.lab_items_code
  where lh.vn='$_GET[visit]'
  and lh.sub_group_list='".$result['sub_group_list']."'
  and lo.confirm='Y'
  and lo.lab_order_result !=''
  order by lh.order_date desc"; 
			
			$dbquery_lab = mysql_db_query($dbname,$sql_lab_result);
			$i=0;
			while($row_lab = mysql_fetch_array($dbquery_lab)){
			?>
		    <li>
			    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Line">
               
			      <tr >
			        <td width="50%" bgcolor="#FFFFFF"><span class="file"><?php echo "$row_lab[lab_items_name]"; ?></span></td>
			        <td width="50%" bgcolor="#FFFFFF"><?php echo ": $row_lab[lab_order_result]"; ?></td>
		          </tr>
	          </table>
			  </li>
		    <?php } ?>
	    </ul>
      </li>
        <?php }?> <br />
    </ul>
  </div>
</form>


