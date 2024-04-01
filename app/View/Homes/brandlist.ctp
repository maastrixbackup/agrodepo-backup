
<div class="container">
  <div class="row">
    <div class="innerpanel">
      <?php 
                //echo $this->element('sql_dump');
                //pr($active_request);?>
      
      <!-- Right Sidebar Start -->
      <div class="col-md-12">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
          <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $this->webroot;?>pages/request-parts"><span></span><?php echo HOME;?></a> </li>
            <!--<li><a style="z-index:8;" href="#">Engine Parts</a></li>-->
            <li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo FILTER;?> </a></li>
          </ul>
        </div>
        <div class="clear"></div>
        <article class="block">
          <h2>Mărci şi modele auto</h2>
          <div class="main_car_models">
          <?php if(!empty($brandParent)){
            foreach ($brandParent as $brandResult) {
                $brandID=$brandResult['ManageBrand']['brand_id'];
                if(trim($brandResult['ManageBrand']['slug'])!=''){
                        $brandPath=$base_url.'piese-auto/'.$brandResult['ManageBrand']['slug'];
                    }else{
                        $brandPath=$base_url.'piese-auto/'.$brandResult['ManageBrand']['brand_id'];
                    }
                    $brandName=stripslashes($brandResult['ManageBrand']['brand_name']);
                    $modelList=$this->Custom->dezBrand($brandID, 'ordering');
                    ?>
                    <div class="popular_models_item">
              <div class="car_maker_image"> <?php if($brandResult['ManageBrand']['image']!=''){ ?>
            <img src="<?php echo $base_url.'files/brand/100X100_'.$brandResult['ManageBrand']['image']?>" style="width: 60px;"/>
            <?php } ?></div>
              <div class="car_model_content">
                <div class="car_maker_name"> <a href="<?=$brandPath?>" title="<?=$brandName?>"><?=$brandName?></a> </div>
                <div class="clearing"></div>
                <?php if(!empty($modelList)){
                    ?>
                     <ul class="car_models">
                     <?php foreach ($modelList as $modelResult) {
                         if(trim($modelResult['SalesBrand']['slug'])!=''){
                                $modelPath=$base_url.'piese-auto/'.$modelResult['SalesBrand']['slug'];
                            }else{
                                $modelPath=$base_url.'piese-auto/'.$modelResult['SalesBrand']['brand_id'];
                            }
                            $modelName=stripslashes($modelResult['SalesBrand']['brand_name']);
                        ?>
                        <li class="child child_shrinked"> <a href="<?=$modelPath?>" title="<?=$modelName?>"><?=$modelName?></a> </li>
                        <?php
                     }
                     ?>
                  
                 
                </ul>
                    <?php
                }
               ?>
                <div class="clearing"></div>
              </div>
              <div class="clearing"></div>
            </div>
                    <?php
            }
          }
          ?>
            
     
          </div>
          <div class="clearfix"></div>
        </article>
      </div>
      <!-- Right Sidebar end -->
      
      <div class="clearfix" style="height:1px;"></div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
