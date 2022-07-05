<?php
function display_info($horse, $conn)
{
    $horse->getMedical($conn);
    $horse_info = "";
    if ($horse->hma) {
        $horse_info .= '<h6 class="mt-0">HMA: ' . $horse->hma . '</h6>';
    }
    if ($horse->price) {
        $horse_info .= '<h6 class="mt-0">Adoption Fee: $' . $horse->price . '</h6>';
    }
    if ($horse->height) {
        $horse_info .=  "<h6 class=mt-0'>HANDS: " . $horse->height . "</h6>";
    }
    if ($horse->weight) {
        $horse_info .=  "<h6 class=mt-0'>WEIGHT: " . number_format($horse->weight, 0, '.', ',') . " lbs</h6>";
    }
    if ($horse->weight) {
        $horse_info .=  "<p class='mt-0' style=' font-size:10px; position:absolute; bottom:10%; left:3%;'>LAST UPDATED: $horse->exam_date</p>";
    }
    return $horse_info;
}