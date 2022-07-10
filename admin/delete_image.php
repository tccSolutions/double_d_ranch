<?php
require '../includes/init.php';
require '../includes/access.php';
$conn = require '../includes/database.php';

$image = Image::getImageByPublicId($conn, $_GET['public_id']);


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if( CloudImage::delete($image->public_id)["result"] =="ok"){
        if(Image::deleteImage($conn, $image)){
            Url::redirect("admin/images.php?id=$image->horse_id");
        }
    }
    
   
}
?>

<body>
    <form class="p-5 position-absolute top-50 start-50 translate-middle transparent-card-background text-center "  method='post'>
        <h1>ARE YOU SURE?!? THIS CANNOT BE UNDONE!</h1>
        <button class='btn btn-danger w-75'>DELETE IMAGE</button>
    </form>