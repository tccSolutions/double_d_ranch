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

    public static function getImageByPublicId($conn, $public_id){
        $sql = "Select * from images WHERE public_id = :public_id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":public_id", $public_id, PDO::PARAM_STR);
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Image');
        if($statement->execute()){
            return $statement->fetch();
        }
        
        
    }

    public static function deleteImage($conn, $image){
        $sql = "DELETE FROM images WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":id", $image->id, PDO::PARAM_INT);       
        return $statement->execute();        
    }

   
}