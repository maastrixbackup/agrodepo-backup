<?php
//pr($requestParts);exit;
?>
<?php if(isset($requestParts) && !empty($requestParts)){
	$requestcount=1;
	
	?>
<div id="listing_items">
    <table cellpadding="0" cellspacing="0" class="tab-content offer_los">
        <tbody>
            <tr class="listing_header">
            <td width="5%"><font><font><?php echo Sl;?></font></font></td>
            <td align="center" width="15%"><font><font><?php echo BIDBY;?></font></font></td>
              <td align="center" width="20%"><font><font><?php echo APPLICATION;?></font></font></td>
              <td align="center" width="15%"><font><font><?php echo OFERNM;?></font></font></td>
              <td align="center" width="10%"><font><font><?php echo OFERPRICE;?></font></font></td>
              <td align="center" width="10%"><font><font>Doriti piesa</font></font></td>
              <td align="center" width="10%"><font><font>Garanție</font></font></td>
                <td align="center" width="15%"><font><font><?php echo DATE;?></font></font></td>
            </tr>
            <?php foreach($requestParts as $requestPart){
				$name_piece=stripslashes($requestPart['RequestAccessory']['name_piece']);
				$brand_id=stripslashes($requestPart['RequestPart']['brand_id']);
				$model_id=stripslashes($requestPart['RequestPart']['model_id']);
				$slug_nm=stripslashes($requestPart['RequestAccessory']['slug']);
				$brandname=$this->Custom->brand_nm($brand_id);
				$modelname=$this->Custom->brand_nm($model_id);
				$offerno=stripslashes($requestPart['RequestAccessory']['offerno']);
				$created=stripslashes($requestPart['RequestPart']['created']);
				$request_id=$requestPart['RequestAccessory']['request_id'];
				$parts_id=$requestPart['RequestAccessory']['part_id'];
				?>
            <tr class="listing_data">
            
            <td align="center"><?php echo $requestcount;?></td>
            <td align="center"><?php 
			$userdetails=$this->Custom->user_details($requestPart['BidOffer']['user_id']);
			if(!empty($userdetails))
			{
				echo $userdetails['first_name'].' '.$userdetails['last_name'];
			}
			?></td>
                <td valign="top" class="listing_title_thumb col_name">
                    
                    <a href="<?php echo $base_url;?>pages/request-parts/<?php echo $slug_nm;?>" title="<?php echo $name_piece;?>"><strong><?php echo $name_piece;?></strong></a>
                    <br>
                    
                    <?php echo $brandname;?>&nbsp;<?php echo $modelname;?>
                    <br>
                </td>
                <td align="center"><font><font><?php echo $requestPart['BidOffer']['piece'];?></font></font></td>
                <td align="center"><font><font><?php echo $requestPart['BidOffer']['price'].' '.$requestPart['BidOffer']['currency'];?></font></font></td>
                <td align="center"><font><font><?php echo $requestPart['BidOffer']['offers'];?></font></font></td>
                <td align="center"><font><font><?php echo $requestPart['BidOffer']['warranty'].' ('.$requestPart['BidOffer']['validity'].')';?></font></font></td>
                <td align="center"><font><font><?php echo date("F d, Y",strtotime($created));?></font></font></td>
               
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
                <p><?php echo REQUESTHASBEENMARKED;?></p>
                <strong><?php echo REQUESTTOBEMADE;?></strong>
            </div>
<?php }?>