<div class="box">
    <div class="box-header">
        <h3 class="box-title">User Membership Detail</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            
            <tr>
               <td><?php echo __('Membership Type'); ?></td>
		<td>
			<?php echo h($userMembership['UserMembership']['memb_type']); ?>
			&nbsp;
		</td>
            </tr>
            <tr>
                <td><?php echo __('Price'); ?></td>
		<td>
			<?php echo h($userMembership['UserMembership']['price']); ?>
			&nbsp;
		</td>
            </tr>
             <tr>
                <td><?php echo __('Credits'); ?></td>
		<td>
			<?php echo h($userMembership['UserMembership']['credits']); ?>
			&nbsp;
		</td>
            </tr>
            <tr>
            <td><?php echo __('Status'); ?></td>
		<td>
			<?php if($userMembership['UserMembership']['status']==1){
					echo "Active";
			}else{
				echo "Inactive";
			}?>
			&nbsp;
		</td>
            </tr>
             <tr>
               <td><?php echo __('Created'); ?></td>
		<td>
			<?php echo date('d/m/Y',strtotime($userMembership['UserMembership']['created'])); ?>
			&nbsp;
		</td>
                  </tr>
                  <tr>
                <td><?php echo __('Modified'); ?></td>
		<td>
			<?php echo date('d/m/Y',strtotime($userMembership['UserMembership']['modified'])); ?>
			&nbsp;
		</td>
            </tr>
           
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->




