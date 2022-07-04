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

function display_info($horse)
{
    $horse_info = "";
    if ($horse->hma) {
        $horse_info .= '<h6 class="mt-0">HMA: ' . $horse->hma . '</h6>';
    }
    if ($horse->price) {
        $horse_info .= '<h6 class="mt-0">Adoption Fee: $' . $horse->price. '</h6>';
    }
    if ($horse->height) {
        $horse_info .=  "<h6 class=mt-0'>HANDS: ". $horse->height."</h6>";
    }
    if ($horse->weight) {
        $horse_info .=  "<h6 class=mt-0'>WEIGHT: ". number_format($horse->weight, 0,'.',',') . " lbs</h6>";
    }
    if ($horse->weight) {
        $horse_info .=  "<p class='mt-0' style=' font-size:10px; position:absolute; bottom:10%; left:3%;'>LAST UPDATED: $horse->exam_date</p>";
    }
    return $horse_info;
}

?>

<head>
    <title>Rocking-MJ-RANCH</title>
</head>
<div class="container justify-content-center  p-3">
    <?php if (filter_var($_GET['for_sale'], FILTER_VALIDATE_BOOLEAN)) : ?>
        <div class="text-center transparent-card-background ">
            <h1 class="fancy_font" style="font-size: 3em;">Available For Adoption</h1>
        </div>
    <?php else : ?>
        <div class="text-center transparent-card-background ">
            <h1 class='fancy_font' style="font-size: 3em;">Have You Heard About Our Herd?</h1>
        </div>
    <?php endif ?>

    <div class='animate__animated animate__fadeIn row  mt-4  align-items-center'>
        <?php foreach ($horses as $horse) : ?>
            <?php $image = Image::get_horse_images($conn, $horse->id); $horse->getMedical($conn); ?>
            <div class="card col-lg-3 mb-3 ms-5 p-4 transparent-card-background">
                <div class='container' style='max-height:95%;'>
                    <div class='container' style='height:25%'>
                        <?php if ($image) : ?>
                            <img class='card-img' src="../images/horses/<?= $horse->name ?>/<?= $image[rand(0,count($image)-1)]['url'] ?>" style='max-height:100%; width:auto;' />
                        <?php endif ?>
                    </div>
                    <div class=' p-3' style="">
                        <h5><?= $horse->name ?></h5>
                        <h6 class="mt-0">AGE: <?= date('Y') - $horse->year_foaled ?></h6>
                        <h6 class="mt-0">GENDER: <?= $horse->gender ?></h6>
                        <h6 class="mt-0">BREED: <?= substr($horse->breed, 0, 16) ?></h6>                                            
                        <?= display_info($horse) ?>
                        
                        
                    </div>

                    <a href="horse_page.php?id=<?= $horse->id ?>" class="btn horse_card" style="position:absolute; bottom:5%; left:3%; width:95%;">More
                        Info</a>

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