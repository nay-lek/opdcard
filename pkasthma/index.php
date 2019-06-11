<?php
Include('header.php');
Include('libs/function.php');
 $HN = $_SESSION['HN'];
 //$HN = '0046014';
 $sql = "select universal_head.vn,concat(pat.fname,' ' ,pat.lname) as 'ptname' ,universal_head.hn , vn_stat.vstdate , (SELECT if(universal_form_id=25,
                (SELECT max((CASE WHEN (universal_item_id = 6 and (universal_item_value_text*1) = 0) 
                                    or (universal_item_id = 5 and (universal_item_value_text*1) = 0 )
                                    OR (universal_item_id = 4 and (universal_item_value_text*1) < 2 )
                                    OR (universal_item_id = 3 and (universal_item_value_text*1) < 2 )
                                    OR (universal_item_id = 2 and (universal_item_value_text*1) < 2 )
                              
                              THEN  'Co' 

                               WHEN (universal_item_id = 2 and (universal_item_value_text*1) > 2 )
                                    or (universal_item_id = 3 and (universal_item_value_text*1) > 2 )
                                    or (universal_item_id = 4 and (universal_item_value_text*1) > 2 )
                                    or (universal_item_id = 5 and (universal_item_value_text*1) = 1 )
                                    or (universal_item_id = 6 and (universal_item_value_text*1) = 1)
                                
                                  THEN 'Un' 
                                
                              WHEN universal_item_value_text is null or universal_item_value_text='' THEN ''
                                  ELSE 'Pa'
                        END )) as CHK_form_25
              FROM universal_detail where universal_item_id BETWEEN '2' and '6' and universal_head_id = uh.universal_head_id
              GROUP BY universal_head_id )

        , 
          if((DATEDIFF(ovst.vstdate,(SELECT max(regdate) from ipt where hn = uh.hn and regdate < ovst.vstdate))) between 1 and 365,
                if(BODE.MMRC='L','C','D'), if(BODE.MMRC='L','A','B'))
      )
      as CHK

      from universal_head uh
      LEFT JOIN ovst on uh.vn = ovst.vn
      LEFT JOIN 
        (SELECT universal_detail.universal_head_id,if(((universal_detail.universal_item_value_text * 1)>2 or CAT_score.Sum_Cat >= 10),'R','L')  as 'MMRC' 
        from universal_detail 
        LEFT JOIN (SELECT universal_head_id,sum(universal_item_value_int) as Sum_Cat
        from universal_detail
        where universal_item_id BETWEEN '15' and '22'
        GROUP BY universal_head_id) CAT_score on universal_detail.universal_head_id = CAT_score.universal_head_id
        where universal_item_id = '23'
        GROUP BY universal_head_id ) BODE on uh.universal_head_id = BODE.universal_head_id

      WHERE uh.vn = universal_head.vn and uh.universal_form_id = 25 
      GROUP BY uh.vn ,uh.universal_head_id
      ORDER BY uh.vn desc, uh.universal_head_id limit 1 ) as 'CHK_25' ,

      (SELECT if(universal_form_id=25,
                (SELECT max((CASE WHEN (universal_item_id = 6 and (universal_item_value_text*1) = 0) 
                                    or (universal_item_id = 5 and (universal_item_value_text*1) = 0 )
                                    OR (universal_item_id = 4 and (universal_item_value_text*1) < 2 )
                                    OR (universal_item_id = 3 and (universal_item_value_text*1) < 2 )
                                    OR (universal_item_id = 2 and (universal_item_value_text*1) < 2 )
                              
                              THEN  'Co' 

                               WHEN (universal_item_id = 2 and (universal_item_value_text*1) > 2 )
                                    or (universal_item_id = 3 and (universal_item_value_text*1) > 2 )
                                    or (universal_item_id = 4 and (universal_item_value_text*1) > 2 )
                                    or (universal_item_id = 5 and (universal_item_value_text*1) = 1 )
                                    or (universal_item_id = 6 and (universal_item_value_text*1) = 1)
                                
                                  THEN 'Un' 
                                
                              WHEN universal_item_value_text is null or universal_item_value_text='' THEN ''
                                  ELSE 'Pa'
                        END )) as CHK_form_25
              FROM universal_detail where universal_item_id BETWEEN '2' and '6' and universal_head_id = uh.universal_head_id
              GROUP BY universal_head_id )

        , 
          if((DATEDIFF(ovst.vstdate,(SELECT max(regdate) from ipt where hn = uh.hn and regdate < ovst.vstdate))) between 1 and 365,
                if(BODE.MMRC='L','C','D'), if(BODE.MMRC='L','A','B'))
      )
      as CHK

      from universal_head uh
      LEFT JOIN ovst on uh.vn = ovst.vn
      LEFT JOIN 
        (SELECT universal_detail.universal_head_id,if(((universal_detail.universal_item_value_text * 1)>2 or CAT_score.Sum_Cat >= 10),'R','L')  as 'MMRC' 
        from universal_detail 
        LEFT JOIN (SELECT universal_head_id,sum(universal_item_value_int) as Sum_Cat
        from universal_detail
        where universal_item_id BETWEEN '15' and '22'
        GROUP BY universal_head_id) CAT_score on universal_detail.universal_head_id = CAT_score.universal_head_id
        where universal_item_id = '23'
        GROUP BY universal_head_id ) BODE on uh.universal_head_id = BODE.universal_head_id

      WHERE uh.vn = universal_head.vn and uh.universal_form_id = 26 
      GROUP BY uh.vn ,uh.universal_head_id
      ORDER BY uh.vn desc, uh.universal_head_id limit 1 ) as 'COPD_GOLD'  ,

      (SELECT sum(universal_item_value_int) as Sum_Cat
        from universal_detail
        where universal_item_id BETWEEN '15' and '22' and 
           universal_detail.universal_head_id = (SELECT uh_cat.universal_head_id FROM universal_head uh_cat where uh_cat.universal_form_id = 26 and uh_cat.vn=universal_head.vn limit 1)
        GROUP BY universal_head_id ) as 'CAT_Score' ,


      (SELECT (universal_item_value_text)*1 as MMRC
        from universal_detail
        where universal_item_id =23 and 
           universal_detail.universal_head_id = (SELECT uh_cat.universal_head_id FROM universal_head uh_cat where uh_cat.universal_form_id = 26 and uh_cat.vn=universal_head.vn limit 1)
        GROUP BY universal_head_id )  as 'MMRC' , 


          if(pat.height<150,(5.2428 * (pat.height)-425.5714),
                   if(vn_stat.age_y<15,(5.2428 * (pat.height)-425.5714),
                           if(pat.sex = 1 ,(0.307* (vn_stat.age_y)+0.141 * (pat.height)-0.0018*(vn_stat.age_y)*(vn_stat.age_y)-0.001*(vn_stat.age_y)*(pat.height)-16.859 )*60
                              , ((0.162* (vn_stat.age_y)+0.391 * (pat.height)-0.00084*(vn_stat.age_y)*(vn_stat.age_y)-0.00072*(vn_stat.age_y)*(pat.height)-31.355)-(0.00099*(pat.height)*(pat.height)))*60 
             ))) as 'PERF'  , 


      (SELECT (universal_item_value_text)*1 
        from universal_detail
        where universal_item_id =8 and  
           universal_detail.universal_head_id = (SELECT uh_cat.universal_head_id FROM universal_head uh_cat where  uh_cat.vn=universal_head.vn limit 1)
        GROUP BY universal_head_id ) as 'result_PERF' ,



      round((SELECT (universal_item_value_text)*1 
              from universal_detail
              where universal_item_id =8 and  
                 universal_detail.universal_head_id = (SELECT uh_cat.universal_head_id FROM universal_head uh_cat where  uh_cat.vn=universal_head.vn limit 1)
              GROUP BY universal_head_id )  /
            ( if(pat.height<150,(5.2428 * (pat.height)-425.5714),
                   if(vn_stat.age_y<15,(5.2428 * (pat.height)-425.5714),
                           if(pat.sex = 1 ,(0.307* (vn_stat.age_y)+0.141 * (pat.height)-0.0018*(vn_stat.age_y)*(vn_stat.age_y)-0.001*(vn_stat.age_y)*(pat.height)-16.859 )*60
                              , ((0.162* (vn_stat.age_y)+0.391 * (pat.height)-0.00084*(vn_stat.age_y)*(vn_stat.age_y)-0.00072*(vn_stat.age_y)*(pat.height)-31.355)-(0.00099*(pat.height)*(pat.height)))*60 
             )))   )*100,2) as 'PERF%'  ,

      vn_stat.age_y as  'age_y' ,
      pat.height as 'height' ,
      oapp.nextdate ,
      opdscreen.smoking_type_id,

     (select (SELECT universal_item_value_name
                from universal_item_value_list 
                     where universal_item_value_code in(REPLACE(universal_detail.universal_item_value_text,';',''))
                      and universal_item_id = 35) 
      from universal_detail
      where universal_item_id = 35 and universal_head_id in(SELECT universal_head_id 
        from universal_head 
        where vn = vn_stat.vn and universal_head.universal_form_id = '28')) as 'Drug_use',


      (select sum(universal_item_value_text)
      from universal_detail
      where universal_item_id BETWEEN '24' and '32' and universal_head_id in(SELECT universal_head_id 
        from universal_head 
        where vn = vn_stat.vn and universal_head.universal_form_id = '28')) as 'Drug_score' ,
       

       universal_head.universal_head_id  as 'universal_head_id'


      from universal_head
      LEFT JOIN vn_stat on universal_head.vn = vn_stat.vn
      left join patient pat on universal_head.hn = pat.hn
      LEFT JOIN oapp on universal_head.vn = oapp.vn
      left JOIN opdscreen on universal_head.vn = opdscreen.vn
      where universal_head.hn = '$HN'
      GROUP BY universal_head.vn
      ORDER BY opdscreen.vn desc";


        $result = $db->prepare($sql);
				$result->execute();
				$rows = $result->rowcount();
?>
   

<div class="row">
	<div class="col-md-12">
		<h1> -------Asthma Clinic</h1>
	</div>
	
</div><!--/.row-->
			
<div class="row">
	<div class="col-md-12">
		<table class="tabel hover" border="1">
			<thead>
				<tr>
                  <th colspan="18" > ชื่อ-สกุล :=<?=get_ptname($HN);?>     HN := <?php echo $HN; ?>     จำนวนตรวจ  :=  <?php echo $rows;?> ครั้ง </th>
                  </tr>
					        <tr>                      
                      <th rowspan="2">วันที่ตรวจ</th>
                      <th rowspan="2">อายุ</th>
										  <th colspan="3" bgcolor="#a0F0e0">ประเมินอาการกำเริบ</th>
                      <th colspan="4" bgcolor="#F006e9" align="center">COPD GOLD</th>
                      <th rowspan="2">PEFR%</th>
                      <th rowspan="2">CAT Score</th>
                      <th rowspan="2">MMRC</th>
                      <th colspan="4">การสูบบุหรี่</th>                     
                      <th rowspan="2">นัดครั้งต่อไป</th>
                      <th rowspan="2">สูตรยา<span class="badge">คะแนน</span>  </th>                        
                  </tr>

                  <tr>
                      <th  bgcolor="#a0F0e0" align="center">Con</th>
                      <th  bgcolor="#a0F0e0" align="center">Par</th>
                      <th  bgcolor="#a0F0e0" align="center">Un</th>
                      <th bgcolor="#F006e9">A</th>
                      <th bgcolor="#F006e9">B</th>
                      <th bgcolor="#F006e9">C</th>
                      <th bgcolor="#F006e9">D</th>
                      <th>ไม่สูบ</th>
                      <th>สูบ</th>
                      <th>เลิกแล้ว</th>                      
                      <th>ไม่ทราบ</th>
                  </tr>
			</thead>
			<tbody>
			<?php 
			    $i=1; 

				while ($row = $result->fetch()){
                $ptname = $row['ptname'];
                $vttdate =  get_date_show($row['vstdate']);
			          $PEFR = $row['PERF%'];
	              $CAT_score  = $row['CAT_Score'];
	              $MMRC  = $row['MMRC'];
	              $nextdate  = get_date_show($row['nextdate']);


	 			$CHK_25 = $row['CHK_25'];
			    switch ($CHK_25) {
                          case 'Co':
                            $Co = "<i class='fa fa-2x fa-check' aria-hidden='true'></i>";
                            $Pa = '';
                            $Un = '';
                            break;

                          case 'Pa':
                            $Co = '';
                            $Pa = "<i class='fa fa-2x fa-circle-o' aria-hidden='true'></i>";
                            $Un = '';

                            break;
                          
                          case 'Un':
                            $Co = '';
                            $Pa = '';
                            $Un = "<i class='fa fa-2x fa-times' aria-hidden='true' color='red'></i>";

                            break;
                          default:
                            $Co = '';
                            $Pa = '';
                            $Un = '';
                            break;
                        }


         $COPD_GOLD =  $row['COPD_GOLD'];
                  switch ($COPD_GOLD) {
                    case 'A':
                            //$A = "<i class='fa fa-1x fa-hand-o-right' aria-hidden='true'>A</i>";
                            $A = 'A';
                            $B = '';
                            $C = '';
                            $D = '';
                      break;

                    case 'B':
                            $A = '';
                            //$B = "<i class='fa fa-1x fa-hand-o-right' aria-hidden='true'>B</i>";
                            $B = 'B';
                            $C = '';
                            $D = '';
                      break;

                    case 'C':
                            $A = '';
                            $B = '';
                            //$C = "<i class='fa  fa-1x fa-hand-o-right' aria-hidden='true'>C</i>";
                            $C = 'C';
                            $D = '';
                      break;
                    
                    case 'D':
                            $A = '';
                            $B = '';
                            $C = '';
                            //$D = "<i class='fa fa-1x fa-hand-o-right' aria-hidden='true'>D</i>";
                            $D = 'D';
                      break;
                    default:
                            $A = '';
                            $B = '';
                            $C = '';
                            $D = '';
                      break;
                  }

	              $smoking  = $row['smoking_type_id'];
                  switch ($smoking) {
                      case '1':
                        $smok_1  = "<i class='fa fa-2x fa-smile-o' aria-hidden='true'></i>";
                        $smok_2  = "";
                        $smok_3  = "";
                        $smok_4  = "";
                        break;
                      case '2':
                        $smok_1  = "";
                        $smok_2  = "<i class='fa fa-2x fa-frown-o' aria-hidden='true'></i>";
                        $smok_3  = "";
                        $smok_4  = "";
                        break;
                      case '3':
                        $smok_1  = "";
                        $smok_2  = "";
                        $smok_3  = "<i class='fa fa-2x fa-thumbs-o-up' aria-hidden='true'></i>";
                        $smok_4  = "";
                        break;
                      case '4':
                        $smok_1  = "";
                        $smok_2  = "";
                        $smok_3  = "";
                        $smok_4  = "<i class='fa fa-2x fa-meh-o' aria-hidden='true'></i>";
                        break;
                      default:
                        $smok_1  = "";
                        $smok_2  = "";
                        $smok_3  = "";
                        $smok_4  = "";

                        break;
                    }
               $Drug_use  = $row['Drug_use'];
               $Drug_score  = $row['Drug_score'];

              // echo $Drug_use;
			?>
				<tr>					
					<td><?php  echo $vttdate  ;?></td>
					<td><?php echo $row['age_y'] ;?></td>
					<td ><font face='Wingdings 2' color ='green'><?php echo $Co;?> </font></td>
					<td><?php echo $Pa;?></td>
                    <td><?php echo $Un;?></td>
                   	<td><?php echo $A;?></td>
                    <td><?php echo $B;?></td>
                    <td><?php echo $C;?></td>
                    <td><?php echo $D;?></td>
                    <td><?php echo $PEFR;?></td>
                 	<td><?php echo $CAT_score;?></td>
                    <td><?php echo $MMRC;?></td>
                    <td><?php echo $smok_1;?></td>
                    <td><?php echo $smok_2;?></td>
                    <td><?php echo $smok_3;?></td>
                    <td><?php echo $smok_4;?></td>
                    <td><?php echo $nextdate;?></td>

					<td>
						<?php
							//	--select score items
							$selec_item = "select (SELECT CONCAT(DATE_FORMAT(ovst.vstdate ,'%d-%m-'),DATE_FORMAT(ovst.vstdate ,'%Y')+534)
        from universal_head
        left join ovst on universal_head.vn = ovst.vn
        where universal_head.universal_head_id = universal_head_id limit 1) as vstdate ,universal_item_id,universal_item_value_text,case WHEN universal_item_value_text ='0' THEN 'ได้' ELSE 'ไม่ได้' END as 'TXT_Value' , 
							case WHEN universal_item_value_text ='0' THEN 'success' ELSE 'danger' END as 'CHK_Value' ,
               (universal_item_id -23) as _items
               							from universal_detail
											where universal_item_id BETWEEN '24' and '32' and universal_head_id in(SELECT universal_head_id 
                                from universal_head where vn = :vn_param and universal_head.universal_form_id = '28')
											ORDER BY universal_item_id";

							$result_item = $db->prepare($selec_item);
							$result_item ->execute(array(':vn_param'=>$row['vn']));
              //echo $rows['vn'];
							$row_result_item = $result_item->rowcount();
							while ($rows_item = $result_item->fetch()){
								    $_items_id[]  = $rows_item['universal_item_id'];
									  $_items_txt[] = $rows_item['TXT_Value'];
									  $_items_chk[] = $rows_item['CHK_Value'];
                    //$_items_vstdate = $rows_item['vstdate'];

							}//--/.while-$rows_item
                $vvt  = get_date_show($row['vstdate']);
                //echo $vvt;
						?>
					     <a href="#" class="view-druguse"
					     			data-items1 ="<?php echo $_items_txt[0] ;?>"
										data-items2 ="<?php echo $_items_txt[1] ;?>"
										data-items3 ="<?php echo $_items_txt[2] ;?>"
										data-items4 ="<?php echo $_items_txt[3] ;?>"
										data-items5 ="<?php echo $_items_txt[4] ;?>"
										data-items6 ="<?php echo $_items_txt[5] ;?>"
										data-items7 ="<?php echo $_items_txt[6] ;?>"
										data-items8 ="<?php echo $_items_txt[7] ;?>"
										data-items9 ="<?php echo $_items_txt[8] ;?>"
                    data-vvst ="<?php echo  $vvt  ;?>"
                    data-ptname ="<?php echo $ptname ;?>"
					     >
					           <?php echo $Drug_use;?> <span class="badge"><?php echo $Drug_score;?></span>		           
					      </a>

						
					</td>

					
				</tr>

        
			<?php 
				$i++;
		       } //--./end foreach $person

			 ?>
			</tbody>
		</table>
	</div>
	
</div><!--/.row-->



<!-- Modal Data -->
<div class="modal fade" id="vieeScroeGruguse">
	<div class="modal-dialog">
		<form action="save.php" method="post">
			<div class="modal-content">
				<div class="modal-header">				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<H3>เทคนิคการใช้ยาสูดพ่น : <output name="vvstdate" id="vvstdate" > </H3>
				</div><!--/.modal-header-->
				<div class="modal-body">
					
					<div class="form-group ">
					    <div class="alert alert-<?php echo $_items_chk[0];?>" role="alert">
							<label for="items1">1.1 เขย่าขวดยาให้กระจายตัว/เปิด-ปิด ยาถูกต้อง </label>
							<input type="text" name="items1" id="items1" value="" readonly="true">
						</div>
					</div><!--/.form-group-items1-->

					<div class="form-group">
						 <div class="alert alert-<?php echo $_items_chk[1];?>" role="alert">
							<label for="items2">1.2 เปิดฝาครอบออกแล้วต่อท่อช่วยพ่นยา (ถ้ามี) เข้ากับหลอดยาจนแน่น</span></label>
							<input type="text" name="items2" id="items2" value="" readonly="true">
						</div>
					</div><!--/.form-group-items2-->
					

					<div class="form-group">
						<div class="alert alert-<?php echo $_items_chk[2];?>" role="alert">
							<label for="items3">1.3 หายใจเข้า-ออก 1 ครั้ง </label>
							<input type="text" name="items3" id="items3" value="" readonly="true">
						</div>
					</div><!--/.form-group-items3-->

					<div class="form-group">
						<div class="alert alert-<?php echo $_items_chk[3];?>" role="alert">
							<label for="items4">1.4 ตั้งหลอดยาขึ้น อมปลายหลอดยา และหุบปากให้สนิท</label>
							<input type="text" name="items4" id="items4" value="" readonly="true">
						</div>
					</div><!--/.form-group-items4-->

					<div class="form-group">
						<div class="alert alert-<?php echo $_items_chk[4];?>" role="alert">
							<label for="items5"><p>1.5 กดยาพ่น 1 ครั้งกับสูดยาเข้าปอดช้าๆ ลึกๆ / การสูดยาเข้าปอดเร็วๆ แรงๆ ลึกๆ</p></label>
							<input type="text" name="items5" id="items5" value="" readonly="true">
						</div>
					</div><!--/.form-group-items5-->

					<div class="form-group">
						<div class="alert alert-<?php echo $_items_chk[5];?>" role="alert">
							<label for="items6"><p>1.6 กลั้นหายใจไว้อย่างน้อย 5-10 วินาที</p></label>
							<input type="text" name="items6" id="items6" value="" readonly="true">
						</div>
					</div><!--/.form-group-items6-->

					<div class="form-group">
						<div class="alert alert-<?php echo $_items_chk[6];?>" role="alert">
							<label for="items7"><p>1.7 หายใจออกทางจมูกช้าๆ</p></label>
							<input type="text" name="items7" id="items7" value="" readonly="true">
						</div>
					</div><!--/.form-group-items7-->

					<div class="form-group">
						<div class="alert alert-<?php echo $_items_chk[7];?>" role="alert">
							<label for="items8"><p>1.8 หากต้องการพ่นยาซ้ำควรทิ้งช่วงตากครั้งแรก ประมาณ 1 นาที</p></label>
							<input type="text" name="items8" id="items8" value="" readonly="true">
						</div>
					</div><!--/.form-group-items8-->

					<div class="form-group">
						<div class="alert alert-<?php echo $_items_chk[8];?>" role="alert">
							<label for="items9"><p>1.9 กรณีพ่นยาสูดสเตียรอยด์ให้บ้วนปากด้วยน้ำสะอาด</p></label>
							<input type="text" name="items9" id="items9" value="" readonly="true">
						</div>
					</div><!--/.form-group-items9-->

					<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
						
					</div>

				</div><!--/.modal-body-->
				
			</div><!--/.modal-content-->
			
		</form>
	</div><!--/.modal-dialog-->
	
</div><!--/.modal-fade-->


<?php
Include('footer.php');

?>