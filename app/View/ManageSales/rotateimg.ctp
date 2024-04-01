<?php
if(isset($imgDetail)){
  $fileURL=$base_url.'files/tempfile/'.$imgDetail['TempImg']['img_path'];
  $fileName=$imgDetail['TempImg']['img_path'];
}elseif (isset($originalfile)) {
  $fileName=$originalfile['PostadImg']['img_path'];
  $fileURL=$base_url.'files/postad/'.$originalfile['PostadImg']['img_path'];
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset='utf-8'>
  <title>Image Rotation</title>
  <link href='<?php echo $base_url;?>rotateimage-library/css/jquery.guillotine.css' media='all' rel='stylesheet'>
  <link href='<?php echo $base_url;?>rotateimage-library/demo/demo.css' media='all' rel='stylesheet'>
  <link href='//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css' rel='stylesheet'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, target-densitydpi=device-dpi'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--[if lt IE 9]>
    <script src='//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'></script>
  <![endif]-->
</head>
<body>
  <div id='content'>
    <div class='frame'>
      <img id='sample_picture' src='<?php echo $fileURL;?>?timestamp=<?=time()?>' style="width:588px; height:441px;">
    </div>

    <div id='controls'>
    <form action="" name="rotateFrm" id="rotateFrm" method="post">
      <button id='rotate_left'  type='button' title='Rotate left'><i class='fa fa-rotate-left'></i></button>
      <!-- <button id='zoom_out'     type='button' title='Zoom out'><i class='fa fa-search-minus'></i></button> -->
      <button id='fit'          type='button' title='Fit image'><i class='fa fa-arrows-alt'></i></button>
      <!-- <button id='zoom_in'      type='button' title='Zoom in'><i class='fa fa-search-plus'></i></button> -->
      <button id='rotate_right' type='button' title='Rotate right'><i class='fa fa-rotate-right'></i></button>

    <input type="hidden" name="angleVal" id="angleval">
    <input type="hidden" name="rotate_file" id="rotate_file" value="<?php echo $fileName;?>">
    <button type="submit" name="rotatesubmit" id="rotatesubmit" title="Save"><i class="fa fa-floppy-o"></i></button>
    </form>
    </div>

    <ul id='data' style="display:none;">
      <div class='column'>
        <li>x: <span id='x'></span></li>
        <li>y: <span id='y'></span></li>
      </div>
      <div class='column'>
        <li>width:  <span id='w'></span></li>
        <li>height: <span id='h'></span></li>
      </div>
      <div class='column'>
        <li>scale: <span id='scale'></span></li>
        <li>angle: <span id='angle'></span></li>
        
      </div>
    </ul>
    
  </div>

  <script src='http://code.jquery.com/jquery-1.11.0.min.js'></script>
  <script src='<?php echo $base_url;?>rotateimage-library/js/jquery.guillotine.js'></script>
  <script type='text/javascript'>
    jQuery(function() {
      var picture = $('#sample_picture');

      // Make sure the image is completely loaded before calling the plugin
      picture.one('load', function(){
        // Initialize plugin (with custom event)
        picture.guillotine({eventOnChange: 'guillotinechange'});

        // Display inital data
        var data = picture.guillotine('getData');
        for(var key in data) { $('#'+key).html(data[key]); }

        // Bind button actions
        $('#rotate_left').click(function(){ picture.guillotine('rotateLeft'); });
        $('#rotate_right').click(function(){ picture.guillotine('rotateRight'); });
        $('#fit').click(function(){ picture.guillotine('fit'); });
        $('#zoom_in').click(function(){ picture.guillotine('zoomIn'); });
        $('#zoom_out').click(function(){ picture.guillotine('zoomOut'); });

        // Update data on change
        picture.on('guillotinechange', function(ev, data, action) {
          data.scale = parseFloat(data.scale.toFixed(4));
          for(var k in data) {
              if(k=='angle'){
                //alert(data[k]);
                $('#angleval').val(data[k]);
              }
              $('#'+k).html(data[k]);
            }
        });
      });

      // Make sure the 'load' event is triggered at least once (for cached images)
      if (picture.prop('complete')) picture.trigger('load')
    });
  </script>
</body>
</html>
