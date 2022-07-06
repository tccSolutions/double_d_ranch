<!-- PHP -->

<?php
$errors = [];
function display_ranch_name($tag){
   return $ranch_name = "<div class='d-flex w-100 justify-content-center '>                 
                  <img class='the_j animate__animated animate__wobble' src='../images/brand.png' width='100%'/>                 
                </div>";
}



?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'header.php'?>
   
</head>
<nav class="navbar navbar-expand-lg align-items-end ">
  <div class="container-fluid  align-items-end">
    <div class="d-flex navbar-brand p-3" style="border-right:1px solid black ;" >  
      <a href='/'><img class='the_j animate__animated animate__wobble ' src='../images/brand.png' width='200px'/> </a>
      </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon " style="color: black;"></span>
    </button>
    <div class="collapse navbar-collapse  " id="navbarNav">
      <ul class="navbar-nav w-100 fancy_font fs-5  ">
        <li class="nav-item">
          <a class="nav-link active " aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/horses.php?for_sale=true">For Sale</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/horses.php?for_sale=false">Our Barn</a>
        </li>
        <?php if(Auth::isLoggedIn()) : ?>
          <li class="nav-item ms-auto">
          <a class="nav-link" href="/logout.php">Sign Out</a>
        </li>
        <?php else : ?>
        <li class="nav-item ms-auto">
          <a class="nav-link" id='sign_in' href="/signin.php">Sign In</a>
        </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>
<body class=''>

