<?php
echo $this->element('header-home');
?>
 <div class="container warranty">
          <div class="row">
        <div class="innerpanel"> 
              <!-- Left Sidebar Start -->
              <div class="col-md-12 prof">
            <div class="clearfix" style="height:15px;"></div>
            <div id="breadcrumb">
              <ul class="crumbs">
           <li class="first"> <a style="z-index:9;" href="<?php echo $base_url;?>Logins/user_dashboard"><span></span>Dashboard</a> </li>
            <li class="last"><a style="z-index:7;" href="javascript:void(0);">Warranty / Return / Shipping / Payment</a></li>
          </ul>
            </div>
            <div class="clearfix" style="height:10px;"></div>
            <?php echo $this->Session->flash(); ?>
            <div class="clearfix" style="height:10px;"></div>
            <h2 class="detailstitle1" style="color:#DF5E08">
                Warranty / Return / Shipping / Payment
            </h2>
            <div class="clear1"></div>
            <h3>
            	Acum primi un cont gratuit . <br>
               Setările de pe această pagină sunt disponibile numai atunci când aveți un abonament activ Dezmembraripenet.ro <br>
                Vezi abonamente disponibile pentru furnizori <a href="#">aici.</a>
            </h3>
            <p>
            	Setările pe care le completează aici va fi preumplut atunci când adăugați un nou anunț sau un citat .
            </p>
            
            <div class="clearfix" style="height:5px;"></div>
            
            <div class="col-lg-8">
                <div class="row">
                 <div class="clearfix"></div>
                    <div class="listtop34">
                        <?php echo $this->fetch('content');?>
                        
                        <div class="clear40"></div>
                         
                        
                       
                        
                        
                    </div>
                </div>
                    
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