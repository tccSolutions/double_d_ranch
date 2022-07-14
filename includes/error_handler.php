<?php if (!empty($errors)) : ?>
        <ul class='mt-1 w-100 container errors align-items-center'>
            <?php foreach ($errors as $error) : ?>
                <li class="row w-100  justify-content-center">
                    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                       <?= $error?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
<?php endif ?>