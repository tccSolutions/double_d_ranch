<?php
require '../includes/init.php';
require '../includes/access.php';

$conn = require '../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $horse = Horse::getHorseFromForm($_POST);
    if(empty($horse->errors)){
        Horse::addHorse($_POST, $conn);
        Url::redirect('/horse_page.php?id=' . $conn->lastInsertId());
    }else{
        $errors[] = $horse->errors;
    }
  
}

?>

<head>

    <title>Add Horse</title>
</head>

<body>
    <form class="w-75 mx-auto mt-5 border border-2 shadow-lg rounded p-3" method="post">
        <div class='row'>
            <div class="mb-3 col-lg-4">
                <label for="horse_name" class="form-label">Name</label>
                <input type="text" class="form-control" name="horse_name">
            </div>
            <div class="mb-3 col-lg-4">
                <label for="horse_breed" class="form-label">Breed</label>
                <input type="text" class="form-control" name="horse_breed">
            </div>
            <div class="mb-3 col-lg-4">
                <label for="horse_brand" class="form-label">Brand</label>
                <input type="text" class="form-control" name="horse_brand">
            </div>
            <div class="mb-3 col-lg-4">
                <label for="horse_gender" class="form-label">Gender</label>
                <input type="text" class="form-control" name="horse_gender">
            </div>
            <div class="mb-3 col-lg-4">
                <label for="hma" class="form-label">Herd Management Area</label>
                <input type="text" class="form-control" name="hma">
            </div>
            <div class="mb-3 col-lg-4">
                <label for="horse_year" class="form-label">Year Foaled</label>
                <input type="text" class="form-control" name="horse_year">
            </div>
            <div class="mb-3 col-lg-4">
                <label for="horse_price" class="form-label">Price</label>
                <input type="number" class="form-control" name="horse_price">
            </div>

            <div class="form-floating">
                <textarea class="form-control" name="horse_bio" style="height: 100px"></textarea>
                <label for="horse_bio">Bio</label>
            </div>
            <div class='row mt-3'>

                <div class='col-lg-4 me-auto'>
                    <button type='submit' class='btn btn-primary w-100'>Submit</button>
                </div>

                <div class='col-lg-4 ms-auto'>
                    <a class='btn btn-danger w-100' href="../horses.php">Cancel</a>
                </div>
            </div>
        </div>
    </form>
    <?php require "../includes/footer.php" ?>