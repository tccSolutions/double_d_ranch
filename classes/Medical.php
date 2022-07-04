<?php

class Medical{

    public static function getHorseMedical($conn, $horse){
        $sql = "SELECT * FROM medical_checkups WHERE horse_id= :horse_id ORDER BY date DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':horse_id', $horse->id, PDO::PARAM_INT);
       
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}