<?php
require '../includes/init.php';
require '../includes/access.php';

$conn = require '../includes/database.php';
$horse = Horse::getHorseById($_GET['id'], $conn);
$images = Image::get_horse_images($conn, $horse->id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try{
    $image = new Image();
   
    $cloud_image = CloudImage::upload($_FILES["horse_image"]["tmp_name"], $horse);
   
    $image->comment = $_POST['comment'];
    $image->public_id = $cloud_image["public_id"];
    $image->url = $cloud_image["secure_url"];
    $image->horse_id = $horse->id;

    Image::upload_image($conn, $image);
    Url::redirect("/admin/add_image.php?id=$_GET[id]");
  }catch(Exception $e){
      echo $e->getMessage();
    }
}

?>

<body>

  <form id="image_form" class=" mx-auto w-75 mt-3 border border-1" method='post' action="" enctype="multipart/form-data">
    <div class="mb-3 col-auto">
      <label for="comment" class="form-label">Comment</label>
      <input type="text" class="form-control" id="comment" name='comment' placeholder="comment">
    </div>
    <div class="mb-3 col-auto">
      <label for="formFile" class="form-label">Select An Image</label>
      <input class="form-control" type="file" id="formFile" name='horse_image' required>
    </div>
    <div class="col-auto">
      <button id=image_btn type="submit" class="btn btn-primary mb-3">Upload</button>
    </div>
  </form>

  <div id="loading_div" class="position-absolute top-50 start-50 translate-middle text-center">
    <img class="" src="../images/uploading.gif" alt="">
  </div>
  <div class='container row mx-auto justify-content-center'>
    <?php foreach ($images as $image) : ?>
      <div class='col-lg-3 text-center border border-3 m-1'>
        <img src="<?= $image["url"] ?>" alt="" style="height:150px; max-width:auto;">
        <a class='btn btn-danger w-100 mt-1' href="/admin/delete_image.php?public_id=<?=$image['public_id']?>">
          DELETE
        </a>
      </div>

    <?php endforeach ?>

  </div>



  <script>
    $('#loading_div').hide();

    $("#image_btn").on("click", function(event) {

      if ($('#formFile')[0].files.length > 0) {
        $("#loading_div").show();
        $("#image_form").hide()
      }

    })
  </script>
