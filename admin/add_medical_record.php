<?php
require '../includes/init.php';
require '../includes/access.php';

$conn = require '../includes/database.php';
$paginator = new Paginator($_GET['page'] ?? 1, 5);
$_SESSION['page'] = $_GET['page'];

$medical_records = Medical::getMedicalRecords($conn, $paginator->limit, $paginator->offset, $_GET['id']);
if ($medical_records) {
    $record_length = count(Medical::getHorseRecords($conn, $medical_records[0]['horse_id']));
} else {
    $record_length = 0;
}


$today = date('Y-m-d');


$max_page_number = count($medical_records) - $paginator->records_per_page;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    Medical::addRecord($conn, $_POST);
    Url::redirect("/admin/add_medical_record.php?id=$_GET[id]&page=1");
}
?>
<?php require '../includes/admin_nav.php' ?>
<ul class="nav w-75 mx-auto mt-3 form_container">
    <li class="nav-item ">
        <a class="nav-link btn " href="/admin/update_horse_form.php?id=<?= $_GET['id'] ?>">General Info</a>
    </li>
    <li class="nav-item ">
        <a id="" class="nav-link btn " href="images.php?id=<?= $_GET['id'] ?>">Images</a>
    </li>

</ul>

<div class='container-fluid mt-3 justify-content-center'>
    <table id="medical_table" class=' w-75 table table-dark mx-auto'>

        <thead>
            <td class='text-center' colspan="12">
                <h5>MEDICAL HISTORY</h5>
            </td>
        </thead>
        <thead>
            <td>Date</td>
            <td>Name</td>
            <td>Type</td>
            <td class='medical_hidden'>Height</td>
            <td class='medical_hidden'>Length</td>
            <td class='medical_hidden'>Girth</td>
            <td class='medical_hidden'>Red Tape</td>
            <td class='medical_hidden'>Black Tape</td>
            <td class='medical_hidden'>Wormed</td>
            <td class='medical_hidden'>Coggins</td>
            <td class='medical_hidden'>Vaccinated</td>
            <td></td>
            
        </thead>
        <tbody>
            <?php foreach ($medical_records as $record) : ?>
                <tr>
                    <td><?= date("M d, Y", strtotime($record['date'])) ?></td>
                    <td><?= $record['name'] ?></td>
                    <td><?= $record['type'] ?></td>
                    <td class='medical_hidden'><?= $record['height'] ?></td>
                    <td class='medical_hidden'><?= $record['length'] ?></td>
                    <td class='medical_hidden'><?= $record['girth'] ?></td>
                    <td class='medical_hidden'><?= $record['red_tape'] ?></td>
                    <td class='medical_hidden'><?= $record['black_tape'] ?></td>
                    <td class='medical_hidden' style='color:white;'><?= ($record['wormed'] == 1) ? "&check;" : "" ?></td>
                    <td class='medical_hidden'><?= ($record['coggins'] == 1) ? "&check;" : "" ?></td>
                    <td class='medical_hidden'><?= ($record['vaccinated'] == 1) ? "&check;" : "" ?></td>
                    <td><a class='btn btn-secondary' href="edit_medical_record.php?id=<?= $record['id'] ?>">EDIT</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <ul class='pagination mx-auto w-75 justify-content-center'>
        <li class="page-item"><a class="page-link" href="add_medical_record.php?id=<?= $_GET['id'] ?>&page=<?php echo ($_GET['page'] <= 1) ? 1 : $_GET['page'] - 1 ?>">Previous</a></li>
        <?php for ($i = 1; $i <= $record_length / 5; $i++) : ?>
            <li class="page-item"><a class="page-link" href="add_medical_record.php?id=<?= $_GET['id'] ?>&page=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor ?>
        <?php if ($max_page_number < 0 || $record_length % $_SESSION['page'] == 0 && $_SESSION['page'] != 1) : ?>
            <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
        <?php else : ?>
            <li class="page-item"><a class="page-link" href="add_medical_record.php?id=<?= $_GET['id'] ?>&page=<?= $_GET['page'] + 1 ?>">Next</a></li>
        <?php endif ?>
    </ul>



</div>
<div class='container-fluid mt-3'>

    <form class='p-2 w-75 mx-auto' method='post'>
        <div class='w-75 text-center mx-auto'>
            <h3>Add Record</h3>
        </div>
        <input type="text" name="horse_id" hidden value="<?= $_GET['id'] ?>">

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
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="vaccinated" name='vaccinated'>
                    <label class="form-check-label" for="vaccinaed">Vaccinated</label>
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