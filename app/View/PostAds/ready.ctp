 <!--form 1-->
<?php echo $this->Form->create('PostAd', array('type' => 'file')); 
echo $this->Form->input('adv_id');
echo $this->Form->input('adv_status',array('label' => false, 'div' => false, 'value' => 1, 'type' => 'hidden'));
?>
      <ul class="progressbar">
                <li>
                    <a href="<?php echo $base_url;?>PostAds/add/<?php echo $this->request->data['PostAd']['adv_id'];?>" class="active">
                        <span class="active">1</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo $base_url;?>PostAds/productdescription/<?php echo $this->request->data['PostAd']['adv_id'];?>" class="active">
                        <span class="active">2</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo $base_url;?>PostAds/shipdetail/<?php echo $this->request->data['PostAd']['adv_id'];?>" class="active">
                        <span class="active">3</span>
                    </a>
                </li>
                
                <li>
                    <a href="javascript:void(0)" class="active">
                        <span class="active">4</span>
                    </a>
                </li>
                
                <li>
                    <a href="javascript:void(0)" class="active"></a>
                </li>
            </ul>
      
      <div class="clearfix clear40"></div>
                                
                                
                                <div class="col-lg-12">
                                	<div class="row">
                                        <p class="sif_head">1. Optiuni anunt</p>
                                    	
                                        <div class="si_pub_options col-lg-7">
                                            <div class="spo_top">
                                               
                                                <?php echo READYCONTENT;?>
                                            </div>
                                            <div class="spo_bottom step4_click"> 
                                            	<a href="<?php echo $base_url;?>PostAds/productdescription/<?php echo $this->request->data['PostAd']['adv_id'];?>" class="btn btn-default">&laquo; <?php echo MODIFY;?></a>
                                                <a href="<?php echo $base_url;?>pages/sales-preview/<?php echo $this->request->data['PostAd']['slug'];?>" target="_blank" class="btn btn-success">Previzualizare</a>
                                                <button type="submit" class="btn btn-warning">Activeaza</button>
                                                <a href="<?php echo $base_url;?>PostAds/promotion/<?php echo $this->request->data['PostAd']['adv_id'];?>" class="btn btn-info">Evidentiaza</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
      <div class="clear10"></div>
      
      
  </div>
    </form>
<!--form 1--> 