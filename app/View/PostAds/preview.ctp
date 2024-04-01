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
        <li class="active">
            <a href='javascript:void(0)'><?php echo PREVIEWADS;?></a>
            <div class="arrw_btm"></div>
        </li>
        <li>
            <a href='javascript:void(0)'><?php echo READYS;?></a>
            <div class="arrw_btm"></div>
        </li>
      </ul>
      
      <div class="clear40"></div>
      <p class="sip_head">1. <?php echo PREVIEWADS;?></p>
      <p>
        <strong>
       <font><a href="<?php echo $base_url;?>pages/sales-preview/<?php echo $this->request->data['PostAd']['slug'];?>" target="_blank"><?php echo CLICKHERE;?></a> <?php echo PRIVIEWADPUBLIC;?></font>
        </strong> 
        </p>

      <div class="clearfix" style="height:20px;"></div>
      <p class="sip_head">2. <?php echo PUBLICNOTICE;?></p>
      
      <div class="si_pub_options">
        <div class="spo_top"><font><font><?php echo IFMAKEADITIONALCHARGE;?> </font></font>
            <strong><font><font><?php echo MODIFY;?></font></font></strong><font><font> . </font></font>
            <br>
            <font><font><?php echo IFPREVIEWOKCLICK;?> </font></font>
            <strong><font><font><?php echo ADVERTISER;?></font></font></strong><font><font> <?php echo TOBEPUBLISH;?></font></font>
        </div>
        <div class="spo_bottom"> 
            <a class="gbutton7" rel="nofollow" href="<?php echo $base_url;?>PostAds/productdescription/<?php echo $this->request->data['PostAd']['adv_id'];?>" title="Modify">
            <font><font>«<?php echo MODIFY;?> </font></font>
            </a>
            <input class="gbutton6" type="submit" value="<?php echo ADVERTISER;?>">
            <!--<a class="gbutton6" href="choose_category_4.html"><font><font>advertiser »</font></font></a>-->
        </div>
    </div>
      
      <div class="clear10"></div>
      
      
  </div>
    </form>
<!--form 1--> 