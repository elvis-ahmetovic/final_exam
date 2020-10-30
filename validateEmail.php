<?php
include('classes/Database.class.php');
    $db = Database::getInstance();
    $conn = $db->getConnection();

if (!empty($_POST['email'])){

    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    $sql = "SELECT email FROM user WHERE email = '{$email}'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $count = $stmt->rowCount();
    if($count > 0)
        $output = false;
    else
        $output = true;

        echo json_encode($output);
}
?>