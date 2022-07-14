<?php
function imageSelector($number)
{

    switch ($number) {
        case 0:
            return "../public/images/mbs/0.svg";
        case 1:
            return "../public/images/mbs/1.svg";
        case 2:
            return "../public/images/mbs/2.svg";
        case 3:
            return "../public/images/mbs/3.svg";
        case 4:
            return "../public/images/mbs/4.svg";
        case 5:
            return "../public/images/mbs/5.svg";
        case 6:
            return "../public/images/mbs/6.svg";
        case 7:
            return "../public/images/mbs/7.svg";
        case 8:
            return "../public/images/mbs/8.svg";
        case 9:
            return "../public/images/mbs/9.svg";
    }
}

?>
<?php if($horse->brand): ?>
<div class='container justify-content-center' style='max-width:75vw;overflow:hidden;'>
    <div class='d-flex justify-content-center align-items-center' >
        <div class='m-0 p-0' style="width:15%;">
            <img class='brand m-0 p-0' src="../public/images/mbs/US Government.svg" alt="" style="max-width: 100%;" >
        </div>
        <div class=' d-flex flex-column m-0' style="width:5%;">
            <?php foreach (str_split(substr($horse->brand, 0,2)) as $number) : ?>
                <img class='brand m-0' src="<?= imageSelector($number) ?>" alt="" style="max-width: 100%;" >
            <?php endforeach ?>
        </div>
        <div class='d-flex border-bottom border-5 m-0 ' style="width:33%;">
            <?php foreach (str_split(substr($horse->brand, 2)) as $number) : ?>
                <img class='brand m-0' src="<?= imageSelector($number) ?>" alt="" style="max-width: 18%;">
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php endif ?>