<?php
echo $this->element('header-home');
if(isset($this->request->params['pass'][0]))
{
	$params=$this->request->params['pass'][0];
}
else
{
	$params='';
}
?>
<script>           
function removeQuestion(id){
	var conf=confirm('Are you sure you want to delete');
	if(conf){
	var url="<?php echo $this->webroot;?>RequestParts/delete_question/id:"+id;
	window.location=url;
	}
}


</script>
    <div class="container">
      <div class="row">
    <div class="innerpanel"> 
          <!-- Left Sidebar Start -->
          <div class="col-md-12 prof tdauto">
        <div class="clearfix" style="height:15px;"></div>
        <div id="breadcrumb">
              <ul class="crumbs">
            <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span><?php echo DASHBOARD;?></a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);">Adresați-vă Vanzator</li>
          </ul>
            </div>
        <div class="clearfix" style="height:10px;"></div>
        <h2 class="detailstitle1" style="color:#DF5E08">
        	Adresați-vă Vanzator
           
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
