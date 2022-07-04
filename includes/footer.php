<?php if (!empty($errors)) : ?>
        <ul class='fixed-top mt-5 errors'>
            <?php foreach ($errors as $error) : ?>
                <li>
                    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                       <?= $error?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
</body>
</html>

