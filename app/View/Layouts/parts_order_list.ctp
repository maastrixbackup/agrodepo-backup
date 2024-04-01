<?php
echo $this->element('header-home');
?>

    <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof tdauto">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span><?php echo DASHBOARD;?></a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);">Piese de schimb Comanda</a></li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	 Piese de schimb Comanda
            <!--<a href="choose_category.html" class="ctgbtn">Add New »</a>-->
        </h2>
        <div class="clearfix" style="height:15px;"></div>
        <div class="col-lg-12">
          
                 <?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content');?>
          </div>
            </div>
        <div class="clear"></div>
      </div>
          
          <div class="clearfix" style="height:1px;"></div>
        </div>
  </div>
<?php
echo $this->element('footer-home');
?>
<script>
function getSubBrand(){
	var brand_id=$("#brand_id").val();
	var url="<?php echo $this->webroot;?>Pages/getSubbrand";
	$("#model_id").load(url,{'brand_id':brand_id});
	//$("#model_id").load(url,{'brand_id':brand_id});	
	searchTxt();
}
function searchTxt(){
	
	var brand_id=$("#brand_id").val();
	var model_id=$("#model_id").val();
	var app_id=$("#app_id").val();
	var county_id=$("#county_id").val(); 
	//alert(brand_id+"---"+model_id+"---"+app_id+"---"+county_id); return;
	var request_part="<?php echo $request_flag; ?>";
	
	if(request_part==1){
		var url="<?php echo $this->webroot.'pages/request-parts-active/'; ?>";
	}else if(request_part==2){
		var url="<?php echo $this->webroot.'pages/request-parts-solved/'; ?>";
	}
	
url+='app_id:'+app_id+'/brand_id:'+brand_id+'/model_id:'+model_id+'/county_id:'+county_id;
	window.location=url;
}
</script>