<?php

class Image
{
    public $id;
    public $url;
    public $comment;
    public $horse_id;
    public $public_id;


    public static function upload_image($conn, $image){
       
        $sql = "INSERT INTO images (url, comment, horse_id, public_id)
            VALUES (:url, :comment, :horse_id, :public_id)";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':url', $image->url, PDO::PARAM_STR);
        $statement->bindValue(':comment', $image->comment, PDO::PARAM_STR);
        $statement->bindValue(':horse_id', $image->horse_id, PDO::PARAM_STR);
        $statement->bindValue(':public_id', $image->public_id, PDO::PARAM_STR);
     
       

        return $statement->execute();
    }

    public static function get_horse_images($conn, $id){
        $sql = "SELECT * FROM images WHERE horse_id= :horse_id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':horse_id', $id, PDO::PARAM_INT);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        if($statement->execute()){
            return $statement->fetchAll();
        }
    }

   
}