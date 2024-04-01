<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
						parent.document.getElementById('loading').style.display = "block";
						//parent.document.getElementById('loading').innerHTML = "Loading Image, Please Wait...";
						
						//parent.document.getElementById('postadDetailbtn').style.display = "none";
					}
					
				});
			});
			displayImg();
			
		});
		function displayImg()
		{		
				parent.document.getElementById('loading').style.display = "none";
				// image loading message
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
.iframe_list{list-style-type:none; float:none; margin:0; padding:0;}
.iframe_list li{list-style-type: none;float: left;width: 15%;margin: 10px;padding: 0;position: relative;background: #000;border: 2px solid rgb(194, 194, 194);
border-radius: 4px;}
.iframe_list li:nth-child(4){margin-right:0;}
.iframe_list li button{background-color: #d9534f;cursor: pointer;outline: none;padding: 3px;color: #FFF;font-size: 13px;text-decoration: none;border: 1px solid #d9534f;border-radius: 3px;width: 21px;height: 22px;position: absolute;top: 5px;right: 5px;}
.iframe_list li img{width: 100%;height: 130px;}
.iframe_list li:hover img{opacity:0.8;}
.imgup{margin:10px 0px 0px 10px;}
</style>
</head>
<body>
<?php echo $this->Form->create('ManageSale', array('type' => 'file', 'action' => 'fileupload/', 'name' => 'fileuploadform')); ?>

<?php echo $this->Form->input('adv_img', array('type' => 'file','name' => 'data[ManageSale][adv_img][]', 'label' => false,'class' => 'imgup', 'div' => false,'multiple' => 'multiple'));
echo $this->Form->input('post_id', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $postid));
 ?>
 <input type="submit" id="submit" value="Upload" style="display:none;">
</form>
<div class="loading" style="display:none; text-align:center">
			<img src="http://www.pieseauto.ro/images/default/ajax-loader.gif" alt="loading...">
			<span>Loading...</span>
		</div>
        <div id="imgcontent" style="display:none">
<?php

if(isset($tempfile) && !empty($tempfile))
{
	?>
    <ul class="iframe_list">
    <?php
	foreach($tempfile as $temp_file)
	{
		?>
        <li id="imgtemp<?php echo $temp_file['TempImg']['img_id'];?>"><img src="<?php echo $base_url.'files/tempfile/'.$temp_file['TempImg']['img_path'];?>?timestamp=<?=time()?>" /><br />
        <button type="button" style="text-align:center" onclick="removedata(<?php echo $temp_file['TempImg']['img_id'];?>,'temp')">X</button>
       <button type="button" class="btn btn-primary rotateClass" data-toggle="modal" data-target="#rotateModel" onclick="getrotateidFunc(<?php echo $temp_file['TempImg']['img_id'];?>, 'temp');">Rotate Image</button> 
        </li>
        <?php
	}
	?>
    </ul>
   
    <?php
}
if(isset($originalfile) && !empty($originalfile))
{
	?>
    <ul class="iframe_list">
    <?php
	foreach($originalfile as $ori_file)
	{
		?>
        <li id="imgoriginal<?php echo $ori_file['PostadImg']['imgid'];?>"><img src="<?php echo $base_url.'files/postad/'.$ori_file['PostadImg']['img_path'];?>?timestamp=<?=time()?>" />
        <button type="button" onclick="removedata(<?php echo $ori_file['PostadImg']['imgid'];?>,'original')">X</button>
        <button type="button" class="btn btn-primary rotateClass" data-toggle="modal" data-target="#rotateModel" onclick="getrotateidFunc(<?php echo $ori_file['PostadImg']['imgid'];?>, 'original');">Rotate Image</button>
        </li>
        <?php
	}
	?>
    </ul>
     
    <?php
}
?>
</div>
</body>
</html>