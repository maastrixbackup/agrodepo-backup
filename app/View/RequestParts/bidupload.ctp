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
						var seq=$("#seqno").val();
						
						// image loading message
						parent.document.getElementById('loading').style.display = "block";
						parent.document.getElementById('loading').innerHTML = "Loading Image, Please Wait...";
					}
				});
			});
			displayImg(<?php echo $this->request->params['named']['seqno'];?>);
		});
		function displayImg(seqno)
		{	
		<?php  if($this->Session->check('User'))
			 {?>			
				parent.document.getElementById('loading').style.display = "none";
				// image loading message
				parent.document.getElementById('loading').innerHTML = "";
				<?php }else{?>
				parent.document.getElementById('loading').style.display = "block";
				// image loading message
				parent.document.getElementById('loading').innerHTML = "First login to upload photo";
				<?php }?>
				var imgcontent=$("#imgcontent").html()
				if(imgcontent!='')
				{
				parent.document.getElementById('picGallery').style.display = "block";
				parent.document.getElementById('picGallery').innerHTML = imgcontent;
				}
		}
	/* ]]> */
	function removedata(imgid,img_fold)
{
	parent.document.getElementById('loading').style.display = "block";
	parent.document.getElementById('loading').innerHTML = "Removing Image, Please Wait...";
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url; ?>RequestParts/removeBidImg',
				data: 'imgid='+imgid+'&img_fold='+img_fold,
				success: function(data) {
					//alert(data);
					if(data==1)
					{
						if(img_fold=='temp')
						{
						$("#imgtemp"+imgid).remove();
						parent.document.getElementById('loading').style.display = "none";
						parent.document.getElementById('loading').innerHTML = "";
						$("#showuploadDiv").show(500);
						}
						else if(img_fold=='original')
						{
							parent.document.getElementById('loading').style.display = "none";
							parent.document.getElementById('loading').innerHTML = "";
							$("#imgoriginal"+imgid).remove();
							$("#showuploadDiv").show(500);
						}
					}
					
				}
			});
}
	</script>
<style type="text/css">
.listphoto ul li{cursor:pointer;}
body{padding:0; margin:0;}
/*.imgup{margin:10px 0px 0px 10px;}*/
.formclas{margin:0;}
ul.file_select{margin:0;
padding:0;}
ul.file_select li a {
text-decoration: none;
display: block;
width: 80px;
height: 80px;
margin-right: 15px;
margin-bottom: 15px;
border: 1px dashed #1996E6;
}
ul.file_select li a span {
display: block;
width: 30px;
height: 30px;
margin: 0 auto;
background: #1996E6;
color: #fff;
border-radius: 35px;
font-size: 22px;
margin-top: 1.1em;
line-height: 29px;
text-align: center;
font-weight: bold;
}
ul.file_select li a:hover span {
background: #66CC00;
}
#BidTempFileImgPth
{
	width: 81px;
height: 82px;
position: absolute;
top: 0px;
cursor:pointer;
opacity: 0;
}
.iframe_list
{
	margin:0;
	padding:0;
	list-style-type:none;
}
.iframe_list li	
{
	margin:0;
	padding:0;
	list-style-type:none;
	width: 86px;
	cursor:pointer;
position: relative;
height: 85px;
}
.iframe_list li	img
{
	width: 85px;
height: 82px;
border:none;
}
.iframe_list li button
{
	position: absolute;
z-index: 5000;
right: 0;
display: block;
width: 21px;
height: 20px;
background: rgba(255, 89, 4, 0.7);
color: #fff;
font-size: 11px;
line-height: 19px;
text-align: center;
font-weight: bold;
border: none;
top: 0;
cursor: pointer;
}
</style>
<?php
if(!empty($imgContent))
{
	$style=" style='display:none;'";
}
else
{
	$style="";
}
?>
<div id="showuploadDiv"<?php echo $style;?>>
<?php
echo $this->Form->create('BidTempFile', array('type' => 'file', 'name' => 'RequestPartsBidTempFileForm', 'class' => 'formclas')); ?>
<ul class="file_select">
    <li>
        <a href="#">
            <span>+</span>
            <?php echo $this->Form->input('img_pth', array('type' => 'file','name' => 'data[BidTempFile][img_pth][]', 'label' => false,'class' => 'imgup', 'div' => false));
 ?>
        </a>
    </li>
</ul>

 <input type="hidden" name="data[BidTempFile][seqno]" id="seqno" value="<?php echo $this->request->params['named']['seqno'];?>" />
 <input type="submit" id="submit" value="Upload" style="display:none;">
</form>
</div>
<?php
 if(!empty($imgContent))
{
	 echo $imgContent;
}
?>