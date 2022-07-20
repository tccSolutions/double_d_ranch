<?php
$conn = require '../includes/database.php';
$horses = Horse::getAll($conn);
?>

<div class='container border border-2 p-3 me-auto ms-0 mt-2' style="width:10em; position:fixed;">
    <h5>HORSES</h5>
    <div class='row col-lg-12 mb-2 loading'>
        <a class='btn btn-success' href="/admin/horse_form.php">+ Add Horse</a>
    </div>
    <?php foreach ($horses as $nav_horse) : ?>
        <div class='row col-lg-12 mb-2 loading'>
            <a class='btn btn-dark' href="/admin/update_horse_form.php?id=<?= $nav_horse['id'] ?>"><?= $nav_horse['name'] ?></a>
        </div>
    <?php endforeach ?>   
</div>



<script>
    $('document').ready(function() {
        $("body").css("background-image", "url('')");
    });
</script>