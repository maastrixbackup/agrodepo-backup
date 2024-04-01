<!--<div class="advertisements view">
<h2><?php echo __('Advertisement'); ?></h2>
	<dl>
		
		<td><?php echo __('Title'); ?></td>
		<td>
			<?php echo h($advertisement['Advertisement']['title']); ?>
			
		</td>
		<td><?php echo __('Ad Type'); ?></td>
		<td>
			<?php 
			$ad_options=array(1=>'Banner',2=>'Script');
			echo h($ad_options[$advertisement['Advertisement']['ad_type']]); ?>
			
		</td>
		<?php if($advertisement['Advertisement']['ad_type']==1){?>
		<td><?php echo __('Banner Title'); ?></td>
		<td>
			<?php echo h($advertisement['Advertisement']['banner_title']); ?>
			
		</td>
		<td><?php echo __('Banner Link'); ?></td>
		<td>
			<?php echo h($advertisement['Advertisement']['banner_link']); ?>
			
		</td>
		<?php }else{?>
			<td><?php echo __('Ad Script'); ?></td>
		<td>
			<?php echo h($advertisement['Advertisement']['ad_script']); ?>
			
		</td>
		<?php } ?>
		<td><?php echo __('Show Position'); ?></td>
		<td>
			<?php 
			$position_arr=array('1'=>'Top','2'=>'Left Sidebar 1','3'=>'Left Sidebar 2','4'=>'Middle','5'=>'right sidebar','6'=>'Footer');
			echo h($position_arr[$advertisement['Advertisement']['show_position']]); ?>
			
		</td>
		<td><?php echo __('Status'); ?></td>
		<td>
			<?php 
			$staus_arr=array('0'=>'Inactive','1'=>'Active');
			echo h($staus_arr[$advertisement['Advertisement']['status']]); ?>
			
		</td>
		<td><?php echo __('Created'); ?></td>
		<td>
			<?php echo date('d/m/Y',strtotime($advertisement['Advertisement']['created'])); ?>
			
		</td>
		<td><?php echo __('Modified'); ?></td>
		<td>
			<?php echo date('d/m/Y',strtotime(($advertisement['Advertisement']['modified']))); ?>
			
		</td>
	</dl>
</div>-->


<div class="box">
    <div class="box-header">
        <h3 class="box-title">Advertisement Detail</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            
            <tr>
                       
                <td><?php echo __('Title'); ?></td>
                <td>
                    <?php echo h($advertisement['Advertisement']['title']); ?>
                    
                </td>
            </tr>
            <tr>
                       <td><?php echo __('Ad Type'); ?></td>
                <td>
                    <?php 
                    $ad_options=array(1=>'Banner',2=>'Script');
                    echo h($ad_options[$advertisement['Advertisement']['ad_type']]); ?>
                    
                </td>
        
            </tr>
             <tr>
               <?php if($advertisement['Advertisement']['ad_type']==1){?>
		<td><?php echo __('Banner Title'); ?></td>
		<td>
			<?php echo h($advertisement['Advertisement']['banner_title']); ?>
			
		</td>
            </tr>
             <tr>
                <td><?php echo __('Banner Link'); ?></td>
		<td>
			<?php echo h($advertisement['Advertisement']['banner_link']); ?>
			
		</td>
                  </tr>
                  
                   <tr>
               <?php }else{?>
			<td><?php echo __('Ad Script'); ?></td>
		<td>
			<?php echo h($advertisement['Advertisement']['ad_script']); ?>
			
		</td>
		<?php } ?>
                  </tr>
                  
                   <tr>
                <td><?php echo __('Show Position'); ?></td>
		<td>
			<?php 
			$position_arr=array('1'=>'Top','2'=>'Left Sidebar 1','3'=>'Left Sidebar 2');
			echo h($position_arr[$advertisement['Advertisement']['show_position']]); ?>
			
		</td>
                  </tr>
                  
                <td><?php echo __('Status'); ?></td>
		<td>
			<?php 
			$staus_arr=array('0'=>'Inactive','1'=>'Active');
			echo h($staus_arr[$advertisement['Advertisement']['status']]); ?>
			
		</td>
                  </tr>
                   </tr>
                  
                <td><?php echo __('Created'); ?></td>
		<td>
			<?php echo date('d/m/Y',strtotime($advertisement['Advertisement']['created'])); ?>
			
		</td>
                  </tr>
                   </tr>
                  
               <td><?php echo __('Modified'); ?></td>
		<td>
			<?php echo date('d/m/Y',strtotime(($advertisement['Advertisement']['modified']))); ?>
			
		</td>
                  </tr>
                 
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->


