<?php
include_once './manage/gallery/galleryClass.php';
$galleryClass=new galleryClass();
$galleryList=$galleryClass->listGallery();
?>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
<link rel="stylesheet" href="//bootsnipp.com/dist/bootsnipp.min.css">
<style>
body {
  background: #fed136;
  background: -moz-linear-gradient(left, #fed136 0%, #fff0bd 67%, #ffffff 100%);
  background: -webkit-gradient(left top, right top, color-stop(0%, #fed136), color-stop(67%, #fff0bd), color-stop(100%, #ffffff));
  background: -webkit-linear-gradient(left, #fed136 0%, #fff0bd 67%, #ffffff 100%);
  background: -o-linear-gradient(left, #fed136 0%, #fff0bd 67%, #ffffff 100%);
  background: -ms-linear-gradient(left, #fed136 0%, #fff0bd 67%, #ffffff 100%);
  background: linear-gradient(to right, #fed136 0%, #fff0bd 67%, #ffffff 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fed136', endColorstr='#ffffff', GradientType=1 );
}
.button {
  background-color: #fec810; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
#ok.pre {
  font-family: monospace;
  white-space: pre;
  margin: 1em 0;
}
#lightbox .modal-dialog {
    margin: 30vh auto 30vh 20px
}
#lightbox .modal-content {
display: inline-block;
text-align: center;   
}
#lightbox .close {
opacity: 1;
color: rgb(255, 255, 255);
background-color: rgb(25, 25, 25);
padding: 5px 8px;
border-radius: 30px;
border: 2px solid rgb(255, 255, 255);
position: absolute;
top: -15px;
right: -55px;
z-index:1032;
}
</style>
<div class="container">
    <?php
    if(count($galleryList)){
    foreach ($galleryList as $value) {
        echo '
      <div class="container">
      <div id ="ok" class="col-md-4">
     <p> </p>
        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
            <img src="galleryImage/'.$value["ImageName"].'" alt="'.$value["Description"].'" >     
        </a>
    </div>
    <div id ="ok" class="col-md-6">
    <p></p>
    <pre><strong>Leírás:</strong><br>'.$value["Description"].'</pre>
    </div>
    </div>';
    }}
    ?>
</div>
  <div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
    <div class="modal-content">
      <div class="modal-body">
        <img src="" alt="" /> <!-- this IMG tag receives dynamic image data/info -->
        <button class="button" data-dismiss="modal" type="button">
                  <i class="fas fa-times"></i>
                  Bezárás</button>
      </div>
    </div>
    </div>
  </div>
  <!-- scripts -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
    var $lightbox = $('#lightbox');
    
    $('[data-target="#lightbox"]').on('click', function(event) {
        var $img = $(this).find('img'), 
            src = $img.attr('src'),
            alt = $img.attr('alt'),
            css = {
                'maxWidth': $(window).width()-50,
                'maxHeight': $(window).height()-50,
                'marginTop': 50,
                'marginBottom': 50,
            };
    
        $lightbox.find('.close').addClass('hidden');
        $lightbox.find('img').attr('src', src);
        $lightbox.find('img').attr('alt', alt);
        $lightbox.find('img').css(css);
    });
    
    $lightbox.on('shown.bs.modal', function (e) {
        var $img = $lightbox.find('img');
          
        $lightbox.find('.modal-dialog').css({'width': $img.width()});
        $lightbox.find('.close').removeClass('hidden');
    });
});
    </script>