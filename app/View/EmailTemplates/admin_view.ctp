<div class="box">
    <div class="box-header">
        <h3 class="box-title">Template Detail</h3>
        <div class="box-tools pull-right">
              <button class="btn btn-primary btn-flat" onclick="location.href='<?php echo $base_url;?>admin/EmailTemplates/'">Manage Template</button>
                   
            </div>
    </div><!-- /.box-header -->

    <div class="box-body">
        <table class="table table-bordered">
            
           <tr>
                <td><?php echo __('Assign To'); ?></td>
                <td>
                    <?php 
		$usertype=array(1 => 'Register for User', 2 =>'Forgot password', 3 => 'User Past Ad Order',4 => 'User Register for Admin', 5 => 'Admin Past Ad Order', 6 => 'Seller Past Ad Order', 7 => 'Parts Request Question(parent)', 8 => 'Parts Request Question(sub question)', 9 => 'Bid Offer', 10 => 'Sales Question', 11 => 'Parts Order to User', 12 => 'Parts Order to Bidder', 13 => 'Parts Order to Admin', 14 => 'Subscribe Alert for ad', 15 => 'Subscribe Alert for Request Parts');
		echo $usertype[$emailTemplate['EmailTemplate']['email_of']];
		?>
                    
                </td>
          </tr>
          <tr>
                <td valign="top"><?php echo __('Mail Subject'); ?></td>
                <td>
                    <?php
			echo stripslashes($emailTemplate['EmailTemplate']['mail_subject']);
		 ?>
                </td>
          </tr>
          <tr>
                <td valign="top"><?php echo __('Mail Body'); ?></td>
                <td>
                    <?php
			echo stripslashes($emailTemplate['EmailTemplate']['mail_body']);
		 ?>
                </td>
          </tr>
           
           
        </table>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->


