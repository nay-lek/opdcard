<?php
//include('config/define.php');
include('config/class.mysqldb.php');
include('config/config.inc.php');
?>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
   
<div class="container">
	    <br/>
		<center>
		<h3>ระบบดูแฟ้มประวัติผู้ป่วย</h3><hr/>
		  <img src = '<?php //echo $row['pic_name'];?>' width='200px'/>
			<h4>โรงพยาบาล <?php echo $hospitalname;?></h4>
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
			  <div class="panel panel-info" >
			    <div class="panel-heading">
			      <div class="panel-title">ลงชื่อเข้าใช้งาน</div>
			      <div style="float:right; font-size: 80%; position: relative; top:-10px"></div>
		        </div>
			    <div style="padding-top:30px" class="panel-body" >
			      <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
			      <form id="loginform" class="form-horizontal" role="form" action = 'loginQuery.php' method='post'>
			        <div style="margin-bottom: 25px" class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			          <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username" />
		            </div>
			        <div style="margin-bottom: 25px" class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			          <input id="login-password" type="password" class="form-control" name="password" placeholder="password" />
		            </div>
			        <div style="margin-top:10px" class="form-group">
			          <!-- Button -->
			          <div class="col-sm-12 controls">
			            <!-- <a id="btn-login" href="#" class="btn btn-success">Login  </a>-->
			            <input type = 'submit' id = 'btn-login' name = 'btn-login' class="btn btn-success"  value='Login'/>
		              </div>
		            </div>
			        <div class="form-group">
			          <div class="col-md-12 control">
			            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
			              <p>โรงพยาบาล <?php echo $hospitalname;?></p>
			              <a href="#" onclick="$('#loginbox').hide(); $('#signupbox').show()"> </a> </div>
		              </div>
		            </div>
		          </form>
			      <?php // }?>
		        </div>
		      </div>
		  </div>
  </center>
</div>
	<script>
		<?php echo "123" ;?>
	</script>