<?php
require '../includes/init.php';
require '../includes/access.php';

$conn = require '../includes/database.php';
$horse = Horse::getHorseById($_GET['id'], $conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image = new Image();
    $image->comment = $_POST['comment'];
    $image->public_id = $_POST['name'];
    $image->url = $_POST['url'];
    $image->horse_id = $_POST['horse_id'];

    Image::upload_image($conn, $image);
    Url::redirect("/admin/update_horse_form.php?id=$_GET[id]");
}

?>

<body>
    <!-- Upload Images -->

    <form id='image_form' class="w-75 mx-auto mt-5 border border-2 shadow-lg rounded p-3 mb-3" method="post" enctype="multipart/form-data">
        <h2>Upload Images for <?= $horse->name ?></h2>
        <div class="mb-3">
            <input type="number" class="form-control" id="horse_id" name="horse_id" value=<?= $horse->id ?> hidden>
        </div>
        <div id="url_div">

        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <input type="text" class="form-control" id="comment" name='comment' placeholder="Comment">
        </div>
        <button type='button' id="upload_widget" class="cloudinary-button">Choose Image</button>



    </form>
    <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>  

<script type="text/javascript">  
var myWidget = cloudinary.createUploadWidget({
  cloudName: 'dmobley0608', 
  uploadPreset: 'ulgvzhv6',
  public_id:"double_d_ranch/<?=$horse->name?>/<?=$_SERVER['REQUEST_TIME']?>",
  showAdvancedOptions: true,
  cropping: true,
  context:{caption:""}
  }, (error, result) => { 
    if (!error && result && result.event === "success") {
       
        var form = document.getElementById('image_form');
        var div = document.getElementById('url_div');
        var url_input = document.createElement("input");
        url_input.name = "url";
        url_input.value =  result.info.secure_url;
        var name_input = document.createElement("input");
        name_input.name = "name";
        name_input.value =  result.info.public_id;
        url_div.appendChild(url_input)
        url_div.appendChild(name_input)        
       form.submit(); 
      
    }
  }
)

document.getElementById("upload_widget").addEventListener("click", function(){
    myWidget.open();
  }, false);
</script>