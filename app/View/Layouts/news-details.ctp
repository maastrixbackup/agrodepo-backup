<?php
echo $this->element('header-home');
//echo $this->element('sql_dump');
//pr($SalesOrders);
?>

 <div class="container">
      <?php echo $this->Session->flash(); ?>
	 <div class="row">					
			<div class="innerpanel">
				<!-- Left Sidebar Start -->
					<?php ///echo $this->element('dashboard-left');
					//echo $this->element('sql_dump');exit;
					//pr($alluser);exit;
					?>
				<!-- Left Sidebar End -->
				
				<!-- Right Sidebar Start -->
				<div class="col-md-9">
					<div class="clearfix" style="height:15px;"></div>
					<div class="col-lg-12 prof bs-example">					
								<h2 class="detailstitle1 blue23"><?php echo "News Details";?></h2>
								<div class="clearfix"></div>
								 <div class="clearfix" style="height:10px;"></div>
									<?php //echo $this->Form->create('SuccessStory',array('role'=>'form','class'=>'form-horizontal')); ?>
					   <div class="signup_left col-lg-10">

						 
						   <div class="form-group">
							<label class="col-lg-12"><?php echo DESCRIPTION;?></label>
							<div class="col-lg-12">
                            <?php $newsImg=$newsDetails['News']['news_img'];
							$newsTitle=$newsDetails['News']['news_title'];
							?>
							<img  style="float:left; margin-right:20px; margin-bottom:30px;" src="<?php echo $base_url;?>files/news/<?php echo $newsImg;?>" alt="<?php echo $newsTitle;?>" border="0"  >
							<?php   
							//echo stripslashes($newsDetails['News']['news_content']);
							echo stripslashes(str_replace("<h1>","",$newsDetails['News']['news_content']));
							//if(isset($this->request->params['pass'][1]))
							//{
								//echo $this->Form->input('success_id');
							//}
							//echo $this->Form->input('user_id',array('label'=>false,'class'=>'form-control', 'type' => 'hidden', 'div' => false, 'value' => $userid));
							//echo $this->Form->input('content',array('label'=>false,'type'=>'textarea', 'class' => 'form-control ckeditor'));?> 
                            <?php //echo $this->Form->input('submit_from',array('label'=>false, 'div' => false,'type'=>'hidden', 'class' => 'form-control', 'value' => 1));?>
							</div>
						  </div>
                          
						  <div class="form-group">
							<div class="col-lg-12">
							
							  <?php //echo $this->Form->button(SUBMIT,array('type'=>'submit', 'name' => 'success_submit','div'=>false,'class'=>'btn1 savebtn','style'=>'margin-left: 0em;'));?>
							 
							</div>
						  </div>
						  
						  
						  </div>
						<!--</form>-->
							</div>
                    <div class="clear"></div>
			  </div>
				
		</div>
		<div class="clearfix"></div>
    </div>

  </div>
<?php
echo $this->element('footer-home');
?>