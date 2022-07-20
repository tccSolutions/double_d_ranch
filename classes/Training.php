<?php

class Training
{

    public static function get_notes($conn)
    {
        $sql = "SELECT * FROM training_notes ORDER BY description";
        $statement = $conn->prepare($sql);

        if ($statement->execute()) {
            return $statement->fetchALL();
        }
    }

    public static function add_notes($conn, $notes, $horse_id, $already_checked)
    {
        $sql = "INSERT INTO horse_training (horse_id, training_id )
                VALUES";
        $values = [];
        $checked = [];

        if (count($already_checked) > 0) {
            foreach ($already_checked as $check) {
                if (!in_array($check, $notes)) {
                    $del_sql = "DELETE FROM horse_training WHERE training_id=$check and horse_id=$horse_id";
                    $stmt = $conn->prepare($del_sql);
                    $stmt->execute();
                }
            }
        }
        if (count($notes) > 0) {
            foreach ($notes as $note) {
                if (!in_array($note, $already_checked)) {
                    $values[] = " ($horse_id , ?)";
                    $checked[] = $note;
                }
            }

            $sql .= implode(",", $values);           

            $statement = $conn->prepare($sql);
            foreach ($checked as $i => $note) {                
                $statement->bindValue($i + 1, $note, PDO::PARAM_INT);                
            }
            if (count($values) > 0) {
                $statement->execute();
            }
        }
    }
}
