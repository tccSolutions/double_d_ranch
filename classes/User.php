<?php

class User{
    public $id;
    public $email;
    public $password;



    public static function authenticate($conn,$email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement -> setFetchMode(PDO::FETCH_CLASS, 'User');
        $statement -> execute();
       
        if($user = $statement->fetch()){
            if(password_verify($password, $user->password)){
                $_SESSION['user_admin'] = $user->admin;
                return true;
            }
            return false ;
        }
    }

}