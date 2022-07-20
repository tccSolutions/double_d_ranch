<?php
require '../includes/init.php';
require '../includes/access.php';

$conn = require '../includes/database.php';
$horse = Horse::getHorseById($_GET['id'], $conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($horse->deleteHorse($conn)) {
        Url::redirect('/admin/home.php');
    };
}

?>

<div class='container transparent-card-background position-absolute top-50 start-50 translate-middle text-center p-5'>
    <h1>DELETE HORSE</h1>
    <h6>****THIS CANNOT BE UNDONE! BE SURE YOU WANT TO DELETE THIS RECORD!*****</h6>
    <form class='col-lg-4 ms-auto mb-2 mt-3 w-50 mx-auto' method='post'>
        <div class='row justify-content-center'>
            <div class='col-lg-4 me-auto'>
                <button type="submit" class='btn btn-danger w-100'>DELETE</button>
            </div>
            <div class='col-lg-4 ms-auto'>
                <a href="/admin/update_horse_form.php?id=<?= $horse->id ?>" class='btn btn-warning w-100'>RETURN</a>
            </div>
        </div>

    </form>
</div>

<?php require '../includes/footer.php' ?>
