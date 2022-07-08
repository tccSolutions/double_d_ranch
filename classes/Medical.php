<?php

class Medical
{
    public static function getMedicalRecords($conn, $limit, $offset, $horse_id)
    {
        $sql = "SELECT medical_checkups.*, horses.name
                FROM medical_checkups
                JOIN horses
                ON medical_checkups.horse_id = horses.id
                WHERE medical_checkups.horse_id = :horse_id               
                ORDER BY date DESC
                LIMIT :limit
                OFFSET :offset";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->bindValue(':horse_id', $horse_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function checkWormCoggins($conn, $id)
    {
        $sql = "SELECT date, wormed, coggins, horses.name FROM medical_checkups
        JOIN horses
        ON medical_checkups.horse_id = horses.id 
        WHERE horse_id= :id 
        ORDER BY date DESC";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getHorseMedical($conn, $horse)
    {
        $sql = "SELECT * FROM medical_checkups WHERE horse_id= :horse_id ORDER BY date DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':horse_id', $horse->id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getHorseMedicalById($conn, $id)
    {
        $sql = "SELECT medical_checkups.*, horses.name FROM medical_checkups
                JOIN horses
                ON medical_checkups.horse_id = horses.id
                WHERE medical_checkups.id= :id
                ORDER BY date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function getHorseRecords($conn, $horse_id)
    {
        $sql = "SELECT * FROM medical_checkups WHERE horse_id = :horse_id
        ORDER BY date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':horse_id', $horse_id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addRecord($conn, $Post)
    {

        $sql = "INSERT INTO medical_checkups (type, date, horse_id, vet, height, length, girth, red_tape, black_tape, notes, coggins, wormed)
                VALUES (:type, :date, :horse_id,:vet, :height, :length, :girth, :red_tape, :black_tape, :notes, :coggins, :wormed)";


        $statement = $conn->prepare($sql);
        $statement->bindValue(':type', $Post['type'], PDO::PARAM_STR);
        $statement->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
        $statement->bindValue(':horse_id', $Post['horse_id'], PDO::PARAM_STR);
        $statement->bindValue(':vet', $Post['vet'], PDO::PARAM_STR);
        $statement->bindValue(':height', $Post['height'], PDO::PARAM_STR);
        $statement->bindValue(':length', $Post['length'], PDO::PARAM_STR);
        $statement->bindValue(':girth', $Post['girth'], PDO::PARAM_INT);
        $statement->bindValue(':red_tape', $Post['red_tape'], PDO::PARAM_STR);
        $statement->bindValue(':black_tape', $Post['black_tape'], PDO::PARAM_STR);
        $statement->bindValue(':notes', $Post['notes'], PDO::PARAM_STR);
        $statement->bindValue(':wormed', 0, PDO::PARAM_BOOL);
        $statement->bindValue(':coggins', 0, PDO::PARAM_BOOL);
        if (isset($Post['wormed'])) {
            $statement->bindValue(':wormed', $Post['wormed'], PDO::PARAM_BOOL);
        }
        if (isset($Post['coggins'])) {
            $statement->bindValue(':coggins', $Post['coggins'], PDO::PARAM_BOOL);
        }
        return $statement->execute();
    }

    public static function updateRecord($conn, $record_id, $POST)
    {
        $sql = "UPDATE medical_checkups 
                SET date=:date, horse_id=:horse_id, type=:type, vet=:vet, height=:height , wormed=:wormed ,coggins=:coggins,
                length=:length, girth=:girth, red_tape=:red_tape, black_tape=:black_tape, notes=:notes
                WHERE id=:id";



        $statement = $conn->prepare($sql);
        $statement->bindValue(':id', $record_id, PDO::PARAM_INT);
        $statement->bindValue(':date', $POST['date'], PDO::PARAM_STR);
        $statement->bindValue(':horse_id', $POST['horse_id'], PDO::PARAM_INT);
        $statement->bindValue(':type', $POST['type'], PDO::PARAM_STR);
        $statement->bindValue(':vet', $POST['vet'], PDO::PARAM_STR);
        $statement->bindValue(':height', $POST['height'], PDO::PARAM_STR);
        $statement->bindValue(':length', $POST['length'], PDO::PARAM_STR);
        $statement->bindValue(':girth', $POST['girth'], PDO::PARAM_STR);
        $statement->bindValue(':black_tape', $POST['black_tape'], PDO::PARAM_STR);
        $statement->bindValue(':red_tape', $POST['red_tape'], PDO::PARAM_STR);
        $statement->bindValue(':notes', $POST['notes'], PDO::PARAM_STR);
        $statement->bindValue(':coggins', 0, PDO::PARAM_BOOL);
        $statement->bindValue(':wormed', 0, PDO::PARAM_BOOL);

        if (isset($POST['wormed'])) {
            $statement->bindValue(':wormed', $POST['wormed'], PDO::PARAM_BOOL);
        }
        if (isset($POST['coggins'])) {
            $statement->bindValue(':coggins', $POST['coggins'], PDO::PARAM_BOOL);
        }
        return $statement->execute();
    }

    public static function deleteRecord($conn, $id)
    {
        $sql = 'DELETE FROM medical_checkups WHERE id=:id;';
        $statement = $conn->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        return $statement->execute();
    }
}
