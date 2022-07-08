<?php
require '../includes/init.php';
require '../includes/access.php';

$conn = require '../includes/database.php';
$horse = Horse::getHorseById($_GET['id'], $conn);
$training_notes = Training::get_notes($conn);
$horse_training_ids = array_column($horse->get_training_notes($conn), 'id');

if (!$horse) {
    die("Horse not found");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notes = $_POST['training_notes'] ?? [];  
    $updated_horse = Horse::getHorseFromForm($_POST);
    Training::add_notes($conn,$notes,$updated_horse->id,$horse_training_ids);


    $errors = $updated_horse->errors;
    if (empty($errors)) {
        $updated_horse->updateHorse($conn);
        Url::redirect("/horse_page.php?id=$horse->id");
    }
}
?>

<head>
    <title>Update <?= $horse->name ?></title>
</head>

<body>

<ul class="nav w-75 mx-auto mt-3">
            <li class="nav-item ">
            <a id="upload_widget" class="btn btn-primary cloudinary-button " href="add_image.php?id=<?=$_GET['id']?>">Add Image</a>
            </li>
            <li class="nav-item  ">
                <a class="nav-link btn btn-secondary active" aria-current="page" href="add_medical_record.php?id=<?= $horse->id ?>&page=1">Medical</a>
            </li>

        </ul>
    <form class="w-75 mx-auto mt-2 border border-2 shadow-lg rounded p-3" method="post">
        <h1><?= $horse->name ?></h1>
       
        <!-- General Information -->

        <div class='row'>
            <div class="mb-3 col-lg-4">
                <label for="horse_name" class="form-label">Name</label>
                <input type="text" class="form-control" name="horse_name" value='<?= htmlspecialchars($horse->name) ?>'>
            </div>
            <div class="mb-3 col-lg-4">
                <label for="horse_breed" class="form-label">Breed</label>
                <input type="text" class="form-control" name="horse_breed" value='<?= htmlspecialchars($horse->breed) ?>'>
            </div>
            <div class="mb-3 col-lg-4">
                <label for="horse_brand" class="form-label">Brand</label>
                <input type="text" class="form-control" name="horse_brand" value='<?= htmlspecialchars($horse->brand) ?>'>
            </div>
            <div class="mb-3 col-lg-4">
                <label for="horse_gender" class="form-label">Gender</label>
                <input type="text" class="form-control" name="horse_gender" value='<?= htmlspecialchars($horse->gender) ?>'>
            </div>
            <div class="mb-3 col-lg-4">
                <label for="hma" class="form-label">HMA</label>
                <input type="text" class="form-control" name="hma" value='<?= htmlspecialchars($horse->hma) ?>'>
            </div>
            <div class="mb-3 col-lg-4">
                <label for="horse_year" class="form-label">Year Foaled</label>
                <input type="text" class="form-control" name="horse_year" value=<?= htmlspecialchars($horse->year_foaled) ?>>
            </div>
            <div class="mb-3 col-lg-4">
                <label for="horse_price" class="form-label">Price</label>
                <input type="number" step="any" class="form-control" name="horse_price" value=<?= htmlspecialchars($horse->price) ?>>
            </div>

            <div class="form-floating">
                <textarea class="form-control" name="horse_bio" style="height: 100px"><?= htmlspecialchars($horse->bio) ?></textarea>
                <label for="horse_bio">Bio</label>
            </div>
            <fieldset class='container row'>
                <legend>Training Accomplishments</legend>
                <?php foreach ($training_notes as $note) : ?>
                    <div class='col-lg-4'>
                        <input type="checkbox" name="training_notes[]" value="<?= $note['id'] ?>" id="<?= $note['id'] ?>" <?php if (in_array($note['id'], $horse_training_ids)) : ?>checked<?php endif; ?> />
                        <label for="<?= $note['id'] ?>"><?= htmlspecialchars($note['description']) ?></label>
                    </div>

                <?php endforeach ?>
            </fieldset>
            <div class='row mt-3 justify-content-center'>
                <div class='col-lg-4 me-auto mb-2'>
                    <button type='submit' class='btn btn-primary w-100'>Update</button>
                </div>

                <div class='col-lg-4 ms-auto mb-3'>
                    <a class='btn btn-warning w-100' href="/horse_page.php?id=<?= $horse->id ?>">Cancel</a>
                </div>
                <div class='col-lg-4 ms-auto mb-3'>
                    <a class='btn btn-danger w-100 delete' href="delete_horse.php?id=<?= $horse->id ?>">Delete</a>
                </div>
            </div>
        </div>

    </form>





    <?php require "../includes/footer.php" ?>