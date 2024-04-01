<script type="text/javascript">
// autocomplet : this function will be executed every time we change the text
function autocomplet() {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#UserCreditWalletUserId').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: '<?php echo $base_url;?>admin/ManageSales/autocomplete',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				//alert(data);
				$('#user_list_id').show();
				$('#user_list_id').html(data);
			}
		});
	} else {
		$('#user_list_id').hide();
	}
}

// set_item : this function will be executed when we select an item
function set_item(item) {
	// change input value
	$('#UserCreditWalletUserId').val(item);
	// hide proposition list
	$('#user_list_id').hide();
}
</script>
<!-- Main content -->
<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Credits</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo $this->Form->create('UserCreditWallet'); ?>
                <div class="box-body">

                  <div class="input_container">
                  <?php
				  
				  echo $this->Form->input('user_id',array('label' => 'Enter User Email', 'type' => 'text', 'class' => 'form-control', 'div' => 'form-group', 'onkeyup' => 'autocomplet()'));
				  ?>
                   <ul id="user_list_id"></ul>
     </div>
                  <?php
				 
				  echo $this->Form->input('credits',array('label' => 'Enter Credit amount', 'class' => 'form-control', 'div' => 'form-group'));
	?>
    
                    
                </div><!-- /.box-body -->

                <div class="box-footer">
                
                    <button type="submit" name="add_credit" class="btn btn-primary">Submit</button>
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
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->

