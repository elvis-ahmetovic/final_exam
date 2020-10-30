<?php
class Coach{
    private $id, $categoryId, $price, $phone, $titleMsg, $textMsg, $noteBody;

    // Set category
    public function setCategoryId($categoryId){
        $this->categoryId = $categoryId;
    }

    // Set price
    public function setPrice($price){
        $this->price = $price;
    }

    // Set phone
    public function setPhone($phone){
        $this->phone = $phone;
    }

    // Set titleMsg
    public function setTitleMsg($titleMsg){
        $this->titleMsg = $titleMsg;
    }

    // Set textMsg
    public function setTextMsg($textMsg){
        $this->textMsg = $textMsg;
    }

    // Set Note Text
    public function setNoteBody($noteBody){
        $this->noteBody = $noteBody;
    }

    /* Advertise Yourself */
    public function becomeCoach($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "INSERT INTO up.coach (userId, categoryId, price, phone, titleMsg, textMsg) VALUES (:userId, :categoryId, :price, :phone, :titleMsg, :textMsg)";
        
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':userId', $id);
        $stmt->bindValue(':categoryId', $this->categoryId);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $stmt->bindValue(':titleMsg', $this->titleMsg, PDO::PARAM_STR);
        $stmt->bindValue(':textMsg', $this->textMsg, PDO::PARAM_STR);

        if($stmt->execute()){
            $sql2 = "UPDATE up.user SET coachStatus=1 WHERE id=$id";

            $stmt = $conn->prepare($sql2);
            $stmt->execute();
            return true;
        }else{
            return false;
        }
    }

    /* Get Coach */
    public static function getCoach($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        $sql = "SELECT co.id AS coachId, co.price, co.categoryId, co.phone, co.titleMsg, co.textMsg, 
                        ca.id, ca.name AS catName, ca.deleted AS catDeleted
                FROM coach AS co 
                JOIN up.categories AS ca 
                ON co.categoryId = ca.id 
                WHERE userId = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        return $row;
    }
    
    // Print 6 randomly coaches on index page
    public static function getCoaches(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT 
                    co.id, co.price, co.categoryId, co.phone, co.titleMsg, co.textMsg, 
                    us.id AS userId, us.name, us.lastname, us.email, us.city, us.avatar, us.birthDate,  
                    ca.name as catName, ca.deleted AS catDeleted
                FROM up.coach AS co 
                JOIN up.user AS us 
                ON co.userId = us.id 
                JOIN up.categories AS ca 
                ON co.categoryId = ca.id 
                ORDER BY rand() LIMIT 6";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    // Print All Coaches
    public static function getAllCoaches(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT 
                    co.id, co.categoryId, 
                    us.id AS userId, us.name, us.lastname, us.city, us.avatar,  
                    ca.name as catName 
                FROM up.coach AS co 
                JOIN up.user AS us 
                ON co.userId = us.id 
                JOIN up.categories AS ca 
                ON co.categoryId = ca.id 
                ORDER BY us.name asc";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    /* Change Coach's Informations */
    public function changeCoachInfos($id, $column, $data){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE coach SET ' . $column . '=:placeholder WHERE id=:id';

        $stmt = $conn->prepare($sql);   
        $stmt->bindValue(':placeholder', $data, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    // Get Coaches ID
    public static function getId($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        $sql = 'SELECT id FROM coach WHERE userId=:id';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        return $row->id;
    }

    // Get notes for coches
    public static function getNotes($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $coachId = self::getId($id);

        $sql = "SELECT * FROM notes WHERE coachId = ". $coachId . " AND deleted = 0 ORDER BY id DESC LIMIT 6";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    // Insert New Note
    public function newNote($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $coachId = self::getId($id);

        $sql = 'INSERT INTO notes (coachId, noteBody) VALUES (' . $coachId . ', :noteBody)';

        $stmt = $conn->prepare($sql); 
        //$stmt->bindValue(':coachId', $id);
        $stmt->bindValue(':noteBody', $this->noteBody, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    // Delete Note
    public function deleteNote($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE notes SET deleted = 1 WHERE id = :id';

        $stmt = $conn->prepare($sql); 
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }

}

?>