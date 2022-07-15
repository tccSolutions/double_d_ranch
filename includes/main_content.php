<!-- PHP -->

<?php
$errors = [];

if(isset($_SESSION['user'])){
  $username = explode('@',$_SESSION['user']->email, 2)[0];
  var_dump($username);
}else{
  $username='';
}

function display_ranch_name($tag){
   return $ranch_name = "<div class='d-flex w-100 justify-content-center '>                 
                  <img class='the_j animate__animated animate__wobble' src='../public/images/brand.png' width='100%'/>                 
                </div>";
}



?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'header.php'?>
   
</head>
<nav class="navbar navbar-expand-lg align-items-end sticky-top ">
  <div class="container-fluid  align-items-end">
    <div class="d-flex navbar-brand p-3" style="border-right:1px solid black ;" >  
      <a href='/'><img class='the_j animate__animated animate__wobble ' src='../public/images/brand.png' width='200px'/> </a>
      </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon " style="color: black;"></span>
    </button>
    <div class="collapse navbar-collapse  " id="navbarNav">
      <ul class="navbar-nav w-100 fancy_font fs-5  ">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " href="/public/horses.php?for_sale=false">Our Barn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/public/horses.php?for_sale=true">Find Your Partner</a>
        </li>
        <?php if(Auth::isLoggedIn()) : ?>
          <li class="nav-item ms-auto">
          <a class="nav-link" href="/public/logout.php"><?= $username?></a>
        </li>
        <?php else : ?>
        <li class="nav-item ms-auto">
          <a class="nav-link" id='sign_in' href="/public/signin.php">Sign In</a>
        </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>
<body class=''>
<div class='container'>
