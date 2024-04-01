<div class="box">
    <div class="box-header">
        <h3 class="box-title">Brand Detail</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            
            <tr>
                <td><?php echo __('Brand Name'); ?></td>
                <td><?php echo h($manageBrand['ManageBrand']['brand_name']); ?></td>
            </tr>
            <tr>
                <td><?php echo __('Brand Logo'); ?></td>
                <td>
                    <?php if($manageBrand['ManageBrand']['image']!=''){ ?>
                    <img src="<?php echo $this->webroot.'files/brand/100X100_'.$manageBrand['ManageBrand']['image']?>" style="height:80px" />
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><?php echo __('Parent'); ?></td>
                <td><?php if(@$manageBrand['ManageBrand']['flag']==0){
			echo "Parent";
		}else{
			echo $this->Custom->brand_nm($manageBrand['ManageBrand']['flag']);
		}  ?></td>
            </tr>
             <tr>
                <td><?php echo __('Status'); ?></td>
                <td><?php if($manageBrand['ManageBrand']['status']==0){
				echo "Inactive";
			}else{
				echo "Active";
			} ?></td>
            </tr>
             <tr>
                <td><?php echo __('Created'); ?></td>
                <td><?php echo date('d/m/Y',strtotime($manageBrand['ManageBrand']['created'])); ?></td>
                  <tr>
                <td><?php echo __('Modified'); ?></td>
                <td><?php echo date('d/m/Y',strtotime($manageBrand['ManageBrand']['modified']));?></td>
            </tr>
            </tr>
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->

