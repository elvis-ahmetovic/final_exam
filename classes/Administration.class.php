<?php
class Administration{

    /* Login */
    public function login($username, $password){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM administration WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->execute();

        $count = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        if($count > 0){
            $this->setAdminData($row);
            return true;
        }else{
            return false;
        }
    }

    /* Set Admin Data */
    public function setAdminData($row){
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['admin_id'] = $row->id;
        $_SESSION['username'] = $row->username;
        $_SESSION['adminStatus'] = 1;
        $_SESSION['admin'] = 1;
    }

    /* Change Password */
    public function changeAdminPass($password){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE administration SET password=:password WHERE id=1';

        $stmt = $conn->prepare($sql);   
        $stmt->bindValue(':password', $password);
        
        return $stmt->execute();
    }

    /* Number of Users */
    public static function usersNum(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql ="SELECT * FROM user WHERE coachStatus=0";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->rowCount();

        return $row;
    }

    /* Number of Banned Users */
    public static function bannedNum(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql ="SELECT * FROM user WHERE banned = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->rowCount();

        return $row;
    }

    /* Number of Coaches */
    public static function coachesNum(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql ="SELECT * FROM coach";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->rowCount();

        return $row;
    }

    /* Display all Users */
    public static function users(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql ="SELECT * FROM user WHERE coachStatus=0";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    /* Display all Coaches */
    public static function coaches(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql ="SELECT u.*, co.phone, co.regDate, c.name AS catName 
                FROM user AS u
                JOIN coach AS co
                ON u.id = co.userId
                JOIN categories AS c
                ON co.categoryId=c.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    /* Display all Banned Users */
    public static function banned(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql ="SELECT * FROM user WHERE banned=1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    /* Summ all Users (users+coaches) */
    public static function allUsers(){
        $result = self::usersNum() + self::coachesNum();

        return $result;
    }

    /* Bann User */
    public function banUser($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE user 
                SET banned = 
                (
                    CASE
                        WHEN 
                            (banned = 0)
                        THEN 
                            1
                        ELSE
                            (banned = 0)
                    END
                )
                WHERE id=:id';

        $stmt = $conn->prepare($sql);   
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }

    /* Set Administrator */
    public function setAdmin($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE user 
                SET adminStatus =  
                (
                    CASE
                        WHEN 
                            (adminStatus = 0)
                        THEN 
                            1
                        ELSE
                            (adminStatus = 0)
                    END
                )
                WHERE id=:id';
        
        $stmt = $conn->prepare($sql);   
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }

    // Get username for user-admin 
    public static function getUsernameAdmin($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT name FROM user WHERE id=:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        return $row->name;
    }

    // Get coach status for user-admin 
    public static function getUserStatus($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT coachStatus FROM user WHERE id=:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        return $row->coachStatus;
    }

    /* Display All Categories */
    public static function getCategories(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM categories ORDER BY id DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    /* Add New Category */
    public function addCategory($name, $userId, $adminId){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'INSERT INTO categories (name, user_publisher, admin_publisher) VALUES (:name, :user, :admin)';

        $stmt = $conn->prepare($sql); 
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':user', $userId);
        $stmt->bindValue(':admin', $adminId);
        
        return $stmt->execute();
    }

    /* Delete Category */
    public function deleteCategory($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE categories SET deleted=1 WHERE id = :id';

        $stmt = $conn->prepare($sql); 
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }

    /* Restore Category */
    public function restoreCategory($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE categories SET deleted=0 WHERE id = :id';

        $stmt = $conn->prepare($sql); 
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }

    /* Display All Motivation Messages */
    public static function getMotivationMsgs(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM motivation_msgs ORDER BY id DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    /* Add New Motivation Message */
    public function addMotMessage($title, $text, $userId, $adminId){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'INSERT INTO motivation_msgs (title, text, user_publisher, admin_publisher) VALUES (:title, :text, :user, :admin)';

        $stmt = $conn->prepare($sql); 
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':text', $text);
        $stmt->bindValue(':user', $userId);
        $stmt->bindValue(':admin', $adminId);
        
        return $stmt->execute();
    }

    /* Delete Motivation Message */
    public function deleteMotMessages($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'DELETE FROM  motivation_msgs WHERE id = :id';

        $stmt = $conn->prepare($sql); 
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }

    /* Display All (Contact Messages & Deleted C. Messages) */
    public static function contactMessages($num){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM contact WHERE deleted=? ORDER BY id DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$num]);

        if($result = $stmt->fetchAll(PDO::FETCH_OBJ)){
            $sql = "UPDATE contact SET seen=1 WHERE seen=0";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        return $result;
    }

    /* Delete Contact Message */
    public function deleteContMessage($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE contact SET deleted=1 WHERE id=:id';

        $stmt = $conn->prepare($sql);  
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }
    
    /* Show number of unreaded messages */
    public static function unreadedMessages(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'SELECT * FROM contact WHERE seen = 0';

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if($row = $stmt->rowCount()){
            return $row;
        }else{
            return false;
        }
    }

    
}