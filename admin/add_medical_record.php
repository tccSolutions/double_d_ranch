<?php
require '../includes/init.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $conn = require '../includes/database.php';
    Medical::addRecord($conn, $_POST);
    Url::redirect('../horse_page.php?id='.$_GET['id']);
}
?>

<body>
    <div class='container-fluid mt-3'>
        <form class='p-2' method='post'>
            <input type="text" name="horse_id" hidden  value="<?= $_GET['id'] ?>">

            <div class='row mb-3'>
                <div class="mb-3 col-lg-3 ">
                    <label class="form-check-label" for="type">Description</label>
                    <input type="text" class="form-control" id="type" name='type'>
                </div>
                <div class="mb-3 col-lg-3 ">
                    <label class="form-check-label" for="vet">Vet</label>
                    <input type="text" class="form-control" id="vet" name='vet'>
                </div>
                <div class="mb-3 col-lg-3 ">
                    <label class="form-check-label" for="height">Height</label>
                    <input type="text" class="form-control" id="height" name='height'>
                </div>
                <div class="mb-3 col-lg-3 ">
                    <label class="form-check-label" for="length">Length</label>
                    <input type="text" class="form-control" id="length" name='length'>
                </div>
                <div class="mb-3 col-lg-3 ">
                    <label class="form-check-label" for="girth">Girth</label>
                    <input type="text" class="form-control" id="girth" name='girth'>
                </div>
                <div class="mb-3 col-lg-3 ">
                    <label class="form-check-label" for="red_tape">Red Tape</label>
                    <input type="text" class="form-control" id="red_tape" name='red_tape'>
                </div>
                <div class="mb-3 col-lg-3 ">
                    <label class="form-check-label" for="black_tape">Black Tape</label>
                    <input type="text" class="form-control" id="black_tape" name='black_tape'>
                </div>

                <div class='col-lg-12 d-flex justify-content-start'>
                    <div class="form-check me-3">
                        <input type="checkbox" class="form-check-input" id="coggins" name='coggins'>
                        <label class="form-check-label" for="coggins">Coggins</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="wormed" name='wormed'>
                        <label class="form-check-label" for="wormed">Wormed</label>
                    </div>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" placeholder="Notes" id="floatingTextarea2" name='notes' style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Comments</label>
                </div>


            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <?php require '../includes/footer.php' ?>