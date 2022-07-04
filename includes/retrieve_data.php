<?php
function connect()
{
    $db_host = 'ec2-52-22-144-113.compute-1.amazonaws.com';
    $db_name = 'd16qva2c8tuebm';
    $db_user = 'oesrtrdznlliyw';
    $db_password = '50512eed6f8d653da29e5d259e61cd0d26c3acfc571d78ad000deb70db9aed88';
    $dsn = 'pgsql:host=' . $db_host . ';port=5432' . ';dbname=' . $db_name . ';sslmode=require';
    try {
        return new PDO($dsn, $db_user, $db_password);
    } catch (Exception $e) {
        return $errors[0] = $e->getMessage();
    }
}


$pdo_conn = require 'includes/database.php';
$pg_conn = connect();



$pg_sql = "SELECT * FROM horse_medical";
$pg_stmnt = $pg_conn->prepare($pg_sql);
$pg_stmnt->execute();
$pg_results = $pg_stmnt->fetchAll();


foreach ($pg_results as $medical) {
   
    
    $pg_sql = "SELECT name FROM horse_horse where id = :id";     
    $stmnt = $pg_conn->prepare($pg_sql);
    $stmnt->bindValue(":id", $medical['horse_id'], PDO::PARAM_INT);
    $stmnt->execute();
    $horse_result = $stmnt->fetch(PDO::FETCH_ASSOC);
    
   
   
    $sql = "SELECT id FROM horses WHERE name= :horse";
    $statement = $pdo_conn->prepare($sql);
    $statement->bindValue(':horse', $horse_result['name'], PDO::PARAM_STR);
    $statement->setFetchMode(PDO::FETCH_CLASS, 'Horse');
    $statement->execute();
    $horse = $statement->fetch();
  
  
    
    $sql = "INSERT INTO medical_checkups (type,date,horse_id,vet,height,length,girth,red_tape,black_tape,wormed,coggins,notes)
    VALUES (:type,:date,:horse_id,:vet,:height,:length,:girth,:red_tape,:black_tape,:wormed,:coggins,:notes)";
    $statement = $pdo_conn->prepare($sql);
    $statement->bindValue(':type', $medical['name'], PDO::PARAM_STR);
    $statement->bindValue(':date', $medical['date'], PDO::PARAM_STR);
    $statement->bindValue(':horse_id', $horse->id, PDO::PARAM_INT);
    $statement->bindValue(':vet', $medical['vet'], PDO::PARAM_STR);
    $statement->bindValue(':height', $medical['height'], PDO::PARAM_STR);
    $statement->bindValue(':length', $medical['length'], PDO::PARAM_STR);
    $statement->bindValue(':girth', $medical['girth'], PDO::PARAM_INT);
    $statement->bindValue(':red_tape', $medical['red_tape'], PDO::PARAM_INT);
    $statement->bindValue(':black_tape', $medical['black_tape'], PDO::PARAM_INT);
    $statement->bindValue(':coggins', $medical['coggins'], PDO::PARAM_BOOL);
    $statement->bindValue(':wormed', $medical['wormed'], PDO::PARAM_BOOL);
    $statement->bindValue(':notes', $medical['exam_notes'], PDO::PARAM_STR);

    $statement->execute();
 
}
