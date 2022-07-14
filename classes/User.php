<?php

class User{
    public $id;
    public $email;
    public $password;



    public static function authenticateUser($conn,$email)
    {
        $sql = "SELECT * FROM users WHERE email like :email";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement -> setFetchMode(PDO::FETCH_CLASS, 'User');
        $statement -> execute();
       
        if($user = $statement->fetch()){           
            return $user ;
        }else{
            return false;
        }
    }

    public static function authenticatePassword($user, $password){
        if(password_verify($password, $user->password)){
            $_SESSION['user_admin'] = $user->admin;
            return true;
        }else{
            return false;
        }
    }

}