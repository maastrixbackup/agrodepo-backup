<script type="text/javascript">
function changeCity(countyval)
{
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>RequestParts/citydata',
				data: 'countyid='+countyval,
				success: function(data) {
					//alert(data);
					if(data)
					{
						$("#SalesParkLocationId").html(data);
					}
					
				}
			});
}
function removedata(imgid,img_fold)
{
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>SalesParks/removeimg',
				data: 'imgid='+imgid+'&img_fold='+img_fold,
				success: function(data) {
					//alert(data);
					if(data==1)
					{
						if(img_fold=='temp')
						{
						$("#imgtemp"+imgid).remove();
						}
						else if(img_fold=='original')
						{
						$("#imgoriginal"+imgid).remove();
						}
					}
					
				}
			});
}
</script>
<?php echo $this->Form->create('SalesPark', array('class' => 'form-inline', 'type' => 'file'));
 ?>
<?php echo $this->Form->input('park_id');
	 echo $this->Form->input('add_type', array('label' => false, 'div' => false, 'type' => 'hidden'));
?>               
                    
                    <div class="clear10"></div>
                        <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                               <h5 class="paddingh4 text-upper op7"><?php echo COMPANYDATA;?></h5>
                            </div>
                            <div class="clear5"></div>
                    
                    	<div>
                       <div class="col-lg-4">
                       <?php echo $this->Form->input('park_name', array('label' => COMMERCIALPARK, 'class' => 'form-control', 'div' => 'form-group row', 'placeholder' => ENTERNAMEOFPARK));?>
                        	
                        </div>
                        <div class="col-lg-4">
                        	 
                               <?php echo $this->Form->input('comp_name', array('label' => ENTERNAMEOFCOMPANY, 'class' => 'form-control', 'div' => 'form-group row', 'placeholder' => ENTERNAMEOFCOMPANY));?>
                        </div>
                        
                        	<div class="col-lg-4">
                               <?php echo $this->Form->input('vat', array('label' => CODEFISCALL, 'class' => 'form-control', 'div' => 'form-group row', 'placeholder' => ENTERYOURCODE));?>
                        </div>
                        </div>
                        
                        <div class="clear10"></div><div class="clear10"></div>
                        <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                               <h5 class="paddingh4 text-upper op7"><?php echo LOCATION;?></h5>
                            </div>
                            <div class="clear5"></div>
                        
                        
                        <div class="clearfix" style="height:10px;"></div>
                        <div>
                       <div class="col-lg-4">
                        	 
              <?php echo $this->Form->input('country_id', array('label' => COUNTRY, 'class' => 'form-control', 'div' => 'form-group row', 'placeholder' => 'Enter County', 'options' => $masterCountry, 'onchange' => 'return changeCity(this.value);'));?>
                        </div>
                        <div class="col-lg-4">
                        	 <?php if(isset($this->request->data['SalesPark']['country_id'])){
                             $locationList=$this->Custom->BapCustUniLocationList($this->request->data['SalesPark']['country_id']);
                              }
							  else
							  {
								  $locationList=array('' => CHOOSECITY);
							  }?>
                                 <?php echo $this->Form->input('location_id', array('label' => LOCALITY, 'class' => 'form-control', 'options' =>$locationList, 'div' => 'form-group row', 'selected' => @$this->request->data['SalesPark']['location_id']));?>
                        </div>
                        
                        	<div class="col-lg-4">
                        <?php echo $this->Form->input('postal_code', array('label' => POSTALCODE, 'class' => 'form-control', 'placeholder' => ENTERPOSTALCODE, 'div' => 'form-group row'));?>
                        </div>
                        </div>
                        
                        
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        <div>
                        	<div class="col-lg-4">
                               
                                  <?php echo $this->Form->input('street', array('label' => STREET, 'class' => 'form-control', 'placeholder' => ENTERSTREETNAME, 'div' => 'form-group row'));?>
                            </div>
                        
                        	<div class="col-lg-4">
                                  <?php echo $this->Form->input('nr', array('label' => NO, 'class' => 'form-control', 'placeholder' => ENTERNO, 'div' => 'form-group row'));?>
                            </div>
                            
                            <div class="col-lg-4">
                                   <?php echo $this->Form->input('other_add', array('label' => OTHERDETAILADDRESS, 'class' => 'form-control', 'placeholder' => ENTEROTHERDETAILS, 'div' => 'form-group row' , 'cols' => false, 'rows' => false));?>
                            </div>
                            
                            
                        </div>
                        
                        
                        <div class="clear10"></div><div class="clear10"></div>
                        <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                               <h5 class="paddingh4 text-upper op7"><?php echo CONTACT;?></h5>
                            </div>
                            <div class="clear5"></div>
                        
                        
                       
                        <div>
                       <div class="col-lg-4">
                        	 
                               <?php echo $this->Form->input('phone', array('label' => PHONE, 'class' => 'form-control', 'placeholder' => ENTERPHONE, 'div' => 'form-group row'));?>
                        </div>
                        
                        <div class="col-lg-4">
                              <?php echo $this->Form->input('fax', array('label' => FAX, 'class' => 'form-control', 'placeholder' => ENTERYOURFAX, 'div' => 'form-group row'));?>
                        </div>
                        
                        <div class="col-lg-4">
                              <?php echo $this->Form->input('email', array('label' => EMAILADDRESS, 'class' => 'form-control', 'placeholder' => ENTEREMAIL, 'div' => 'form-group row'));?>
                        </div>
                        
                        	
                        </div>
                        
                       
                       
                       
                       <div class="clear10"></div><div class="clear10"></div>
                        <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                               <h5 class="paddingh4 text-upper op7">Description and logo</h5>
                            </div>
                            <div class="clear5"></div>
                       
                       
                       
                       
                        <div>
                       <div class="col-lg-4">
                        	 
                              <?php echo $this->Form->input('description', array('label' => DESCRIPTION, 'cols' => false, 'rows' => false, 'type' => 'textarea', 'class' => 'form-control', 'placeholder' => ENTERDESCRIPTION, 'div' => 'form-group row'));?>
                             
                             
                        </div>
                        <div class="col-lg-4">
                        	 
                               <?php echo $this->Form->input('logo', array('label' => LOGO.'/'.COMPANYBANNER, 'type' => 'file', 'class' => 'form-control',  'div' => 'form-group row', 'required' => false));?>
                        </div>
                       <div class="clear10"></div>
                        <div class="col-lg-6">
                       <label><?php echo UPLOADIMAGE;?></label>
                        	 <iframe src="<?php echo $base_url;?>SalesParks/fileupload/" style="width: 100%; height:22px; border: none; overflow: hidden;"></iframe>
                       <div id="loading" style="display:none;"></div>
                                     <div id="picGallery" style="display:none;"></div>
                        </div>
                        </div>
                        
                        
                          <div class="clear10"></div><div class="clear10"></div>
                        <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                               <h5 class="paddingh4 text-upper op7"><?php echo WARRANTYTDR;?></h5>
                            </div>
                            <div class="clear5"></div>
                       
                        
                        <div class="col-lg-12">
                        	  
                               <?php echo $this->Form->input('warranty_detail', array('label' => TEXTDOC, 'type' => 'textarea', 'cols' => false, 'rows' => false, 'class' => 'form-control',  'div' => 'form-group row'));?>
                        </div>
                        
                        
                      
                      <div class="clear10"></div><div class="clear10"></div>
                        <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                               <h5 class="paddingh4 text-upper op7"><?php echo SELECTBRANDS;?></h5>
                            </div>
                            <div class="clear5"></div>
                       
                        
                       <div class="col-lg-12">
                        	 
                              <?php //echo $this->Form->input('brand_id', array('label' => SELECTYOURBRANDS, 'class' => 'form-control',  'div' => 'form-group row', 'options' => $brandList, 'multiple' => 'multiple'));?>
							<div class="row brand_checklist">  
                            <?php 
							$dbBrandid=$this->request->data['SalesPark']['brand_id'];
							if(!empty($dbBrandid))
							{
								$dbBrandarr=explode(",", $dbBrandid);
							}
							if(!empty($brandList)){
								foreach($brandList as $brandid => $brandname)
								{
								?>                            
                                  <div class="col-lg-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="data[SalesPark][brand_id][]"<?php if(!empty($dbBrandarr) && in_array($brandid, $dbBrandarr)){?> checked="checked"<?php }?> value="<?php echo $brandid;?>"><?php echo $brandname;?>
                                        </label>
                                    </div>
                                  </div>
                                  <?php 
									}
								  }?>
                            </div>
                        </div>
                        
                        
                        <div class="clear10"></div><div class="clear10"></div>
                        <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                               <h5 class="paddingh4 text-upper op7"><?php echo CONTACTPERSON;?></h5>
                            </div>
                            <div class="clear5"></div>
                       
                        
                        <div class="col-lg-12">
                        	  <div class="form-group row">
                                <label><?php echo REPESENTIVEDEZMEM;?></label>
                                <input type="radio" name="data[SalesPark][contact_person]"<?php if($this->request->data['SalesPark']['contact_person']==1){?> checked="checked"<?php }?> value="1"> <span class="pull-left"><?php echo YES;?> &nbsp; &nbsp; &nbsp;</span>  <input type="radio"  name="data[SalesPark][contact_person]"<?php if($this->request->data['SalesPark']['contact_person']==0){?> checked="checked"<?php }?> value="0"> <span class="pull-left"> <?php echo NO;?></span>
                              </div>
                        </div>
                        
                        <div class="col-lg-12">
                          <div class="row">
                          <div class="clear15"></div>
                          <button class="org_btn btn radius-zero" type="submit"><?php echo SUBMIT;?></button>
                          </div>
                        
                        </div>
                      
                        <div class="clear15"></div>
                      
                    </form>