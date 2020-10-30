<?php
class Search{
    /* Search users Except Logged */
    public static function searchCoaches($id, $str){
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
                WHERE NOT us.id=:id 
                AND(ca.name LIKE :str OR us.name LIKE :str OR us.city LIKE :str OR us.lastname LIKE :str)
                AND ca.deleted=0";

        $stmt= $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':str', "%" . $str . "%", PDO::PARAM_STR);
        
        $stmt->execute();
        
        if($result = $stmt->fetchAll(PDO::FETCH_OBJ)){
            return $result;
        }

        return $result;
    }
}