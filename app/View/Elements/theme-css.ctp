<?php
if(!empty($themeRes))
{
	?>
    <style type="text/css">
    <?php
	foreach($themeRes as $themeResult)
	{
		$html_tag=$themeResult['Theme']['html_tag'];
		$font_size=$themeResult['Theme']['font_size'];
		$font_color=$themeResult['Theme']['font_color'];
		?>
		<?php echo $html_tag;?>{font-size:<?php echo $font_size;?> !important; color:#<?php echo $font_color;?> !important;}
		<?php
	}
	?>
	</style>
	<?php
}
?>