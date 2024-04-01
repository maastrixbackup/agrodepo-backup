<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">/* <![CDATA[ */
		$(function() {
			var supports_file_multiple = ('multiple' in document.createElement('input'));

			$('input[type="file"]').each(function() {
				var elem = $(this);
				elem.change(function() {
					if(elem.val())
					{
						//alert(elem.val());
						$('#submit').trigger('click');
						elem.hide();
						// display image lodaing block
						parent.document.getElementById('loading').style.display = "block";
						// image loading message
						parent.document.getElementById('loading').innerHTML = "Loading Image, Please Wait...";
					}
				});
			});
			displayImg();
		});
		function displayImg()
		{				
				parent.document.getElementById('loading').style.display = "none";
				// image loading message
				parent.document.getElementById('loading').innerHTML = "";
				var imgcontent=$("#imgcontent").html()
				if(imgcontent!='')
				{
				parent.document.getElementById('picGallery').style.display = "block";
				parent.document.getElementById('picGallery').innerHTML = imgcontent;
				}
		}
	/* ]]> */
	</script>
<style type="text/css">
body{padding:0; margin:0;}
/*.imgup{margin:10px 0px 0px 10px;}*/
.formclas{margin:0;}
</style>
<?php echo $this->Form->create('SalesParks', array('type' => 'file', 'name' => 'fileuploadform', 'class' => 'formclas')); ?>

<?php echo $this->Form->input('img_path', array('type' => 'file', 'name' => 'data[SalesParks][img_path][]', 'label' => false,'class' => 'imgup', 'div' => false,'multiple' => 'multiple'));
 ?>
 <input type="submit" id="submit" value="Upload" style="display:none;">
</form>
<div id="imgcontent" style="display:none;"><?php echo $imgContent;?></div>
