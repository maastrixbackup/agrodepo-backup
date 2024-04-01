<?php
//pr($requestParts);
?>
<?php if(isset($requestParts) && !empty($requestParts)){
	$requestcount=1;
	
	?>
<div id="listing_items">
    <table cellpadding="0" cellspacing="0" class="tab-content">
        <tbody>
            <tr class="listing_header">
            <td width="438"><font><font><?php echo Sl;?></font></font></td>
              <td align="center" width="226"><font><font><?php echo APPLICATION;?></font></font></td>
              <td align="center" width="259"><font><font><?php echo OFFERSS;?></font></font></td>
                <td align="center" width="114"><font><font><?php echo DATE;?></font></font></td>
                <td align="center" width="114"><font><font><?php echo OPTIONS;?></font></font></td>
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
                <td valign="top" class="listing_title_thumb col_name">
                    
                    <a href="<?php echo $base_url;?>pages/request-parts/<?php echo $slug_nm;?>" title="<?php echo $name_piece;?>"><strong><?php echo $name_piece;?></strong></a>
                    <br>
                    
                    <?php echo $brandname;?>&nbsp;<?php echo $modelname;?>
                    <br>
                </td>
                <td align="center"><font><font><?php echo $offerno;?></font></font></td>
                <td align="center"><font><font><?php echo date("F d, Y",strtotime($created));?></font></font></td>
                <td>
                    <!--<div class="mycp_listing_option">
                        <button class="btn btn-success" type="button" onclick="location.href='<?php //echo $base_url;?>RequestParts/edit/<?php //echo $request_id;?>/<?php //echo $parts_id;?>'">Edit</button>
                    </div>-->
                    <div class="mycp_listing_option">
                        <button class="btn btn-primary" type="button" onclick="location.href='<?php echo $base_url;?>pages/request-parts/<?php echo $slug_nm;?>'"><?php echo VIEWAPPLICATION;?></button>
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
                <p><?php echo REQUESTSOVEPARTS;?></p>
                <strong><?php echo NOREQUESTSOLVED;?></strong>
            </div>
<?php }?>