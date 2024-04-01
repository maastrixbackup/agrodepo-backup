<div style='width:970px; border:1px solid black;padding:10px;'>
 <div style='margin-bottom:10px;'>
	<span>
	<h3 style='color:black;display:inline;'><?php
	echo $this->Custom->user_type($user_data['user_type_id']).":";
	?>
	</h3>
	</span>
	<span style='font-size:30px;'>
			<?php echo $user_data['first_name'];?>
	</span>
 </div>
<hr>
 <div>
	<div style='float:left;width:300px;'>
		<table border='0'>
			<tr>
				<th>Member since:</th>
				<td>
				<?php 
				$cdate=date('d F Y',strtotime(@$user_data['created']));
				echo $cdate;
				?>
				</td>
			</tr>
			<tr>
				<th>Last time online:</th>
				<td><?php 
				$ldate=@$user_data['last_login']?date('F d,Y',strtotime(@$user_data['last_login'])) :'';
				echo @$ldate;
				?>
				</td>
			</tr>
			<tr>
				<th>Location:</th>
				<td><?php echo $this->Custom->region_nm($user_data['country_id']).". ".$this->Custom->location_nm(@$user_data['locality_id']);?></td>
			</tr>
			<tr>
				<td colspan="2"><a href="javascript:void(0)">Favorite Seller</a></td>
			</tr>
			<tr>
				
				<td colspan='2'>
				<a href='javascript:void(0);' onclick='showReport()'>Report user</a>
				<div style='display:none;' class='wid280' id='mail_div' >
				<?php echo $this->Form->create('',array('default'=>'false'));?>
				<input type='hidden' name='hid_flag' id='hid_flag' value='0'>
					<table>
						<tr>
						<td>Reporting Reason</td>
						<td>
							<select name='r_reason' id='r_reason' required=required>
								<option value=''>--Select reason for reporting--</option>
								<option value='1'>Seller untrustworthy</option>								
								<option  value='2'>Rating incorrect</option>								
								<option  value='3'>Other reason</option>								
							</select><br/>
							<label id='err_msg_rsn' style='display:none;'><font color='red'>This field is required</font></label>
						</td>
						</tr>
						<tr>
						<!--<td>E-mail</td>
						<td>
						<?php //echo $this->Form->input("",array("type"=>"email"));?>
						</td>
						</tr>
						<tr>
						<td>Phone</td>
						<td>
						<?php //echo $this->Form->input("",array("type"=>"phone"));?>
						</td>
						</tr> -->
						<tr>
						<td colspan=2>
						Describe in as much detail irregularity found
						<textarea id='desc' name='desc' required='required'></textarea>
						<label id='err_msg_desc' style='display:none;'><font color='red'>This field is required</font></label>
						</td>
						</tr>
						<tr>
						<td colspan=2><input type='button' onclick='sendMail();' value='Send'></td>
						</tr>
					</table>
					<?php echo $this->Form->end();?>
				</div>
				<div id='mresp_div' style='display:none'><font color='red'>Data were sent to the site administrator. 
Thank you for reporting.</font></div>
				</td>
			</tr>
		</table>
	</div>
	<div style='float:left;margin-left:5px;width:345px;'>
		<table>
			<tr>
				<th>Ratings</th>
				<td>Last month</td>
				<td>Last 6 months</td>
				<td>Last year</td>
				<td>All</td>
			</tr>
			<?php 
			$rating_arr=array("Positives","Neutrals","Negative"); // hard coaded 
			$rate=array(0,0,0,0); // hard coaded for testing purpose only
			foreach($rating_arr AS $key=>$val){
				?>
				<tr>
				<td><a href='javascript:void(0)'><img src=''><?php echo $val;?></a></td>
				<td><?php echo @$rate[0];?></td>
				<td><?php echo @$rate[1];?></td>
				<td><?php echo @$rate[2];?></td>
				<td><?php echo @$rate[3];?></td>
				</tr>
				<?
			}
			?>
		</table>
	</div>
	<div style='float:left;margin-left:5px;width:310px;'>
		<table width='100%'>
			<tr>
			<th>Detailed Ratings</th>
			<th></th>
			<td>Ratings</td>
			</tr>
			<?php 
				$rating_param=array("Product as described","Communication with seller","Delivery time","Cost of transport");
				$rated_val=array(1,0,2,0);
				foreach($rating_param AS $key =>$val){
					?>
				<tr>
				  <td width='30%'><?php echo $val;?></td>
				  <td width='50%'>
				  <?php
				  for($i=0;$i<5;$i++){
					  echo "<img src=$this->webroot/img/rate.png />";
				  }
				  /*foreach($rated_val AS $k=>$v){
					  $r_limit=5; // rate out of
					 
					  }*/
				  ?>
				  </td>
				 
				  <td width='20%'>0</td> <!--hard coaded for demo -->
				  
				</tr>
					<?php
				}

			?>
			
		</table>
	</div>
	<div style='clear:both;'></div>
 </div>
</div>
<style>
table tr th,td{
border-width:0px;
}
.wid280{
	width:280px;
	z-index:100;
}
</style>
<script>
function sendMail(){
	var reason=$("#r_reason").val();
	var desc=$("#desc").val();
	var url="<?php echo $this->webroot.'MasterUsers/sendMail/'?>";
	if(reason && desc){
		$("#err_msg_rsn").attr("style","display:none");
		$("#err_msg_desc").attr("style","display:none");
		$.post(url,{'reason':reason,'desc':desc},function(res){
		if(res==1){
			$("#hid_flag").val(1);
			$("#mail_div").attr("style","display:none");
			$("#mresp_div").removeAttr("style");
		}else{
			$("#mresp_div").attr("style","display:none");
			$("#mail_div").removeAttr("style");
		}
	});
	}else if(reason){
		$("#err_msg_rsn").attr("style","display:none");
		$("#err_msg_desc").removeAttr('style');
	}else if(desc){
		$("#err_msg_desc").attr("style","display:none");
		$("#err_msg_rsn").removeAttr('style');
	}else{
		$("#err_msg_rsn").removeAttr('style');
		$("#err_msg_desc").removeAttr('style');
	}
	
}
function frm_validate(){
	
}
function showReport(){
	var flag=$("#hid_flag").val();
	if(flag==1){
	$("#mresp_div").toggle();	
	}else{
	$("#mail_div").toggle();
	}
	
}
</script>
