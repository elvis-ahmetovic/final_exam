<?php
class Contact{
    private $name, $lastname, $email, $text;

    public function setName($name){
        $this->name = $name;
    }

    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setText($text){
        $this->text = $text;
    }

    /* Save contact message into database */
    public function insertContact($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'INSERT INTO contact (userId, name, lastname, email, text) VALUES (:userId, :name, :lastname, :email, :text)';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':userId', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':text', $this->text, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
?>