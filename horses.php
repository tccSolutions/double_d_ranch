<?php

require 'includes/init.php';


$conn = $conn = require 'includes/database.php';
$fetched_horses = Horse::getAll($conn);
$horses = [];
foreach ($fetched_horses as $horse) {
    if (!filter_var($_GET['for_sale'], FILTER_VALIDATE_BOOLEAN) && $horse['price'] <= 0) {
        $horses[] = Horse::getHorseById($horse['id'], $conn);
    } elseif (filter_var($_GET['for_sale'], FILTER_VALIDATE_BOOLEAN) && $horse['price'] > 0) {
        $horses[] = Horse::getHorseById($horse['id'], $conn);
    }   
}
foreach($horses as $horse){
   
}

require 'includes/horse_info.php';

?>

<head>
    <title>DD RANCH</title>
</head>
<div class="container justify-content-center  p-3 transparent-card-background">
    <?php if (filter_var($_GET['for_sale'], FILTER_VALIDATE_BOOLEAN)) : ?>
        <div class="text-center">
            <h1 class="fancy_font" style="font-size: 3em;">Available For Adoption</h1>
        </div>
    <?php else : ?>
        <div class="text-center  ">
            <h1 class='fancy_font' style="font-size: 3em;">Have You Heard About Our Herd?</h1>
        </div>
    <?php endif ?>

    <div class='animate__animated animate__fadeIn row  mt-4  align-items-center '>
        <?php foreach ($horses as $horse) : ?>
            <?php $image = Image::get_horse_images($conn, $horse->id); ?>
            <div class=" col-lg-12  p-4  border-bottom border-2">
                <div class='row ' style='max-height:95%;'>
                    <div class='col-lg-4 border-end ' style='height:25%'>
                        <?php if ($image) : ?>
                            <img class='card-img border align-self-center mx-auto d-block ' src="../images/horses/<?= $horse->name ?>/<?= $image[rand(0, count($image) - 1)]['url'] ?>" style="max-height:200px; width:auto;"> 
                            <?php else: ?>
                                <img class='card-img border mx-auto d-block ' src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiS3MmvVPFAxK8KYzeh1OSHxgdJkVdnWOXRg&usqp=CAU" style='max-width:100px;'/>
                        <?php endif ?>
                        <a href="horse_page.php?id=<?= $horse->id ?>" class="btn btn-warning horse_card w-100 mt-3" style="">More Info</a>
                    </div>
                    <div class="col-lg-8">
                        <h5><?= $horse->name ?></h5>
                        <h6 class="mt-0">AGE: <?= date('Y') - $horse->year_foaled ?></h6>
                        <h6 class="mt-0">GENDER: <?= $horse->gender ?></h6>
                        <h6 class="mt-0">BREED: <?= substr($horse->breed, 0, 16) ?></h6>
                        <?= display_info($horse, $conn) ?>
                    </div>                   
                </div>
                <div>
                    <h5><?= $horse->bio?></h5>
                </div>
               
            </div>


        <?php endforeach ?>
        <?php if (!Auth::unauthorized()) : ?>
            <div class=" card col-lg-3 mb-3 ms-5 p-2 transparent-card-background " style="width:18rem; height:35rem;">
                <div class=' p-3' style="width:100%;height: 100%;">
                    <div class='mx-auto mt-5 border border-5 rounded' style="width:50%;">
                        <a class="btn btn-success " style="height:100% ;" href='admin/horse_form.php'>ADD NEW HORSE</a>
                    </div>
                </div>
            </div>
        <?php endif ?>

    </div>
    <?php require 'includes/footer.php' ?>