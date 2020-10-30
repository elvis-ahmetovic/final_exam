<?php
class Output{

    /* Prin out all categories */
    public static function getCategories(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM categories WHERE deleted=0";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    // Print out motivation message randomly when user is logged in
    public static function messages(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM motivation_msgs ORDER BY rand() LIMIT 1";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $result;
    }
}
?>