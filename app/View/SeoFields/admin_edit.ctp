<section class="content">
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit SEO</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo $this->Form->create('SeoField'); ?>
                <div class="box-body">
                
    <?php
		echo $this->Form->input('seo_id');
		echo $this->Form->input('page_name',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('meta_title',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('meta_desc',array('class' => 'form-control', 'div' => 'form-group'));
		echo $this->Form->input('meta_keyword',array('class' => 'form-control', 'div' => 'form-group'));
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
</section>
