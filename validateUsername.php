<?php
include('classes/Database.class.php');
    $db = Database::getInstance();
    $conn = $db->getConnection();

if (!empty($_POST['username'])){

    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));

    $sql = "SELECT username FROM user WHERE username = '{$username}'";
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