 <!--form 1-->
<?php echo $this->Form->create('PostAd', array('type' => 'file')); 
echo $this->Form->input('adv_id');
echo $this->Form->input('adv_status',array('label' => false, 'div' => false, 'value' => 1, 'type' => 'hidden'));
?>
      <ul class="sellitem_progress">
        <li>
            <a href="<?php echo $base_url;?>PostAds/productdescription/<?php echo $this->request->data['PostAd']['adv_id'];?>"><?php echo CHOOSECATEGORY;?></a>
            <div class="arrw_btm"></div>
            <div class="success_tick"></div>
        </li>
        <li>
            <a href="<?php echo $base_url;?>PostAds/productdescription/<?php echo $this->request->data['PostAd']['adv_id'];?>"><?php echo DESCRIPTION;?></a>
            <div class="arrw_btm"></div>
            <div class="success_tick"></div>
        </li>
        <li>
            <a href="<?php echo $base_url;?>PostAds/preview/<?php echo $this->request->data['PostAd']['adv_id'];?>"><?php echo PREVIEWADS;?></a>
            <div class="arrw_btm"></div>
            <div class="success_tick"></div>
        </li>
        <li class="active">
            <a href='javascript:void(0)'><?php echo READYS;?></a>
            <div class="arrw_btm"></div>
        </li>
      </ul>
      
      <div class="clearfix" style="height:20px;"></div>
      
      <div class="spg_success"><font><?php echo CANGRATULATIONS;?></font></div>
      
      <div class="successtag"><?php echo YOURADSUCESSFUL;?></div>
      <p><?php echo YOUCANCHANGEANYTIME;?></p>
      
      <div class="clearfix"></div>
      
      <div class="si_pub_options">
        <div class="spo_top">
            <?php echo WERECOMENDUSE;?> <strong><?php echo SELLFASTER;?></strong> <?php echo YOURPRODUCTANNOUNCEMENT;?>
            <br>
            <font><font><?php echo IFPREVIEWOKCLICK;?> </font></font>
            <strong><font><font><?php echo ADVERTISER;?></font></font></strong><font><font> <?php echo TOBEPUBLISH;?></font></font>
        </div>
        <div class="spo_bottom"> 
            <a class="gbutton9" rel="nofollow" target="_blank" href="<?php echo $base_url;?>pages/sales-details/<?php echo $this->request->data['PostAd']['slug'];?>" title="AD">
            <font><font> <?php echo ANNOUNCEMENT;?></font></font>
            </a>
            <a class="gbutton6" href="javascript:void(0)"><font><font><?php echo PROMOTE;?> »</font></font></a>
        </div>
    </div>
      
      <div class="clear10"></div>
      
      
  </div>
    </form>
<!--form 1--> 