<?php
include_once './gallery/galleryClass.php';
$galleryClass=new galleryClass();
$galleryList=$galleryClass->listGallery();
?>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
<link rel="stylesheet" href="//bootsnipp.com/dist/bootsnipp.min.css">
<?php
include_once './inc/header.php';
if(isset($_POST["submit"])){
    $getImage= basename($_FILES["Image"]["name"]);
    if($getImage==""){
        echo "Kérlek válassz képet.";
    }
    else
    {
        $target="../galleryImage/";
        $ran=time();
        $target=$target.$ran.$getImage;
        $imageName=$ran.$getImage;
        $description = $_POST['Text'];
        if($_FILES["Image"]["type"]=="image/jpg"||$_FILES["Image"]["type"]=="image/jpeg"){
            move_uploaded_file($_FILES["Image"]["tmp_name"], $target);
            if(move_uploaded_file){
                include_once './gallery/galleryClass.php';
                $galleryClass=new GalleryClass();
                $galleryClass->uploadGallery($imageName,$description);
            }
            else
            {
                echo "A képet nem sikerült feltölteni. ";
            }
        }
        else
        {
            echo "JPG vagy JPEG képet tölts fel.";
        }
    }
}
if(isset($_POST["delete"])){
  $target="../galleryImage/";
  $imageName = $_POST['Text2'];
  include_once './gallery/galleryClass.php';
  $galleryClass=new GalleryClass();
  $galleryClass->deleteGallery($imageName);
  unlink($target.$imageName);
}
if(isset($_POST["update"])){
  $description = $_POST['Text3'];
  $imageName = $_POST['Text4'];
  include_once './gallery/galleryClass.php';
  $galleryClass=new GalleryClass();
  $galleryClass->updateGallery($imageName,$description);
}
if(isset($_POST["deleteAll"])){
  include_once './gallery/galleryClass.php';
  $galleryClass=new GalleryClass();
  $galleryClass->deleteAllGallery();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Jolenne</title>
  </head>
  <style>
input[type=text], select {
  width: 60%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 30%;
  background-color: #fec810;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=file] {
  width: 60%;
  color: black;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
  <body>
  <br>
  <a style="text-align: center;font-size: 20px;"  href="https://www.jolenne.hu" class="nav-link"><strong> - Kijelentkezés -</strong></a>
    <div class="container">
      <!-- Example row of columns -->
      <div class="col-md-5">
      <div class="masthead">
        <h3 class="text-muted" style="text-align: center;"> --- Kép feltöltése ---</h3>
      </div>
          <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
              <div class="form-group">
                  <label><strong>Válassz képet</strong></label><br>
                  <input type="file" name="Image" id="Image" value="" class="form-control">
                  <p></p><label><strong>Leírás</strong></label><p></p>
                  <textarea class="form-control" rows="10" cols="50" class="form-control col-md 16" id="Text"  name="Text" placeholder="Leírás *    " required="required" data-validation-required-message="Kérem írja meg az elképzelését."></textarea>
                  <!-- <input type="text" name="Text" id="Text" value="" class="form-control"> -->
              </div>
              <br>
              <!-- <button id="submit" name="submit" type="Submit" class="btn btn-primary">Kép feltöltése</button> -->
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit"  class="btn btn-success btn-block"  value="Kép feltöltése" />
          </form>
      <div class="masthead">
        <h3 class="text-muted" style="text-align: center;"> --- Kép törlése ---</h3>
      </div>
          <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
              <div class="form-group">
                  <p></p><label><strong>A kép neve</strong></label><p></p>
                   <input type="text" name="Text2" id="Text2" value="" required="required" class="form-control"> <br>
                   <input name = "delete" type = "submit" class="btn btn-success btn-block" id = "delete" value = "Törlés">
              </div>
          </form>
      </div>
      <div class="col-md-5">
      <div class="masthead">
        <h3 class="text-muted" style="text-align: center;"> --- Összes kép törlése ---</h3>
      </div>
          <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
              <div class="form-group">
                   <input name = "deleteAll" type = "submit" class="btn btn-success btn-block" id = "deleteAll" value = "Összes kép törlése">
              </div>
          </form>
      <div class="masthead">
        <h3 class="text-muted" style="text-align: center;"> --- Kép leírás módosítása ---</h3>
      </div>
          <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
              <div class="form-group">
              <p></p><label><strong>Leírás</strong></label><p></p>
                  <textarea class="form-control" rows="10" cols="50" class="form-control col-md 16" id="Text3"  name="Text3" placeholder="Leírás *    " required="required" data-validation-required-message="Kérem írja meg az elképzelését."></textarea>
                  <br><br><p></p><label><strong>A kép neve</strong></label><p></p>
                   <input type="text" name="Text4" id="Text4" value="" required="required" class="form-control"> <br>
                   <input name = "update" type = "submit" class="btn btn-success btn-block" id = "update" value = "Módosítás">
              </div>
          </form>
      </div>
    </div>
   

    <div class="container">
    <?php
    if(count($galleryList)){
    foreach ($galleryList as $value) {
        echo '
      <div class="container">
      <div id ="ok" class="col-md-4">
     <p> </p>
        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
            <img src="../galleryImage/'.$value["ImageName"].'" alt="'.$value["Description"].'" >     
        </a>
    </div>
    <div id ="ok" class="col-md-6">
    <p></p>
    <pre><strong>Leírás:</strong><br>'.$value["Description"].'<br><strong>Kép:</strong>'.$value["ImageName"].'</pre>
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
      </div>
    </div>
    </div>
  </div>
  <!-- scripts -->

    <script>
    $(document).ready(function() {
    var $lightbox = $('#lightbox');
    
    $('[data-target="#lightbox"]').on('click', function(event) {
        var $img = $(this).find('img'), 
            src = $img.attr('src'),
            alt = $img.attr('alt'),
            css = {
                'maxWidth': $(window).width() - 200,
                'maxHeight': $(window).height() - 200,
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
    <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="http://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
  </body>
</html>
