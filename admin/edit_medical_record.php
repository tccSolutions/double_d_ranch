<?php
require '../includes/init.php';
require '../includes/access.php';

$conn = require '../includes/database.php';
$record = Medical::getHorseMedicalById($conn, $_GET['id']);


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    Medical::updateRecord($conn, $record['id'], $_POST);

    Url::redirect("admin/edit_medical_record.php?id=$record[id]");
}
?>


    <?php require '../includes/admin_nav.php' ?>
    <ul class="nav w-75 mx-auto mt-3 form_container">
        <li class="nav-item ">
            <a class="nav-link btn " href="/admin/update_horse_form.php?id=<?= $record['horse_id'] ?>">General Info</a>
        </li>
        <li class="nav-item ">
            <a id="" class="nav-link btn " href="images.php?id=<?= $record['horse_id'] ?>">Images</a>
        </li>

    </ul>
    <form class="w-75 mx-auto mt-2 border border-2 shadow-lg rounded p-3 form_container" method="post">

        <div>
            <h1><?= $record['name'];
                $record["date"] ?></h1>
            <h3><?= date('M d, Y', strtotime($record["date"])); ?></h3>
        </div>


        <!-- General Information -->

        <div class='row'>
            <input name='date' value=<?= $record['date'] ?> hidden>
            <input name='horse_id' value=<?= $record['horse_id'] ?> hidden>
            <?php foreach ($record as $field => $value) : ?>
                <?php if ($field == "id" || $field == "date" || $field == "coggins" || $field == "wormed" || $field =='vaccinated' || $field == "horse_id" || $field == "notes") : ?>
                <?php else : ?>

                    <div class="mb-3 col-lg-4">
                        <label for="<?= $field ?>" class="form-label"><?= strtoupper($field) ?></label>
                        <input type="text" class="form-control" name="<?= $field ?>" value='<?= htmlspecialchars($value) ?>'>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
            <div class='col-lg-2 d-flex align-items-center justify-content-between'>
                <div class="mb-3 ms-1 col-lg-2">
                    <label for="coggins" class="form-check-label">Coggins</label>
                    <input type="checkbox" id='coggins' class="form-check-input" name="coggins" <?php if ($record['coggins'] == 1) : ?> checked <?php endif ?>>
                </div>
                <div class="mb-3 ms-5 col-lg-2 ">
                    <label for="wormed" class="form-check-label">Wormed</label>
                    <input type="checkbox" id='wormed' class="form-check-input" name="wormed" <?php if ($record['wormed'] == 1) : ?> checked <?php endif ?>>
                </div>
                <div class="mb-3 ms-5 col-lg-2 ">
                <label class="form-check-label" for="vaccinaed">Vaccinated</label>
                    <input type="checkbox" class="form-check-input" id="vaccinated" name='vaccinated' <?php if ($record['vaccinated'] == 1) : ?> checked <?php endif ?>>                    
                </div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Notes" id="floatingTextarea" name='notes' value='<?= $record['notes'] ?>' style="height: 300px"></textarea>
                <label for="floatingTextarea">Notes</label>
            </div>
            <div class='row mt-3 justify-content-center'>
                <div class='col-lg-4 me-auto mb-2'>
                    <button type='submit' class='btn btn-primary w-100 loading'>Update</button>
                </div>

                <div class='col-lg-4 ms-auto mb-3'>
                    <a class='btn btn-warning w-100' href="/admin/add_medical_record.php?id=<?= $record['horse_id'] ?>&page=<?= $_SESSION['page'] ?>">Cancel</a>
                </div>
                <div class='col-lg-4 ms-auto mb-3'>
                    <a class='btn btn-danger w-100 delete' href="/admin/delete_medical_record.php?id=<?= $record['id'] ?>">Delete</a>
                </div>
            </div>
        </div>

        </div>
    </form>

    <?php require '../includes/footer.php' ?>