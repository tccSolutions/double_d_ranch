<?php
require '../includes/init.php';
require '../includes/access.php';

$conn = require '../includes/database.php';
$horse = Horse::getHorseById($_GET['id'], $conn);
$images = Image::get_horse_images($conn, $horse->id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    $image = new Image();

    $cloud_image = CloudImage::upload($_FILES["horse_image"]["tmp_name"], $horse);

    $image->comment = $_POST['comment'];
    $image->public_id = $cloud_image["public_id"];
    $image->url = $cloud_image["secure_url"];
    $image->horse_id = $horse->id;

    Image::upload_image($conn, $image);
    Url::redirect("/admin/images.php?id=$_GET[id]");
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

?>

<body>
  <?php require '../includes/admin_nav.php' ?>
  <ul class="nav w-75 mx-auto mt-3 form_container">
    <li class="nav-item ">
      <a id="" class="nav-link btn " href="/admin/update_horse_form.php?id=<?= $horse->id ?>">General Info</a>
    </li>   
    <li class="nav-item  ">
      <a class="nav-link btn " aria-current="page" href="add_medical_record.php?id=<?= $horse->id ?>&page=1">Medical</a>
    </li>

  </ul>
  <div class="form_container">
    <form class=" mx-auto w-75 mt-3 border border-1" method='post' action="" enctype="multipart/form-data">
      <div class="mb-3 col-auto">
        <label for="comment" class="form-label">Comment</label>
        <input type="text" class="form-control" id="comment" name='comment' placeholder="comment">
      </div>
      <div class="mb-3 col-auto">
        <label for="formFile" class="form-label">Select An Image</label>
        <input class="form-control" type="file" id="formFile" name='horse_image' required>
      </div>
      <div class="col-auto">
        <button id="image_btn" type="submit" class="btn btn-primary mb-3 loading">Upload</button>
      </div>
    </form>


    <div class='container row mx-auto justify-content-around '>
      <?php foreach ($images as $image) : ?>
        <div class='col-lg-3 text-center border border-3 m-3 me-auto'>
          <img src="<?= $image["url"] ?>" alt="" style="height:150px; max-width:auto;">
          <a class='btn btn-danger w-100 mt-1' href="/admin/delete_image.php?public_id=<?= $image['public_id'] ?>">
            DELETE
          </a>
        </div>

      <?php endforeach ?>

    </div>
  </div>

  <?php require "../includes/footer.php" ?>