<?php
echo $this->element('header-home');
if(isset($this->request->params['named']['replyid']) && $this->request->params['named']['replyid']!='')
{
	$replyid=$this->request->params['named']['replyid'];
}
else
{
	$replyid='';
}
if(isset($this->request->params['named']['msgid']) && $this->request->params['named']['msgid']!='')
{
	$msgid=$this->request->params['named']['msgid'];
}
else
{
	$msgid='';
}
?>

	<div class="container">		
<?php echo $this->Session->flash(); ?>
	 <div class="row">					
			<div class="innerpanel">
				<!-- Left Sidebar Start -->
					<?php echo $this->element('dashboard-left');
					//echo $this->element('sql_dump');exit;
					//pr($alluser);exit;
					?>
				<!-- Left Sidebar End -->
				
				<!-- Right Sidebar Start -->
				<div class="col-md-9">
					<div class="clearfix" style="height:15px;"></div>
					<div class="col-lg-12 prof bs-example">					
								<h2 class="detailstitle1 blue23"><?php echo COMPOSEMESSAGE;?></h2>
								<div class="clearfix"></div>
								 <div class="clearfix" style="height:10px;"></div>
									<?php echo $this->Form->create('ManageMessage',array('role'=>'form','class'=>'form-horizontal')); ?>
					   <div class="signup_left col-lg-8">
					   <?php if($replyid==''){?>
					   <div class="form-group">
							<label class="col-lg-5 control-label"><?php echo SELECTUSER;?></label>
							<div class="col-lg-7">
							<?php echo $this->Form->input('to_user',array('label'=>false,'class'=>'form-control', 'type' => 'select', 'options' => $alluser));?> 
							</div>
						  </div>
						  <?php }else{
							  echo $this->Form->input('to_user',array('label'=>false,'class'=>'form-control', 'type' => 'hidden', 'value' => $replyid));
							   }?>
                               <?php if($msgid!=''){
								    echo $this->Form->input('parent',array('label'=>false,'class'=>'form-control', 'type' => 'hidden', 'value' => $msgid));
							   }?>
                               
						 <div class="form-group">
							<label class="col-lg-5 control-label"><?php echo MESSAGE;?></label>
							<div class="col-lg-7">
							<?php echo $this->Form->input('message',array('label'=>false,'class'=>'form-control'));?> 
							</div>
						  </div>
						   
						  <div class="form-group">
							<label class="col-lg-5 control-label" style="background:none;"></label>
							<div class="col-lg-7">
							
							  <?php echo $this->Form->button('Send',array('type'=>'submit', 'name' => 'send_msg','div'=>false,'class'=>'btn1 savebtn','style'=>'margin-left: 0em;'));?>
							 
							</div>
						  </div>
						  
						  
						  </div>
						</form>
							</div>
                    <div class="clear"></div>
			  </div>
				
		</div>
		<div class="clearfix"></div>
    </div>


    </div>
    <!-- /.container -->
    <script type='text/javascript'>
function chkEmail(){
	var email=$("#MasterUserEmail").val();
	var partn="^[a-z0-9._-]+@[a-z0-9]+\.[a-z]{2,6}$";
	var is_avl=email.match(partn);
	if(!is_avl){
		$("#MasterUserEmail").val('');
		$("#err_msg").removeAttr("style");
	}else{
		$("#err_msg").attr("style","display:none");
	}
}
</script>

<?php
echo $this->element('footer-home');
?>