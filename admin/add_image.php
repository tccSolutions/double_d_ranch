<?php

require '../includes/init.php';
require '../includes/access.php';

$conn = require '../includes/database.php';
$horse = Horse::getHorseById($_GET['id'], $conn);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
   
    $image = new Image();
    $image->comment = $_POST['comment'];
    $image->url = $_FILES['url']['full_path'];
    $image->horse_id = $_POST['horse_id'];

    try{

        if(empty($_FILES)){
            throw new Exception("Upload Error");
        }

      

        switch($_FILES['url']['error']){
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No Image Selected');
                break;
            case UPLOAD_ERR_INI_SIZE:
                throw new Exception("File must be smaller than 10MB");
                break;
            default:
                    throw new Exception('An Error Occured');
        }
        $mime_types = ['image/jpeg', 'image/jpg', 'image/png'];
        $f_info = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($f_info, $_FILES['url']['tmp_name']);
        if(! in_array($mime_type, $mime_types)){
            throw new Exception("Invalid File Type");
        }
            $upload_dir = "../images/horses/$horse->name/";
            if(!is_dir($upload_dir)){                           
                mkdir($upload_dir);                
            }
            $destination = $upload_dir.$_FILES['url']['name'];
           
            if( move_uploaded_file( $_FILES['url']['tmp_name'], $destination) && Image::upload_image($conn, $image)){               
                Url::redirect("../admin/update_horse_form.php?id=".$_GET['id']);
            }
           
        }catch (Exception $e){
           $message = $e->getMessage();
           echo "<h1 class='transparent-card-background text-center'>$message</h1>";
        }

    
}

?>
<body>
<!-- Upload Images -->

    <form class="w-75 mx-auto mt-5 border border-2 shadow-lg rounded p-3 mb-3" method="post" enctype="multipart/form-data">
        <h2>Upload Images for <?=$horse->name?></h2>
        <div class="mb-3">
            <input type="number" class="form-control" id="horse_id" name="horse_id" value=<?= $horse->id ?> hidden>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <input type="text" class="form-control" id="comment" name='comment' placeholder="Comment">
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Select An Image</label>
            <input class="form-control" type="file" id="url" name="url">
        </div>
        <div class='col-lg-4 me-auto mb-2'>
            <div class="row mt-3 justify-content-center">
                <div class='col-lg-4 ms-auto mb-3'>
                    <button type='submit' class='btn btn-primary w-100'>Add Image</button>
                </div>

                <div class='col-lg-4 ms-auto mb-3'>
                    <a class='btn btn-warning w-100' href="update_horse_form.php?id=<?= $horse->id ?>">Cancel</a>
                </div>
            </div>

    </form>