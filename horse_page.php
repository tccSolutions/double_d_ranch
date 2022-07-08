<?php
require "includes/init.php";

$conn = require 'includes/database.php';


$horse = Horse::getHorseById($_GET['id'], $conn);
$images = Image::get_horse_images($conn, $horse->id);
$training = $horse->get_training_notes($conn);


require 'includes/horse_info.php';
?>

<head>
    <title><?= $horse->name ?></title>
</head>
<section class='container-fluid p-2 row text-center justify-content-between  '>
    <?php if (!Auth::unauthorized()) : ?>
        <ul class="nav col-lg-6 mx-auto d-flex justify-content-center">
            <li>
                <a class='btn btn-secondary' href="/admin/update_horse_form.php?id=<?= $horse->id ?>">Update</a>
            </li>

        </ul>
    <?php endif ?>
    <section class='col-lg-12 justify-content-center d-flex transparent-card-background '>

        <div class='p-3 '>
            <?php if ($images) : ?>
                <img class='rounded border border-2' src="<?= $images[rand(0, count($images) - 1)]['url'] ?>" style=' max-height:150px; width:auto;' />
            <?php endif ?>
        </div>
        <div class='justify-content-start text-start'>
            <h5>Name:<?= $horse->name ?></h5>
            <h6 class="mt-0">Age: <?= date('Y') - $horse->year_foaled ?></h6>
            <h6 class="mt-0">Gender: <?= $horse->gender ?></h6>
            <h6 class="mt-0">Breed: <?= substr($horse->breed, 0, 16) ?></h6>
            <?= display_info($horse, $conn) ?>
        </div>
    </section>
    <section class='row col-lg-12 justify-content-center'>
        <div class=' animate__animated animate__fadeIn justify-content-center align-items-center transparent-card-background'>

        </div>

        <?php require 'includes/hr.php' ?>

        <div class='animate__animated animate__fadeIn animate__delay-1s row  mx-auto mt-5 transparent-card-background'>
            <h2>A Little Bit About <?= $horse->name ?></h2>
            <h3><?= $horse->bio ?></h3>
        </div>

        <?php require 'includes/hr.php' ?>
        <div class='animate__animated animate__fadeIn animate__delay-1s row mx-auto mt-5 transparent-card-background justify-content-center'>
            <h2>Training Accomplishments</h2>
            <ul class='w-50 text-start justify-content-center text-center '>
                <?php foreach ($training as $task) : ?>
                    <li class="mx-auto">
                        <h3 class='fancy_font'><?= $task['description'] ?></h3>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>

    </section>


    <?php require 'includes/hr.php' ?>


    <div class='animate__animated animate__fadeIn animate__delay-1s row mx-auto mt-5 container transparent-card-background'>
        <h2>Gallery</h2>
        <div class='row justify-content-center'>
            <?php foreach ($images as $image) : ?>
                <img class='transparent-background m-1 p-4 col-lg-4' src="<?= $image['url'] ?>" alt='horse_image' style="max-height:400px; width:auto;" />
            <?php endforeach ?>

        </div>
    </div>

</section>

<?php require 'includes/footer.php' ?>