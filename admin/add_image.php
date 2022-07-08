<?php
require '../includes/init.php';
require '../includes/access.php';

$conn = require '../includes/database.php';
$horse = Horse::getHorseById($_GET['id'], $conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $image = new Image();
  $image->comment = "";
  $image->public_id = $_POST['name'];
  $image->url = $_POST['url'];
  $image->horse_id = $horse->id;

  Image::upload_image($conn, $image);
  Url::redirect("/admin/add_image.php?id=$_GET[id]") ;
}

?>
<script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>

<body>

  <div id="url_div">

  </div>
<form id="image_form" method='post'>

</form>



  <script src="https://media-library.cloudinary.com/global/all.js"></script>



  <script type="text/javascript">
    window.ml = cloudinary.openMediaLibrary({
      cloud_name: 'dmobley0608',
      api_key: '172351854381963',
      username: 'dmobley0608@gmail.com',
      button_class: 'myBtn',
      button_caption: 'Insert Images',
      inline_container: '#url_div'
    }, {
      insertHandler: (data) => {
        data.assets.forEach(asset => {
          var form = document.getElementById('image_form');
          var div = document.getElementById('url_div');
          var url_input = document.createElement("input");
          url_input.name = "url";
          url_input.value = asset.secure_url;
          var name_input = document.createElement("input");
          name_input.name = "name";
          name_input.value = asset.public_id;
          
          form.appendChild(url_input)
          form.appendChild(name_input)
          form.submit();
          
        })
      }
    });

    window.ml.show();
  </script>