<?php


class Horse
{
    public $id;
    public $bio;
    public $breed;
    public $brand;
    public $gender;
    public $hma;
    public $name;
    public $price;
    public $year_foaled;
    public $updated;
    public $medical;
    public $errors;

     
    /**
     * @param $id
     * @param $bio
     * @param $breed
     * @param $brand
     * @param $gender
     * @param $hma
     * @param $name
     * @param $price
     * @param $yearFoaled
     * @param $updated
     */


    /**
     * Get all the horses from database
     *
     */
    public static function getAll($conn)
    {
        try {
            $sql = "SELECT *  FROM horses  ORDER By year_foaled";
            $horses_results = $conn->query($sql);
            return $horses_results->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $errors[0] = $e->getMessage();
        }
    }

    /**
     * Get a admin from database
     * @param int $id Horse id, required
     * @param PDO $conn DATABASE CONNECTION, required
     * @param string $column Columns in Database Seperate by ","
     * @return Horse Horse object
     */
    public static function getHorseById($id, $conn, $columns = '*')
    {
        $sql = "SELECT $columns FROM horses WHERE id= :id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Horse');

        if ($statement->execute()) {
            return $statement->fetch();
        }

    }

    /**
     * Update admin information
     * @param mixed $admin Horse from database, required
     * @param PDO $conn DATABASE CONNECTION, required
     */
    public function updateHorse(PDO $conn): bool
    {
      
            $sql = "UPDATE horses SET name= :name, breed= :breed,brand= :brand,
                  gender= :gender, bio= :bio, year_foaled= :year_foaled, hma= :hma, 
                  price= :price WHERE id= :id";
            $statement = $conn->prepare($sql);

            $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
            $statement->bindValue(':name', $this->name, PDO::PARAM_STR);            
            $statement->bindValue(':breed', $this->breed, PDO::PARAM_STR);
            $statement->bindValue(':brand', $this->brand, PDO::PARAM_STR);
            $statement->bindValue(':gender', $this->gender, PDO::PARAM_STR);
            $statement->bindValue(':bio', $this->bio, PDO::PARAM_STR);
            $statement->bindValue(':year_foaled', $this->year_foaled, PDO::PARAM_STR);
            $statement->bindValue(':price', $this->price, PDO::PARAM_STR);
            $statement->bindValue(':hma', $this->hma, PDO::PARAM_STR);

            return $statement->execute();
      
    }


    /**
     * Add a admin to the database
     * @param mixed $POST form data, required
     * @param PDO $conn DATABASE CONNECTION, required
     */
    public static function addHorse($POST, PDO $conn): bool
    {
        $horse = self::getHorseFromForm($POST, $conn);
        $sql = "INSERT INTO horses (name,  breed, brand, gender, bio,  year_foaled, hma, price)
            VALUES (:name,:breed,:brand,:gender,:bio,:year_foaled,:hma, :price)";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':name', $horse->name, PDO::PARAM_STR);
        $statement->bindValue(':breed', $horse->breed, PDO::PARAM_STR);
        $statement->bindValue(':brand', $horse->brand, PDO::PARAM_STR);
        $statement->bindValue(':gender', $horse->gender, PDO::PARAM_STR);
        $statement->bindValue(':bio', $horse->bio, PDO::PARAM_STR);
        $statement->bindValue(':year_foaled', $horse->year_foaled, PDO::PARAM_INT);
        $statement->bindValue(':price', $horse->price, PDO::PARAM_STR);
        $statement->bindValue(':hma', $horse->hma, PDO::PARAM_STR);

        return $statement->execute();

    }

    /**
     * Removes Horse From Databse
     * @param PDO $conn Database Connection required
    */
    public function deleteHorse(PDO $conn): bool
    {
        $sql = "DELETE FROM horses WHERE id= :id";
        $statement = $conn->prepare($sql);
        $statement->bindValue("id", $this->id, PDO::PARAM_INT);
            return $statement->execute();
    }

    private function validate()
    {

        if ($this->name == '') {
            $this->errors[] = 'Name is required';
        }
        if ($this->breed == '') {
            $this->errors[] = 'Breed is required';
        }
        if ($this->gender == '') {
            $this->errors[] = 'Gender is required';
        }
        if ($this->year_foaled == '') {
            $this->errors[] = 'Year Foaled is required';
        }
        return $this->errors;
    }

    public static function getHorseFromForm($POST): Horse
    {
        $horse = new Horse();
        if(isset($_GET['id'])){
            $horse->id = $_GET['id'];
        }
        $horse->name = $POST['horse_name'];
        $horse->breed = $POST['horse_breed'];
        $horse->brand = $POST['horse_brand'];
        $horse->gender=$POST['horse_gender'];
        $horse->hma = $POST['hma'];
        $horse->year_foaled = $POST['horse_year'];
        $horse -> price = $POST['horse_price'];
        $horse -> bio = $POST['horse_bio'];
        $horse->validate();


        return $horse;

    }

    public function get_training_notes($conn){
        $sql = "Select training_notes.* FROM training_notes         
          JOIN horse_training
          ON training_notes.id = horse_training.training_id 
          WHERE horse_id= :horse_id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':horse_id', $this->id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMedical($conn){
        $medicals = Medical::getHorseMedical($conn, $this);
        if($medicals){
            $weight = 0;
            if($medicals[0]['length'] && $medicals[0]['girth']){
                $weight = (($medicals[0]['girth'] * $medicals[0]['girth'] * $medicals[0]['length']) /330) + 50;
            }
            if($medicals[0]['red_tape'] && $medicals[0]['black_tape'] && $medicals[0]['length'] && $medicals[0]['girth'] ){
                $weight +=  $medicals[0]['red_tape'] + $medicals[0]['black_tape'];
                $weight /= 3;
            }
            elseif($medicals[0]['red_tape'] && $medicals[0]['black_tape']){
                $weight =  ($medicals[0]['red_tape'] + $medicals[0]['black_tape'])/2;
            }


           $this->height= $medicals[0]['height'];
           $this->weight= round($weight, 0);
           $this->exam_date = date("M d, Y", strtotime($medicals[0]['date']));
        }   
        else{
             $this->height = null;
             $this->weight = null; 
             $this->exam_date = null;    
        }
    }


}