<?php

require '../includes/init.php';

$conn = require '../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  if($_POST['password'] === $_POST['confirm_password']){
    if (User::createUser($conn, $_POST)) {
      $user = User::authenticateUser($conn, $_POST['email']);
      if(User::authenticatePassword($user, $_POST['password'])){
        Auth::login($user);
        Url::redirect('/');
      }
    }else{
      $errors[]="EMAIL ALL READY REGISTERED";
    }
  }
  
}


?>

<head>
  <title>Login</title>
</head>

<body>

  <form class="container position-absolute top-50 start-50 translate-middle border border-2 p-3 shadow-lg rounded sign_in_form form_container" method='post'>
    <h1>Sign In</h1>
    <h6>or CREATE AN ACCOUNT</h6>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email" aria-describedby="emailHelp" autocomplete="new-password" required>

    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input id='password' type="password" class="form-control password_group" name="password" autocomplete="new-password" required>
      <div class='registration_form_alert bg-warning w-50 rounded' id='_password'></div>
    </div>
    <div class="mb-3">
      <label for="confirm_password" class="form-label">Confirm Password</label>
      <input id='confirm_password' type="password" class="form-control password_group disabled" name="confirm_password" autocomplete="new-password" required>
      <div class='registration_form_alert bg-warning w-25 rounded' id='check_password'></div>
    </div>
    <button id='submit_btn' type="submit" class="btn btn-primary disabled loading">Submit</button>
    <a href="/" class="float-end btn btn-danger">Cancel</a>
  </form>

  <script>
    let valid_length = false;
   
    $('#password').keyup(function(event) {
      if (event.target.value.length < 6) {
        $('#_password').html('Passwords must be at least 6 characters');
        valid_length = false;
        $('#confirm_password').addClass('disabled')
      } else {
        $('#_password').html(''); 
        $('#confirm_password').removeClass('disabled')
        valid_length = true;
      }
    })


    $('.password_group').keyup(function(event) {
      if ($('#password').val() != event.target.value) {
        $('#check_password').html('Passwords do not match');

      } else {
        $('#check_password').html('');
        if (valid_length) {
          $('#submit_btn').removeClass('disabled')
        }
      }

    })
  </script>

  <?php
  require "../includes/footer.php"
  ?>