<div class="box col-lg-6">
    <div class="box-header">
        <h3 class="box-title">Request parts Detail</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-primary btn-flat" onclick="location.href='<?php echo $base_url;?>admin/Reports/request_part'">Manage Request Parts</button>
               
        </div>
    </div><!-- /.box-header -->
    <div class="box-body col-lg-8">
        <table class="table table-bordered">
            
            <tr>
                <td width="20%"><?php echo __('Item Title'); ?></td>
                <td><?php echo $requestPart['RequestAccessory']['name_piece'];?></td>
            </tr>
            <tr>
                <td><?php echo __('About the song'); ?></td>
                <td><?php echo $requestPart['RequestAccessory']['description'];?></td>
            </tr>
             <tr>
                <td><?php echo __('Brand car'); ?></td>
                <td><?php echo $this->Custom->brand_nm($requestPart['RequestPart']['brand_id']);?></td>
            </tr>
             <tr>
                <td><?php echo __('Model'); ?></td>
                <td><?php echo $this->Custom->brand_nm($requestPart['RequestPart']['model_id']);?></td>
                 
            </tr>
             <tr>
                <td><?php echo __('Version'); ?></td>
                <td><?php echo $requestPart['RequestPart']['version']; ?></td>
            </tr>
            <tr>
                <td><?php echo __('Year'); ?></td>
                <td><?php echo $requestPart['RequestPart']['yr_of_manufacture']; ?></td>
            </tr>
            <tr>
                <td><?php echo __('Engines'); ?></td>
                <td><?php echo $requestPart['RequestPart']['engines']; ?></td>
            </tr>
            <tr>
                <td><?php echo __('Series Chassis'); ?></td>
                <td><?php echo $requestPart['RequestPart']['vehicle_identy_no']; ?></td>
            </tr>
             <tr>
                <td><?php echo __(' Want song'); ?></td>
                <td><?php echo $requestPart['RequestPart']['want_song']; ?></td>
            </tr>
             <tr>
                <td><?php echo __(' County'); ?></td>
                <td><?php echo $this->Custom->region_nm($requestPart['RequestPart']['county']); ?></td>
            </tr>
            <tr>
                <td><?php echo __(' Location'); ?></td>
                <td><?php echo $this->Custom->location_nm($requestPart['RequestPart']['city']); ?></td>
            </tr>
            <td colspan="2">
            <ul class="nav nav-pills">
            <?php
			$imgRes=$this->Custom->partsImg($requestPart['RequestAccessory']['part_id']);
			if(!empty($imgRes))
			{
				foreach($imgRes as $imgpath)
				{
					?>
                    <li class="list-group-item"><img src="<?php echo $base_url.'files/requestpart/'.$imgpath;?>" style="width:100px; height:100px" alt="" /></li>
                    <?php
				}
			}
			?>
            </ul>
            </td>
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->
