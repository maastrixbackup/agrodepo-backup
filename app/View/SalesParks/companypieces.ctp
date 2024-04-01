
<?php if(isset($salesParks) && !empty($salesParks)){
	$requestcount=1;
	
	?>
<div id="listing_items">
    <table cellpadding="0" cellspacing="0" class="tab-content">
        <tbody>
            <tr class="listing_header">
            <td width="50px"><font><font><?php echo Sl;?></font></font></td>
              <td align="center" width="226"><font><font>Nume Parks</font></font></td>
              <td align="center" width="259"><font><font>Numele Companiei</font></font></td>
              <td align="center" width="259"><font><font>companie Logo</font></font></td>
                <td align="center" width="114"><font><font><?php echo DATE;?></font></font></td>
                <td align="center" width="114"><font><font><?php echo OPTIONS;?></font></font></td>
            </tr>
            <?php foreach($salesParks as $salesPark){
				$park_name=stripslashes($salesPark['SalesPark']['park_name']);
				$comp_name=stripslashes($salesPark['SalesPark']['comp_name']);
				$logo=stripslashes($salesPark['SalesPark']['logo']);
				$slug_nm=stripslashes($salesPark['SalesPark']['slug']);
				$created=stripslashes($salesPark['SalesPark']['created']);
				$parkid=$salesPark['SalesPark']['park_id'];
				?>
                
            <tr class="listing_data">
            <td align="center"><?php echo $requestcount;?></td>
                <td valign="top" class="listing_title_thumb col_name">
                    
                    <a href="<?php echo $base_url;?>pages/parks/<?php echo $slug_nm;?>" title="<?php echo $park_name;?>" target="_blank"><strong><?php echo $park_name;?></strong></a>
                  
                </td>
                <td align="center"><font><font><?php echo $comp_name;?></font></font></td>
                <td align="center"><font><font><?php if($logo!=''){?><img src="<?php echo $base_url;?>/files/company_logo/<?php echo $logo;?>" style="width:100px;" alt="<?php echo $comp_name;?>" /> <?php }?></font></font></td>
                <td align="center"><font><font><?php echo date("F d, Y",strtotime($created));?></font></font></td>
                <td>
                    <div class="mycp_listing_option">
                        <button class="btn btn-success" type="button" onclick="location.href='<?php echo $base_url;?>SalesParks/edit/<?php echo $parkid;?>'">Edit</button>
                    </div>
                     <div class="mycp_listing_option remove">
                        <?php 
												echo $this->Form->postLink(__('șterge'), array('action' => 'delete', $parkid), array(), __('Sigur doriți să ștergeți # %s?', $park_name));?>
                                                </div>
                </td>
            </tr>
            <?php
			$requestcount++;
			 }
			?>
          
        </tbody>
    </table>
</div>
  <?php }else{?>
<div class="tabdata">
                <p>Parcuri Nu a fost gasit</p>
            </div>
<?php }?>
