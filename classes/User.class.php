<?php
class User{
    private $name, $lastname, $username, $email, $password, $city, $birthDate, $gender, $text;

    // Set name
    public function setName($name){
        $this->name = $name;
    }

    // Set lastname
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    // Set username
    public function setUsername($username){
        $this->username = $username;
    }

    // Set email
    public function setEmail($email){
        $this->email = $email;
    }

    // Set password
    public function setPassword($password){
        $this->password = md5($password);
    }

    // Set city
    public function setCity($city){
        $this->city = $city;
    }

    // Set birthDate
    public function setBirthDate($birthDate){
        $this->birthDate = $birthDate;
    }

    // Set gender
    public function setGender($gender){
        $this->gender = $gender;
    }

    // Set priv. message text
    public function setText($text){
        $this->text = $text;
    }

    // Register User
    public function register(){
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        $sql = "INSERT INTO user (name, lastname, username, email, password, city, birthDate, gender) VALUES (:name, :lastname, :username, :email, :password, :city, :birthDate, :gender)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':city', $this->city, PDO::PARAM_STR);
        $stmt->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $stmt->bindValue(':gender', $this->gender, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /* Login */
    public function login(){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM user WHERE username = :username AND password = :password AND banned=0";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':username', $this->username);
        $stmt->bindValue(':password', $this->password);
        $stmt->execute();

        $count = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        if($count > 0){
            $this->setUserData($row);
            return true;
        }else{
            return false;
        }
    }

    /* Set User Data */
    public function setUserData($row){
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['user_id'] = $row->id;
        $_SESSION['name'] = $row->name;
        $_SESSION['lastname'] = $row->lastname;
        $_SESSION['email'] = $row->email;
        $_SESSION['avatar'] = $row->avatar;
        $_SESSION['coachStatus'] = $row->coachStatus;
        $_SESSION['adminStatus'] = $row->adminStatus;
    }

    /* Logout */
    public function logout(){
        session_destroy();
        return true;
    }

    /* Get User */
    public static function getUser($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        $sql = "SELECT * FROM up.user WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        return $row;
    }

    /* Change Avatar */
    public function updateAvatar($id, $avatar){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE user SET avatar=:avatar WHERE id=:id';

        $stmt = $conn->prepare($sql);   
        $stmt->bindValue(':avatar', $avatar);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    /* Upload Avatar */
    public function uploadAvatar(){
        $allowedExt = ["gif", "jpeg", "jpg", "png"];
        $temp = explode(".", $_FILES["avatar"]["name"]);
        $extensions = end($temp);

        if((($_FILES["avatar"]["type"] == "image/gif") 
                || ($_FILES["avatar"]["type"] == "image/jpeg")
                || ($_FILES["avatar"]["type"] == "image/jpg")
                || ($_FILES["avatar"]["type"] == "image/png"))
                && ($_FILES["avatar"]["size"] < 150000)
                && in_array($extensions, $allowedExt)){
            if($_FILES["avatar"]["error"] > 0){
                header('Location: profile.php');
            }else{
                if(file_exists("templates/images/avatars/" . $_FILES["avatar"]["name"])){
                    header('Location: profile.php');
                }else{
                    move_uploaded_file($_FILES["avatar"]["tmp_name"], "templates/images/avatars/" . $_FILES["avatar"]["name"]);

                    return true;
                }
            }
        }else{
            header('Location: profile.php');
        }
    }

    /* Change User's Informations */
    public function changeUserInfos($id, $column, $data){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE user SET ' . $column . '=:placeholder WHERE id=:id';

        $stmt = $conn->prepare($sql);   
        $stmt->bindValue(':placeholder', $data);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    /* Create a new conversations */
    public function createNewConversation($id, $participant_2){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'INSERT INTO conversations (participant_1, participant_2) VALUES (:id, :participant_2)';
        $stmt= $conn->prepare($sql);

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':participant_2', $participant_2);

        if($stmt->execute()){  
            $lid = $conn->lastInsertId();

            $sql2 = 'INSERT INTO messages (conversationId, msg_from, msg_to, text) VALUES ((
            SELECT id FROM conversations WHERE participant_1=:id AND participant_2=:participant_2
            ), :msg_from, :msg_to, :text)';
            $stmt= $conn->prepare($sql2);

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':participant_2', $participant_2, PDO::PARAM_INT);
            $stmt->bindValue(':msg_from', $id, PDO::PARAM_INT);
            $stmt->bindValue(':msg_to', $participant_2, PDO::PARAM_INT);
            $stmt->bindValue(':text', $this->text, PDO::PARAM_STR);
            $stmt->execute();
        }

        return $lid;    
    }

    /* Print out all conversations */
    public static function allConversations($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'SELECT 
                    c.id, c.participant_1, c.participant_2, c.create_time,
                    u.name AS participant1_name, u.lastname AS participant1_lastname, u.avatar AS par1_avatar,
                    us.name AS participant2_name, us.lastname AS participant2_lastname, us.avatar AS par2_avatar
                FROM conversations AS c
                JOIN user AS u
                ON c.participant_1=u.id 
                JOIN user AS us
                ON c.participant_2=us.id
                WHERE (participant_1 = :id OR participant_2 = :id)
                ORDER BY create_time DESC';

        $stmt= $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();   

        if($result = $stmt->fetchAll(PDO::FETCH_OBJ)){
            return $result;
        }else{
            return false;
        }
    }

    /* Print out all messages of particular conversation */
    public static function conversationMessages($conv_id, $id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'SELECT c.id, m.conversationId, m.msg_from, m.text, m.sendTime,
                       u.name, u.lastname
                FROM conversations AS c
                JOIN messages AS m
                ON c.id=m.conversationId
                JOIN user AS u
                ON m.msg_from=u.id
                WHERE conversationId=:conversationId 
                ORDER BY sendTime DESC';

        $stmt= $conn->prepare($sql);

        $stmt->bindValue(':conversationId', $conv_id, PDO::PARAM_INT);
        //$stmt->bindValue(':id', $id);
        if($stmt->execute())
            self::readMessage($conv_id, $id);
            
        if($result = $stmt->fetchAll(PDO::FETCH_OBJ)){
            return $result;
        }else{
            return false;
        } 
    }

    /* Send message in a particular conversation */
    public function respondMessage($conv_id, $id, $to){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'INSERT INTO messages (conversationId, msg_from, msg_to, text) 
                            VALUES (:conversationId, :msg_from, :msg_to, :text)';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':conversationId', $conv_id);
        $stmt->bindValue(':msg_from', $id);
        $stmt->bindValue(':msg_to', $to);
        $stmt->bindValue(':text', $this->text, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /* Show number of unreaded messages */
    public static function unreadedMessages($msg_to){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'SELECT * FROM messages WHERE msg_to = :msg_to AND readed = 0';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':msg_to', $msg_to);
        $stmt->execute();

        if($row = $stmt->rowCount()){
            return $row;
        }else{
            return false;
        }
    }

    /* Read Message */
    public static function readMessage($conv_id, $id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $sql = 'UPDATE messages SET readed=1 WHERE conversationId=:conversationId AND msg_to=:id';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':conversationId', $conv_id);
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }
}
?>