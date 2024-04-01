<?php
echo $this->element('header-home');
?>
<div class="container">
	<div class="row">

		<div class="innerpanel">
			<!-- Left Sidebar Start -->
			<div class="col-md-12 prof">
				<div class="clearfix" style="height:15px;"></div>

				<div id="breadcrumb">
					<ul class="crumbs">
						<li class="first"> <a style="z-index:9;" href="<?php echo $base_url; ?>"><span></span><?php echo HOME; ?></a> </li>
						<li class="last"><a style="z-index:7;" href="javascript:void(0);"><?php echo COMPANYPARTS; ?></a></li>
					</ul>
				</div>

				<div class="clearfix" style="height:10px;"></div>

				<h2 class="detailstitle1" style="color:#DF5E08"><?php echo COMPANYPARTS; ?></h2>

				<div class="clearfix" style="height:15px;"></div>

				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-12">
							<?php echo $this->Session->flash(); ?>
							<div class="row searchlistdata">
								<ul>
									<?php
									if (!empty($truckRes)) {
										foreach ($truckRes as $truckResult) {
											$user_id = stripslashes($truckResult['SalesPark']['user_id']);
											$park_name = stripslashes($truckResult['SalesPark']['park_name']);
											$description = (strlen($truckResult['SalesPark']['description']) > 105) ? substr(stripslashes($truckResult['SalesPark']['description']), 0, 105) . '...' : stripslashes($truckResult['SalesPark']['description']);
											$brand_id = stripslashes($truckResult['SalesPark']['brand_id']);
											$comp_name = stripslashes($truckResult['SalesPark']['comp_name']);
											$logo = stripslashes($truckResult['SalesPark']['logo']);
											$country_id = stripslashes($truckResult['SalesPark']['country_id']);
											$countryname = $this->Custom->region_nm($country_id);
											$location_id = stripslashes($truckResult['SalesPark']['location_id']);
											$locationname = $this->Custom->location_nm($location_id);
											$vat = stripslashes($truckResult['SalesPark']['vat']);
											$totpostad = $this->Custom->dezPostAdsCount('user_id', $user_id);
											$totrequestparts = $this->Custom->dezRequestPartCount('user_id', $user_id);
											$brandname = '';
											if ($brand_id != '') {
												$brandarr = explode(',', $brand_id);
												foreach ($brandarr as $singbid) {
													$brandname .= $this->Custom->brand_nm($singbid) . " ";
												}
											}
											$slug = stripslashes($truckResult['SalesPark']['slug']);
											$memdetail = $this->Custom->BapCustUniMembership($user_id);
											$parkUrl = $base_url . 'pages/parks/' . $slug;
									?>
											<li>
												<div class="col-lg-2">
													<div class="row">
														<a href="<?php echo $parkUrl; ?>">
															<?php if ($logo != '') {
																if (file_exists('files/company_logo/133X100_' . $logo)) {
																	$logo_path = $base_url . 'files/company_logo/133X100_' . $logo;
																} else {
																	$logo_path = $base_url . 'files/company_logo/' . $logo;
																}
															?>
																<img src="<?php echo $logo_path; ?>" class="listimg_fix" alt="<?php echo $comp_name; ?>">
															<?php } else { ?>
																<img src="<?php echo $base_url; ?>images/profileholder.png" class="listimg_fix" alt="<?php echo $comp_name; ?>">
															<?php } ?>
														</a>
														<div class="clear5"></div>
														<button class="blue_btn btn radius-zero imagefull" onclick="location.href='<?php echo $base_url; ?>/Search/index/user_id:<?php echo $user_id; ?>';"><?php echo SEEALLADS; ?>»</button>
													</div>
												</div>

												<div class="col-lg-8">
													<div class="datalistitem">
														<h1><a href="<?php echo $parkUrl; ?>"><?php echo $park_name; ?></a></h1>
														<p>
															<span class="blue_txt"><?php echo $comp_name; ?> &nbsp;| </span>
															<span class="blue_txt vat_data"><?php echo $vat; ?></span>
															<br>

														<div class="clear5"></div>

														<span class="text-upper op7"><img src="<?php echo $base_url; ?>images/location.png" alt="location" /> <?php echo $locationname . ' &nbsp;&nbsp;' . $countryname; ?> | <!--<img src="<?php // echo $base_url;
																																																										?>images/icon_calendar.gif" alt="date" />--> Anunturi : <?php echo $totpostad; ?> | cereri : <?php echo $totrequestparts; ?> | piece levrate :0

														</span>
														<div class="clear5"></div>

														<span class="font12"><?php echo nl2br($description); ?></span>
														</p>
														<div class="clear"></div>
														<div class="sr_user_isseller" style="background:none; padding-left:0; height:auto;">
															<span class="text-upper">Marci Dezmembrate :</span>
															<span class="text-upper op7"><?php echo $brandname; ?></span>
														</div>

													</div>
												</div>

												<div class="col-lg-2">
													<div class="row">
														<div class="sr_price mr_minus">
															<h3>
																<?php
																if (!empty($memdetail)) {
																	if ($memdetail['UserMembership']['plan_img'] != '') {
																		if (file_exists('files/memberplanimg/70X100_' . $memdetail['UserMembership']['plan_img'])) {
																			$memdetail_path = $base_url . 'files/memberplanimg/70X100_' . $memdetail['UserMembership']['plan_img'];
																		} else {
																			$memdetail_path = $base_url . 'files/memberplanimg/' . $memdetail['UserMembership']['plan_img'];
																		}
																?>
																		<img src="<?php echo $memdetail_path; ?>" alt="<?php echo $memdetail['UserMembership']['memb_type']; ?>">
																<?php }
																} ?>
															</h3>

														</div>
													</div>
												</div>
												<div class="clearfix"></div>
											</li>
									<?php
										}
									}
									?>

								</ul>
							</div>
						</div>

						<div class="paging">
							<?php
							echo $this->Paginator->prev(__('«'), array(), null, array('class' => 'prev disabled'));
							echo $this->Paginator->numbers(array('separator' => ''));
							echo $this->Paginator->next(__('»'), array(), null, array('class' => 'next disabled'));
							?>
						</div>
					</div>
				</div>



				<div class="col-lg-3 prof" style="padding-right: 0px;">
					<?php /*?> <button class="org_btn btn radius-zero imagefull text-upper" onclick="location.href='<?php echo $base_url;?>SalesParks/company_add';"><img src="<?php echo $base_url;?>images/plus_white.png" width="25"><strong>  <?php echo ADDTOCOMPANYPARTS;?></strong></button>
                          <div class="clear15"></div><?php */ ?>


					<h2 class="detailstitle1" style="color: #fff;background: #1996E6;padding: 5px 5px 5px 10px;"><?php echo RECENTCOMPANYPARTS; ?></h2>
					<?php
					echo $this->element('park-right');
					?>
				</div>


				<div class="clear"></div>

			</div>
			<!-- Left Sidebar End -->


			<div class="clearfix" style="height:1px;"></div>






		</div>
	</div>
	<div class="clearfix"></div>
</div>
<?php
echo $this->element('footer-home');
?>