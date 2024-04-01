<div class="box">
    <div class="box-header">
        <h3 class="box-title">Success Story Detail</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            
           <tr>
                <td><?php echo __('User Name'); ?></td>
                <td>
                    <?php 
					$user_details=$this->Custom->user_details($successStory['SuccessStory']['user_id']);
					echo $user_details['first_name'].' '.$user_details['last_name'];
					 ?>
                    
                </td>
          </tr>
          <tr>
                <td valign="top"><?php echo __('Submited By'); ?></td>
                <td>
				<?php 
				$submitarr=array(0 => 'Admin', 1 => 'User');
				echo $submitarr[$successStory['SuccessStory']['submit_from']]; ?>       
                </td>
          </tr>
           <tr>
                <td valign="top"><?php echo __('Description'); ?></td>
                <td>
				<?php 
				echo stripslashes($successStory['SuccessStory']['content']);
				 ?>       
                </td>
          </tr>
            <tr>
               <td><?php echo __('Post date'); ?></td>
                <td>
                    <?php echo date("d-m-Y", strtotime($successStory['SuccessStory']['created'])); ?>
                    
                </td>
           </tr>
           <tr>
               <td><?php echo __('Status'); ?></td>
                <td>
           <?php 
			$status=array(1=> 'Active', 0 => 'Inactive');
			echo $status[$successStory['SuccessStory']['status']]; ?>
			</td>
           </tr>
           
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->


