<?php
require "includes/init.php";

$conn = require 'includes/database.php';


$horse = Horse::getHorseById($_GET['id'], $conn);
$images = Image::get_horse_images($conn, $horse->id);
$training= $horse->get_training_notes($conn);



?>

    <head>
        <title><?= $horse->name ?></title>
    </head>
    <section class='container-fluid text-center '>
        <section class='row col-lg-8'>

        </section>
        <div class=' animate__animated animate__fadeIn  justify-content-center align-items-center transparent-card-background'>           
            <h1 class="col-lg-12 mx-0 fancy_font" style="font-size: 5em;"><?= $horse->name ?></h1>
            <?php if (!Auth::unauthorized()): ?>
                <ul class="nav col-lg-6 mx-auto d-flex justify-content-center">
                    <li>
                        <a class='btn btn-secondary' href="/admin/update_horse_form.php?id=<?= $horse->id ?>">Update</a>
                    </li>
                   
                </ul>
            <?php endif ?>
        </div>

        <?php require 'includes/hr.php' ?>

        <div class='animate__animated animate__fadeIn animate__delay-1s row w-50 mx-auto mt-5 transparent-card-background'>
            <h2>A Little Bit About <?= $horse->name ?></h2>
            <h3><?= $horse->bio ?></h3>
        </div>

        <?php require 'includes/hr.php' ?>
        <div class='animate__animated animate__fadeIn animate__delay-1s row w-50 mx-auto mt-5 transparent-card-background justify-content-center'>
            <h2>Training Accomplishments</h2>
            <ul class='w-50 text-start'>
            <?php foreach($training as $task): ?>
                <li>
                    <h3 class='fancy_font'><?= $task['description'] ?></h3>
                </li>
                <?php endforeach ?>
            </ul>
        </div>

        <?php require 'includes/hr.php' ?>


        <div class='animate__animated animate__fadeIn animate__delay-1s row mx-auto mt-5 container transparent-card-background'>
            <h2>Gallery</h2>
            <div class='row justify-content-center'>
            <?php foreach($images as $image):?>
                <img class='transparent-background m-1 p-4'src="../images/horses/<?=$horse->name?>/<?=$image['url']?>" alt='horse_image' style="width:25%;"/>
            <?php endforeach ?>

            </div>           
        </div>

    </section>

<?php require 'includes/footer.php' ?>