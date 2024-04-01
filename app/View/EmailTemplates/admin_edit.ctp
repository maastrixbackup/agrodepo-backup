<script type="text/javascript" src="<?php echo $base_url;?>js/ckeditor/ckeditor.js"></script>
<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Update Email Template</h3>
                <div class="box-tools pull-right">
              <button class="btn btn-primary btn-flat" onclick="location.href='<?php echo $base_url;?>admin/EmailTemplates/'">Manage Template</button>
                   
            </div>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo $this->Form->create('EmailTemplate'); ?>
                <div class="box-body">
                  <?php
                  echo $this->Form->input('compose_id');
                  echo $this->Form->input('email_of',array('label' => 'Select Page', 'class' => 'form-control', 'div' => 'form-group', 'type' => 'select', 'options' => array(1 => 'Register for User', 2 =>'Forgot password', 3 => 'User Past Ad Order',4 => 'User Register for Admin', 5 => 'Admin Past Ad Order', 6 => 'Seller Past Ad Order', 7 => 'Parts Request Question(parent)', 8 => 'Parts Request Question(sub question)', 9 => 'Bid Offer', 10 => 'Sales Question', 11 => 'Parts Order to User', 12 => 'Parts Order to Bidder', 13 => 'Parts Order to Admin', 14 => 'Subscribe Alert for ad', 15 => 'Subscribe Alert for Request Parts')));
		echo $this->Form->input('mail_subject',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
		echo $this->Form->input('mail_body',array('label' => 'Mail Body(<i>To dynamically retrive data:</i> {Name}, {RegisterDetail}, {logindetail}, {orderDetail},{AccountLink},{sellerMsgDetail},{MyPurchaseLink},{OrderId},{OrderDetail},{CommandLink},{partsName},{PartsUrl},{PostAdName},{FromName},{SalesLink},{PartsOrderDetail},{OfferPieceName},{PartsDeliveryDetail}, {AdLink}, {RequestPartsLink})','class' => 'form-control ckeditor', 'div' => 'form-group'));
		$status=array('0'=>'Inactive','1'=>'Active');
		echo $this->Form->input('compose_status',array('label'=>'Status','options'=>$status,'selected'=>1,'class' => 'form-control', 'div' => 'form-group'));
		//echo $this->Form->input('status');
	?>
                    
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div><!-- /.box -->

      

    </div><!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">
        <!-- general form elements disabled -->
        <!-- /.box -->
    </div><!--/.col (right) -->
</div>   <!-- /.row -->
</section><!-- /.content -->