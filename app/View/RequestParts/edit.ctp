<script type="text/javascript">

function changeModel(brandval)
{
	$.ajax(
				{
					type: 'POST',
					url: '<?php echo $base_url; ?>RequestParts/modeldata',
					data: 'brandid='+brandval,
					success: function(data) {
						//alert(data);
						if(data)
						{
							$("#RequestPartModelId").html(data);
						}
						
					}
				});
}
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
						$("#RequestPartCity").html(data);
					}
					
				}
			});
}
function appenPart()
{
	var totpart=$("#cout_part").val();
	var increasecount=parseInt(totpart)+1;
	//alert(increasecount);
	$("#accessories").append('<div class="col-lg-6 form_rpt" id="section'+increasecount+'" ><div class="row"><div class="clear10"></div><div class="form-group"><label class="col-lg-5 control-label"><?php echo NAMEPIECE;?> </label><div class="col-lg-7"><input name="data[RequestAccessory][name_piece][]" class="form-control name_piece" type="text" id="RequestPartNamePiece'+increasecount+'"></div></div><div class="form-group"><label class="col-lg-5 control-label"><?php echo DESCRIPTION;?></label><div class="col-lg-7"><textarea name="data[RequestAccessory][description][]" class="form-control description" id="RequestPartDescription'+increasecount+'"></textarea></div></div><div class="form-group"><label class="col-lg-5 control-label"><?php echo PARTNO;?> </label><div class="col-lg-7"><input name="data[RequestAccessory][part_no][]" class="form-control part_no" type="text" id="RequestPartPartNo"></div></div><div class="form-group"><label class="col-lg-5 control-label"><?php echo MAXPRICE;?></label><div class="col-lg-7"><input name="data[RequestAccessory][max_price][]" class="form-control" style="width:35%;float:left;margin-right:5px;" type="text" id="RequestPartMaxPrice" onkeypress="chkNumber(event)">&nbsp;<select name="data[RequestAccessory][currency][]" class="form-control" style="width:35%;float:left;" id="RequestPartCurrency"><option value="RON">RON</option><option value="EUR">EUR</option><option value="USD">USD</option></select>&nbsp;(<?php echo OPTIONAL;?>)</div></div><div class="form-group"><label class="col-lg-5 control-label"><?php echo PICTURES;?></label><div class="col-lg-7"><iframe src="<?php echo $base_url;?>RequestParts/fileupload/seqno:'+increasecount+'" style="width: 100%; height:22px; border: none; overflow: hidden;"></iframe></div><input type="hidden" name="data[RequestAccessory][part_img][]" value="'+increasecount+'" /><div id="loading'+increasecount+'" style="display:none;"></div><div id="picGallery'+increasecount+'" style="display:none;"></div></div></div><div class="clear15"></div><a href="javascript:void(0);" onclick="removePart('+increasecount+')" class="pull-right" style="margin-right:10px;"> <?php echo REMOVE;?><img src="<?php echo $base_url;?>images/delete_icon.png" /></a><div class="clear5"></div></div><div class="clear10"></div></div>');
	$("#cout_part").val(increasecount);
}
function removePart(removeid)
{
	$("#section"+removeid).remove();
}
function chkNumber(e){
	//alert(e.which);
	var kc=(e.which) ? e.which : e.keyCode; 
	if(!(( kc>= 48 && kc <= 57) || kc==46 || kc==8)){
	e.preventDefault();
	}
}

</script>
<?php
if(isset($this->request->data['RequestAccessory']))
{
	$requestdetail=$this->request->data['RequestAccessory'];
	$piesename=$requestdetail['name_piece'];
	$description=$requestdetail['description'];
	$partsid=$requestdetail['part_id'];
}
else
{
	$piesename='';
	$description='';
	$partsid='';
}
?>
 <div class="cere_title">1. Date despre manisha cauliter piesa</div>
<?php echo $this->Form->create('RequestPart', array('type' =>'file', 'class' => 'myform form-inline cere_Data'));
echo $this->Form->input('request_id');
echo $this->Form->input('part_id', array('type' => 'hidden', 'name' => 'data[RequestAccessory][part_id]', 'div' => false, 'value' =>$partsid));
 ?>
	<table class="table table-bordered no-border" style="width:100%;">
		<tbody>
			<tr>
				<td colspan="4">
					<table style="width:100%;">
						<td style="width:12%;"><label>Marca auto: </label></td>
						<td style="width:60%;">
							<?php
echo $this->Form->input('brand_id', array('label' => false, 'type' => 'select','options' => $brandlist, 'div' => false, 'class' => 'form-control step3_droplis1','onChange'=>'changeModel(this.value)', 'style' => 'width:46%!important; float:left;'));
?>
							

							
							 <?php
							if(isset($this->request->data['RequestPart']['brand_id']) && $this->request->data['RequestPart']['brand_id']!='')
							{
								$modellist=$this->requestAction('/RequestParts/modelget/'.$this->request->data['RequestPart']['brand_id']);
								echo $this->Form->input('model_id', array('label' => false, 'type' => 'select','options' => $modellist, 'div' => false, 'class' => 'form-control step3_droplis1', 'style' => 'width:48%!important; float:left; margin-left:1em;'));
							}
							else
							{
								echo $this->Form->input('model_id', array('label' => false, 'type' => 'select','options' => array('' => '-Choose the model-'), 'div' => false, 'class' => 'form-control step3_droplis1', 'style' => 'width:48%!important; float:left; margin-left:1em;'));
							}
							?>
						</td>
						<td>
							<label>Motorizare: </label>
						   
							<?php echo $this->Form->input('engines', array('label' => false, 'div' => false, 'class' => 'form-control', 'style' => 'width:73%;'));?>
						</td>
					</table>
				</td>
			</tr>
			
			<tr>
				<td colspan="4" style="width:100%">
					<table style="width:100%;">
						<tr>
							<td><label>Anul: </label></td>
							<td style="width:30%;">
								
								<?php echo $this->Form->input('yr_of_manufacture', array('label' => false, 'div' => false, 'class' => 'form-control', 'style' => ' width:100%!important; float:left;'));?>
							</td>
							<td><label>Versiune: </label></td>
							<td style="width:30%;">
								
								 <?php echo $this->Form->input('version', array('label' => false, 'div' => false, 'class' => 'form-control', 'style' => ' width:96%!important; float:left;'));?>
							</td>
							<td><label>Serie Sasiu: </label></td>
							<td>
								<?php echo $this->Form->input('vehicle_identy_no', array('label' => false, 'div' => false, 'class' => 'form-control', 'style' => 'width: 100%;'));?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</tbody>
		
	</table>
	<table class="table table-bordered no-border rqst_parts">
		<tbody>
			<tr>
				<td colspan="4">
					<div style="width:100%;">
						<table cellpadding="0" cellspacing="0" style="width:100%;">
							<tr>
								<td><label>Denumire piesa: </label></th>
								<td style="width: 56%;text-align: right;">
									<?php echo $this->Form->input('name_piece', array('label' => false ,'name' => 'data[RequestAccessory][name_piece]', 'div' => false, 'class' => 'form-control', 'style' => 'width:583px;float: left;', 'value' => $piesename));?>
								</td>
								<td style="text-align: right;">
									<label>&nbsp;&nbsp; Doriti Piesa: </label>
									
                                    <?php
									echo $this->Form->input('want_song', array('label' => false, 'type' => 'select','options' => array('new' => 'Noua', 'used' => 'din dezmembrari', 'both' => 'Noua sau din dezmembrari'), 'div' => false, 'class' => 'form-control step3_droplis1', 'style' => 'width:65%!important;'));?>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			
			<tr>
				<td><label>Descriere piesa: </label></td>
				<td style="width:52%; text-align:left;">
				   
					<?php echo $this->Form->input('description', array('label' => false,'name' => 'data[RequestAccessory][description]','type' => 'textarea', 'cols' => false, 'rows' => false, 'div' => false, 'class' => 'form-control', 'style' => 'height:120px; background:none; width:100%; width:111%!important;', 'value' => $description));?>
				</td>
				<td colspan="2">
					<label style="padding-left: 105px;">judetul: </label>
					
					<?php
				echo $this->Form->input('county', array('label' => false, 'type' => 'select','options' => $countylist, 'div' => false, 'class' => 'form-control step3_droplis1','onChange'=>'changeCity(this.value)', 'style' => 'width:57%!important; float:right; margin-bottom:15px;'));
			?>
					<label style="position:relative; top:30px;padding-left: 82px;">Localitatea: </label>
					
					<?php
					if(isset($this->request->data['RequestPart']['county']) && $this->request->data['RequestPart']['county']!='')
					{
						$citylist=$this->requestAction('/RequestParts/cityget/'.$this->request->data['RequestPart']['county']);
						echo $this->Form->input('city', array('label' => false, 'type' => 'select','options' => $citylist, 'div' => false, 'class' => 'form-control step3_droplis1', 'style' => 'width:57%!important; float:right;'));
					}
					else
					{
						echo $this->Form->input('city', array('label' => false, 'type' => 'select','options' => array('' => '-'.CHOOSECITY.'-'), 'div' => 'false', 'class' => 'form-control step3_droplis1', 'style' => 'width:57%!important; float:right;'));
					}
				?>
				</td>
				
				
			</tr>
			
			<?php /*?><tr>
				<td width="13%"><label>Pret: </label></td>
		  <td width="31%">
  <table>
						<tr>
							<td>
							   
								<?php echo $this->Form->input('max_price', array('label' => false,'name' => 'data[RequestAccessory][max_price]', 'div' => false, 'class' => 'form-control', 'style' => 'width:45%; float:left;', 'value' => $max_price));?>
								<?php echo $this->Form->input('currency', array('label' => false,'name' => 'data[RequestAccessory][currency]', 'type' => 'select','options' => array('RON' => 'RON','EUR' => 'EUR','USD' => 'USD'), 'div' => false, 'class' => 'step3_droplis1 form-control', 'style' => 'width:45%!important; float:right;', 'selected' => $currency));?>
							</td>
						</tr>
					</table>
				</td>
			  <td width="48%"><label>&nbsp; </label></td>
			  <td width="8%">&nbsp;</td>
		  </tr><?php */?>
			
			<tr>
				<td><label class="size_14"><i>Adauga Fotogrifi</i></label></td>
				<td style="  width: 500px;  display: inline-block;">
					<table>
						<tr>
							<td style="width:100%!important">
								<div class="listphoto">
									<ul>
                                    <li>
										<iframe src="<?php echo $base_url;?>RequestParts/fileupload/seqno:1/partsid:<?php echo $this->request->data['RequestAccessory']['part_id'];?>" style="border: none; overflow: hidden;"></iframe>
                                        </li>
										<li>
											<iframe src="<?php echo $base_url;?>RequestParts/fileupload/seqno:2/partsid:<?php echo $this->request->data['RequestAccessory']['part_id'];?>" style="border: none; overflow: hidden;"></iframe>
										</li>
										<li>
											<iframe src="<?php echo $base_url;?>RequestParts/fileupload/seqno:3/partsid:<?php echo $this->request->data['RequestAccessory']['part_id'];?>" style="border: none; overflow: hidden;"></iframe>
										</li>
										<li>
											<iframe src="<?php echo $base_url;?>RequestParts/fileupload/seqno:4/partsid:<?php echo $this->request->data['RequestAccessory']['part_id'];?>" style="border: none; overflow: hidden;"></iframe>
										</li>
										<li>
											<iframe src="<?php echo $base_url;?>RequestParts/fileupload/seqno:5/partsid:<?php echo $this->request->data['RequestAccessory']['part_id'];?>" style="border: none; overflow: hidden;"></iframe>
										</li>
									</ul>
                                     
								</div>
                                <div id="loading" style="display:none;"></div>
							</td>
						</tr>
					</table>
				</td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<td>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			
			
			
			<tr>
				<?php /*?><td colspan="4">
					<div class="col-lg-8">
						<div class="row">
							<table>
								<tr>
									<td style="min-width:138px;">&nbsp;&nbsp;</td>
									<td style="width: 75px;"><label>Curier &nbsp;<?php echo $this->Form->input('courier',array('label' => false, 'class' => 'checkbox','div' => false,'type' =>'checkbox', 'value'=> 1));?> </label></td>
									<td><label style="width:120px">Cost livrare: </label>
									</td><td colspan="4">
										
                                        <?php echo $this->Form->input('courier_cost',array('label' => false,'div' => false,'type' =>'text', 'class' => 'form-control', 'style' => 'width:200px'));?>
									</td>
									<td style="padding-left:2em; padding-top:6px;">
										<div class="checkbox">
											<label>
												<?php echo $this->Form->input('free_courier',array('label' => false,'div' => false,'type' =>'checkbox', 'value'=> 1))?> Livrare Gratuita
											</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						
						<br>
						
						<div class="row">
							<table>
								<tr>
									<td style="min-width:138px;"><label style="font-size:23px!important;">Livrare</label></td>
									<td style="padding-right:35px;">
										<div class="checkbox">
											<label>
												<?php echo $this->Form->input('personal_teaching',array('label' => false,'div' => false,'type' =>'checkbox', 'value'=> 1));?>Predare personala
											</label>
										</div>
									</td>
									<td><label>&nbsp;</label></td>
									<td colspan="4">
										<label>&nbsp;</label>
									</td>
									<td style="padding-left:2em; padding-top:6px;"><label>&nbsp;</label></td>
								</tr>
							</table>
						</div>
						
						<br>
						
						<div class="row">
							<table>
								<tr>
									<td style="min-width:138px;">&nbsp;&nbsp;</td>
									<td><label style="width: 131px;font-size: 14px!important;">Posta Romana &nbsp;<?php echo $this->Form->input('romanian_mail',array('label' => false,'div' => false,'type' =>'checkbox', 'value'=> 1));?></label></td>
									<td><label style="width:80px">Cost livrare: </label>
									</td><td colspan="4">
									
                                        <?php echo $this->Form->input('romanian_mail_cost',array('label' => false,'div' => false, 'class' => 'form-control','type' =>'text', 'style' => 'width:200px;'));?>
									</td>
									<td style="padding-left:2em; padding-top:6px;">
										<div class="checkbox">
											<label>
												<?php echo $this->Form->input('free_romanian_mail',array('label' => false,'div' => false,'type' =>'checkbox', 'value'=> 1));?> livrare Gratuita
											</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="row">
							<div class="rightofr_list">
								<table>
									<tr>
										<td><label style="font-size:23px!important; padding-top:60px;">Plata</label></td>
										<td>
											<table class="payment_click3">
												<tbody>
                                                 <?php
													if(isset($this->request->data['RequestPart']['payment_mode']) && $this->request->data['RequestPart']['payment_mode']!='')
													{
														if(is_array($this->request->data['RequestPart']['payment_mode']))
														{
															$paymentarr=$this->request->data['RequestPart']['payment_mode'];
														}
														else
														{
															$paymentarr=explode(",",$this->request->data['RequestPart']['payment_mode']);
														}
														
													}
													else
													{
														
														$paymentarr=array();
													}
													if(in_array('Cash on delivery',$paymentarr))
													{
													echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Cash on delivery','name' => 'data[RequestPart][payment_mode][]','checked' => 'checked')).CASHONDELICERY.'</label></div></td> </tr>';
											
													}
													else
													{
														echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Cash on delivery','name' => 'data[RequestPart][payment_mode][]')).CASHONDELICERY.'</label></div></td> </tr>';
													}
													if(in_array('Upon delivery',$paymentarr))
													{
													echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Upon delivery','name' => 'data[RequestPart][payment_mode][]','checked' => 'checked')).UPONDELIVERY.'</label></div></td> </tr>';
													}
													else
													{
														echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Upon delivery','name' => 'data[RequestPart][payment_mode][]')).UPONDELIVERY.'</label></div></td> </tr>';
													}
													if(in_array('Wire Transfer',$paymentarr))
													{
													echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Wire Transfer','name' => 'data[RequestPart][payment_mode][]','checked' => 'checked')).WIRETRANSFER.'</label></div></td> </tr>';
													}
													else
													{
														echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Wire Transfer','name' => 'data[RequestPart][payment_mode][]')).WIRETRANSFER.'</label></div></td> </tr>';
													}
													if(in_array('Banking Card',$paymentarr))
													{
												echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Banking Card','name' => 'data[RequestPart][payment_mode][]','checked' => 'checked')).BANKCARD.'</label></div></td> </tr>';
													}
													else
													{
														echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' =>  false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Banking Card','name' => 'data[RequestPart][payment_mode][]')).BANKCARD.'</label></div></td> </tr>';
													}
													if(in_array('Others',$paymentarr))
													{
												echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Others','name' => 'data[RequestPart][payment_mode][]','checked' => 'checked')).OTHER.'</label></div></td> </tr>';
													}
													else
													{
														echo '<tr><td><div class="checkbox"><label>'.$this->Form->input('payment_mode',array('label' => false,'div' => false, 'class' => 'payment_mode','type' =>'checkbox', 'value'=> 'Others','name' => 'data[RequestPart][payment_mode][]')).OTHER.'</label></div></td> </tr>';
													}
												?>
                                               
											</tbody></table>
										</td>
										
										
									</tr>
								</table>
							</div>
						</div>
					</div>
				</td><?php */?>
			</tr>
			
			
		</tbody>
	</table>
	
	<table style="width:100%">
		<tr>
			<td colspan="4" style="border:none;">
				<input type="submit" name="Submit2" value="Adauga Cerere" class="blue_btn cerebtn" style="float:right;">
				<div class="rqst_login">
<div class="clear10"></div>
<?php
if(isset($openlogin) && $openlogin='yes')
{
?>
<div id="openlogin form-inline">

			  <div class="form-group">
				<label for="exampleInputName2"><?php echo USERID;?></label>
				&nbsp;&nbsp;
				 <input type="text" name="data[MasterUser][user_login_id]" class="form-control" id="MasterUserUserLoginId" />
			  </div>
			  <div class="form-group">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="exampleInputEmail2"><?php echo PASSWORD;?></label>
				&nbsp;&nbsp;
				<input type="password" name="data[MasterUser][user_pass]"  id="MasterUserUserPass" class="form-control" />
			  </div>
			  
			  &nbsp;&nbsp;
			  <input type="submit" class="btn btn-success" value="<?php echo LOGIN;?>">
			  
			  <div class="clearfix"></div>
			  <br>
			  <div class="form-group">
				<label for="exampleInputEmail2"><?php echo LOGINFACEBOOKACCOUNT;?></label>
				<br>
				<fb:login-button scope="public_profile,email" class="faacebook_suctomCL" onlogin="checkLoginState('innerpg');">
<?php echo FBLOGIN;?>
</fb:login-button>&nbsp;<span id="innerfbloader">
			  </div>

</div>
<?php
}
?>
</div>
			</td>
		</tr>
	</table>
</form>