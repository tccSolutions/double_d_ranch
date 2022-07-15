<?php

require '../includes/init.php';

$conn = require '../includes/database.php';

if($_SERVER['REQUEST_METHOD']==="POST"){
  $user = User::authenticateUser($conn, $_POST['email']);
    if($user) {
      if(User::authenticatePassword($user,  $_POST['password'])){
        Auth::login($user);      
        Url::redirect('public/horses.php?for_sale=true');
      }else{
        $errors[]="Please Check Your Password";
      }   
    } else{
      $errors[]="Email Not Found";
    }
  }


 ?>

<head>  
    <title>Login</title>
</head>
<body>    
    
<form class="container position-absolute top-50 start-50 translate-middle border border-2 p-3 shadow-lg rounded sign_in_form" method='post'>
<h1>Sign In</h1>
<h6>or CREATE AN ACCOUNT</h6>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control" name="email" aria-describedby="emailHelp">
   
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div> 
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="signup.php" class="float-end btn btn-success">Create Account</a>
</form>
    

<?php
    require "../includes/footer.php"
?>