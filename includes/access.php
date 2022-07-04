<?php
if(Auth::unauthorized()){
    die("<h1 class='position-absolute top-50 start-50 translate-middle transparant-card-background'>
    Access Denied
    </h1>");
};