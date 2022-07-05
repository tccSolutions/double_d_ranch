<?php

class Medical{

    public static function getHorseMedical($conn, $horse){
        $sql = "SELECT * FROM medical_checkups WHERE horse_id= :horse_id ORDER BY date DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':horse_id', $horse->id, PDO::PARAM_INT);
       
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addRecord($conn, $Post){
       
        $sql_insert = "INSERT INTO medical_checkups (type, date, horse_id, vet, height, length, girth, red_tape, black_tape, notes";
            $sql_values ="VALUES (:type, :date, :horse_id,:vet, :height, :length, :girth, :red_tape, :black_tape, :notes";
            if(isset($Post['wormed'])){
                $sql_insert .= ", wormed";
                $sql_values .= ", :wormed";
            }elseif(isset($Post['coggins'])){
                $sql_insert .= ", coggins";
                $sql_values .= ", :coggins";
            }
        $sql = $sql_insert . ") " . $sql_values . ")";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':type', $Post['type'], PDO::PARAM_STR);
        $statement->bindValue(':date', date("Y-m-d") , PDO::PARAM_STR);
        $statement->bindValue(':horse_id', $Post['horse_id'], PDO::PARAM_STR);
        $statement->bindValue(':vet', $Post['vet'], PDO::PARAM_STR);
        $statement->bindValue(':height', $Post['height'], PDO::PARAM_STR);
        $statement->bindValue(':length', $Post['length'], PDO::PARAM_STR);
        $statement->bindValue(':girth', $Post['girth'], PDO::PARAM_INT);
        $statement->bindValue(':red_tape', $Post['red_tape'], PDO::PARAM_STR);
        $statement->bindValue(':black_tape', $Post['black_tape'], PDO::PARAM_STR);
        $statement->bindValue(':notes', $Post['notes'], PDO::PARAM_STR);
        if(isset($Post['wormed'])){
            $statement->bindValue(':wormed', $Post['wormed'], PDO::PARAM_BOOL);
        }
        if(isset($Post['coggins'])){
            $statement->bindValue(':coggins', $Post['coggins'], PDO::PARAM_BOOL);
        }
       
       

        return $statement->execute();
    }
}