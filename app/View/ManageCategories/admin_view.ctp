
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Category Detail</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
         <tr>
		<td><?php echo __('Category Name'); ?></td>
		<td>
			<?php echo h($manageCategory['ManageCategory']['category_name']); ?>
			&nbsp;
		</td>
        </tr>
		<tr>
		<td><?php echo __('Status'); ?></td>
		<td>
			<?php if($manageCategory['ManageCategory']['status']==0){
				echo "Inactive";
			}else{
				echo "Active";
			} ?>
			&nbsp;
		</td>
        </tr>
        <tr>
		<td><?php echo __('Created'); ?></td>
		<td>
			<?php echo date('d/m/Y',strtotime($manageCategory['ManageCategory']['created'])); ?>
			&nbsp;
		</td>
	</tr>
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->

