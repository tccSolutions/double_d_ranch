<?php if (!empty($errors)) : ?>
    <ul class='fixed-top mt-5 errors'>
        <?php foreach ($errors as $error) : ?>
            <li>
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>



<!-- JS -->
<script src="../js/script.js"></script>
</body>

</html>