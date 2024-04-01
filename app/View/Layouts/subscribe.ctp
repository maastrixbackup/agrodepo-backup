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
					<?php echo $this->element('dashboard-left');
					//echo $this->element('sql_dump');exit;
					//pr($alluser);exit;
					?>
				<!-- Left Sidebar End -->
				
				<!-- Right Sidebar Start -->
				<div class="col-md-9">
					<div class="clearfix" style="height:15px;"></div>
					<div class="col-lg-6 prof bs-example">					
								<h2 class="detailstitle1 blue23">Alertă cerere piese auto</h2>
								<div class="clearfix"></div>
								 <div class="clearfix" style="height:10px;"></div>
									<?php echo $this->Form->create('SubscribeAlert',array('role'=>'form','class'=>'form-horizontal')); ?>
					   <div class="signup_left col-lg-8">

						 <div class="form-group">
							<label class="col-lg-12"><?php echo SELECTBRANDS;?></label>
							<div class="col-lg-12">
							<?php 
							echo $this->Form->input('alert_id');
							echo $this->Form->input('brand_list',array('label'=>false, 'type'=>'select', 'options' => $brandlist, 'multiple' => 'multiple','class'=>'form-control', 'size' => 7));?> 
							</div>
						  </div>
						   <div class="form-group">
							<label class="col-lg-12"><?php echo SELECTCATEGORIES;?></label>
							<div class="col-lg-12">
							<?php 
							echo $this->Form->input('categories',array('label'=>false, 'type'=>'select', 'options' => $categorieslist, 'multiple' => 'multiple','class'=>'form-control', 'size' => 7));?> 
							</div>
						  </div>
                          <div class="form-group">
							<label class="col-lg-12"><?php echo SELECTCOUNTRY;?></label>
							<div class="col-lg-12">
							<?php 
							echo $this->Form->input('couties',array('label'=>false, 'type'=>'select', 'options' => $masterCountryList, 'multiple' => 'multiple','class'=>'form-control', 'size' => 7));?> 
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-lg-12">
							<?php 
							echo $this->Form->input('is_request',array('label'=>'Alert for Request Parts', 'type'=>'checkbox', 'value' => 1));?> 
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-lg-12">
							
							  <?php echo $this->Form->button(SUBMIT,array('type'=>'submit', 'name' => 'alert_subscribe','div'=>false,'class'=>'btn1 savebtn','style'=>'margin-left: 0em;'));?>
							 
							</div>
						  </div>
						  
						  
						  </div>
						</form>
							</div>
                    <div class="col-lg-6 prof bs-example">					
								<h2 class="detailstitle1 blue23">de brand subscris, categorie si judete</h2>
								<div class="clearfix"></div>
								 <div class="clearfix" style="height:10px;"></div>
								 <?php
						            if($this->Session->check('User')){
						                $sesUserDetail=$this->Session->read('User');
						                $sessUserID=$sesUserDetail['user_id'];
						                $alertDetail=$this->Custom->BapCustuniAlertResult($sessUserID);
						                if(!empty($alertDetail)){
						                    $brands=explode(",", $alertDetail['SubscribeAlert']['brand_list']);
						                    $categories=explode(",", $alertDetail['SubscribeAlert']['categories']);
						                    $counties=explode(",", $alertDetail['SubscribeAlert']['couties']);

						                    ?>
						                   <div class="col-lg-12 reficetab">
						            <div class="row">
						                <div class="col-lg-3">
						                    <h1 class="tabtitle1">Marci:</h1>
						                </div>
						                
						                <div class="col-lg-8">
						                    <div class="row">
						                        <?php if(!empty($brands)){
						                            $brandArr=array();
						                            foreach ($brands as $brandID) {
						                               $brandDetail=$this->Custom->getBrandDetail('brand_id', $brandID);
						                               array_push($brandArr, $brandDetail['ManageBrand']['brand_name']);
						                            }
						                            echo implode(", ", $brandArr);
						                        }
						                        ?>
						                    </div>
						                </div>
						            </div>
						        </div>
						        
						        <div class="clear" style="height:15px;"></div>
						         <div class="col-lg-12 reficetab">
						            <div class="row">
						                <div class="col-lg-4">
						                    <h1 class="tabtitle1">categorii:</h1>
						                </div>
						                
						                <div class="col-lg-7">
						                    <div class="row">
						                        <?php if(!empty($categories)){
						                            $categoryArr=array();
						                            foreach ($categories as $categoryID) {
						                               $categoryDetail=$this->Custom->dezSingCat($categoryID);
						                               array_push($categoryArr	, $categoryDetail['SalesCategory']['category_name']);
						                            }
						                            echo implode(", ", $categoryArr	);
						                        }
						                        ?>
						                    </div>
						                </div>
						            </div>
						        </div>
						        
						        <div class="clear" style="height:15px;"></div>
						          <div class="col-lg-12 reficetab">
						            <div class="row">
						                <div class="col-lg-4">
						                    <h1 class="tabtitle1">judete:</h1>
						                </div>
						                
						                <div class="col-lg-7">
						                    <div class="row">
						                        <?php if(!empty($counties)){
						                            $countyArr=array();
						                            foreach ($counties as $countyID) {
						                               $countyName=$this->Custom->region_nm($countyID);
						                               array_push($countyArr, $countyName);
						                            }
						                            echo implode(", ", $countyArr);
						                        }
						                        ?>
						                    </div>
						                </div>
						            </div>
						        </div>
						        
						        <div class="clear" style="height:15px;"></div>
						                    <?php
						                }
						            }
						            ?>	
							</div>
                    <div class="clear"></div>
			  </div>
				
		</div>
		<div class="clearfix"></div>
    </div>

  </div>
  <style>
  .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
    color: #000;
    text-decoration: none;
    background-color: rgba(228, 228, 228, 0.48);
    outline: 0;
}
.multiselect-container>li {
    padding: 0;
    border-bottom: 1px solid #ccc;
}
.dropdown-menu li a:hover {
    background: rgba(119, 121, 117, 0.32)!important;
}
.dropdown-menu {background-color: #ffffff;}
.btn-group-vertical>.btn, .btn-group>.btn {
    position: relative;
    float: left;
    min-width: 200px;
    /* width: 100%; */
    text-align: left;
}
  </style>
<?php
echo $this->element('footer-home');
?>