 <!--form 1-->
<?php //echo $this->Form->create('PostAd', array('type' => 'file')); 
//echo $this->Form->input('adv_id');
//echo $this->Form->input('adv_status',array('label' => false, 'div' => false, 'value' => 1, 'type' => 'hidden'));
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
                                    	<a href="javascript:void(0)" class="active">
                                    		<span class="active">3</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                    	<a href="javascript:void(0)">
                                    		<span>4</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                    	<a href="javascript:void(0)"></a>
                                    </li>
                                </ul>
      
      						<div class="clear40"></div>
   							<!--<form class="form-inline step3_format large_tdspace">-->
                            <?php echo $this->Form->create('PostAd', array('type' => 'file', 'class' => 'form-inline step3_format large_tdspace'));
							echo $this->Form->input('adv_id');
							?>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><label>Garantie: </label></th>
                                                <td>
                                                	
                                                    <?php echo $this->Form->input('warranty', array('label'=>false,'class' => 'form-control step3_droplis1','type' => 'select','options' => array('' => SELECT, 'Ofer warranty' => 'Ofer garanţie','We do not offer warranty'=>'Nu ofer garanţie')));?>
                                                </td>
                                                <td><label>Valabilitate: </label></td>
                                                <td>
                                                	<?php echo $this->Form->input('availability',array('label' => false,'div' => false,'type' =>'text', 'class' => 'form-control'));?>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td><label>&nbsp;</label></td>
                                                <td><label>Curier: </label><?php echo $this->Form->input('courier',array('label' => false, 'class' => 'checkbox','div' => false,'type' =>'checkbox', 'value'=> 1));?></td>
                                                <td>
                                                	<table>
                                                    	<tr>
                                                            <td>
                                                            	<label>Cost livrate: </label>
                                                                <?php echo $this->Form->input('courier_cost',array('label' => false,'div' => false,'type' =>'text', 'class' => 'form-control'));?>
															</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                        	<?php echo $this->Form->input('free_courier',array('label' => false,'div' => false,'type' =>'checkbox', 'value'=> 1))?> Livrte Gratuita
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td><label>Livrare: </label></td>
                                                <td>
                                                	<div class="checkbox">
                                                        <label>
                                                        	<?php echo $this->Form->input('personal_teaching',array('label' => false,'div' => false,'type' =>'checkbox', 'value'=> 1));?> Predare personala
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><label>&nbsp; </label></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            
                                            <tr>
                                                <td><label>&nbsp;</label></td>
                                                <td><label>Posta Romana: </label><?php echo $this->Form->input('romanian_mail',array('label' => false,'div' => false,'type' =>'checkbox', 'value'=> 1));?></td>
                                                <td>
                                                	<table>
                                                    	<tr>
                                                            <td>
                                                            	<label>Cost livrate: </label>
                                                            	<?php echo $this->Form->input('romanian_mail_cost',array('label' => false,'div' => false, 'class' => 'form-control','type' =>'text'));?>
															</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                        	<?php echo $this->Form->input('free_romanian_mail',array('label' => false,'div' => false,'type' =>'checkbox', 'value'=> 1));?> Livrte Gratuita
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td><label>Plata</label></td>
                                                <td>
                                                	<table class="payment_click3">
                                                    <?php
													if(isset($this->request->data['PostAd']['payment_mode']) && $this->request->data['PostAd']['payment_mode']!='')
													{
														if(is_array($this->request->data['PostAd']['payment_mode']))
														{
															$paymentarr=$this->request->data['PostAd']['payment_mode'];
														}
														else
														{
															$paymentarr=explode(",",$this->request->data['PostAd']['payment_mode']);
														}
														
													}
													else
													{
														
														$paymentarr=array();
													}
													if(in_array('Cash on delivery',$paymentarr))
													{
													echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Cash on delivery','name' => 'data[PostAd][payment_mode][]','checked' => 'checked')).CASHONDELICERY.'</label></div></td> </tr>';
											
													}
													else
													{
														echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Cash on delivery','name' => 'data[PostAd][payment_mode][]')).CASHONDELICERY.'</label></div></td> </tr>';
													}
													if(in_array('Upon delivery',$paymentarr))
													{
													echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Upon delivery','name' => 'data[PostAd][payment_mode][]','checked' => 'checked')).UPONDELIVERY.'</label></div></td> </tr>';
													}
													else
													{
														echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Upon delivery','name' => 'data[PostAd][payment_mode][]')).UPONDELIVERY.'</label></div></td> </tr>';
													}
													if(in_array('Wire Transfer',$paymentarr))
													{
													echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Wire Transfer','name' => 'data[PostAd][payment_mode][]','checked' => 'checked')).WIRETRANSFER.'</label></div></td> </tr>';
													}
													else
													{
														echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Wire Transfer','name' => 'data[PostAd][payment_mode][]')).WIRETRANSFER.'</label></div></td> </tr>';
													}
													if(in_array('Banking Card',$paymentarr))
													{
												echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Banking Card','name' => 'data[PostAd][payment_mode][]','checked' => 'checked')).BANKCARD.'</label></div></td> </tr>';
													}
													else
													{
														echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' =>  false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Banking Card','name' => 'data[PostAd][payment_mode][]')).BANKCARD.'</label></div></td> </tr>';
													}
													if(in_array('Others',$paymentarr))
													{
												echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Others','name' => 'data[PostAd][payment_mode][]','checked' => 'checked')).OTHER.'</label></div></td> </tr>';
													}
													else
													{
														echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Others','name' => 'data[PostAd][payment_mode][]')).OTHER.'</label></div></td> </tr>';
													}
												?>
                                                    	
                                                    </table>
                                                </td>
                                                <td><label>&nbsp; </label></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            
                                            <tr>
                                                <td><label>Durata Livrate: </label></td>
                                                <td>
                                                	
                                                    <?php echo $this->Form->input('time_required', array('label'=>false,'class' => 'form-control','type' => 'select','options' => array('' => SELECT, '1' => '1 '.DAYA,'2'=>'2 '.DAYS,'3'=>'3 '.DAYS, '4' => '4 '.DAYS, '5' => '5 '.DAYS, '10' => '10 '.DAYS, '15' => '15 '.DAYS, '30' => '30 '.DAYS)));?>
                                                </td>
                                                <td><label>&nbsp; </label></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            
                                            <tr>
                                                <td><label>Factura: </label></td>
                                                <td>
                                                	
                                                    <?php echo $this->Form->input('invoice', array('label'=>false,'class' => 'form-control step3_droplis1','type' => 'select','options' => array('' => SELECT, 'invoiced' => 'Emite factura','without invoice'=>'Fara factura','old bill'=>'Factura veche')));?>
                                                </td>
                                                <td><label>&nbsp; </label></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <table style="width:100%">
                                    	<tr>
                                        	<td colspan="4" style="border:none;">
                                            	<input type="submit" name="Submit2" value="Continua cu Descrierea Optimen &raquo;" class="blue_btn" style="float:right;">
                                        	</td>
                                        </tr>
                                    </table>
                                </form>
<!--form 1--> 