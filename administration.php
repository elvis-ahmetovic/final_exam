<?php
include_once('config/init.php');

$template = new Template('templates/administration.php');

/* Login Administrator */
if(isset($_POST['login'])){
    $administrator = new Administration;

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password = md5($password);

    if($administrator->login($username, $password)){
        header('Location: administration.php');
    }else{
        header('Location: administration.php?action=error');
    }
}

/* Change Password */
if(isset($_POST['newAdminPassword'])){
    $administrator = new Administration; // Object Administration

    $password = filter_input(INPUT_POST, 'newAdminPass', FILTER_SANITIZE_STRING);
    $password = md5($password);

    if($administrator->changeAdminPass($password)){
        $success = 'Uspješno ste promijenili lozinku';
        header('Location: administration.php?login&success=' . $success);
    }
}

$template->usersNum = Administration::usersNum(); // Display number of users
$template->coachesNum = Administration::coachesNum(); // Display number of coaches
$template->bannedUsers = Administration::bannedNum(); // Display number of banned users
$template->allUsers = Administration::allUsers(); // Display summ of users

/* DIsplay all categories */
if(isset($_GET['allCats'])){
    $template->allCats = Administration::getCategories();
}else{
    $template->allCats = '';
}

/* DIsplay all motivation messages */
if(isset($_GET['allMMsgs'])){
    $template->allMMsgs = Administration::getMotivationMsgs();
    //var_dump($template->allMMsgs = Administration::getMotivationMsgs());
}else{
    $template->allMMsgs = '';
}

/* DIsplay all contact messages */
if(isset($_GET['allCMsgs'])){
    $num=0;
    $template->allCMsgs = Administration::contactMessages($num);
}else{
    $template->allCMsgs = '';
}

$template->newContactMessages = Administration::unreadedMessages(); // Number of new contact messages

/* DIsplay all deleted messages */
if(isset($_GET['allDMsgs'])){
    $num=1;
    $template->allDMsgs = Administration::contactMessages($num);
}else{
    $template->allDMsgs = '';
}

/* Add New Category */
if(isset($_POST['save-category'])){
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
    $adminId = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : NULL;
    $name = filter_input(INPUT_POST, 'new-category', FILTER_SANITIZE_STRING);
    $administrator = new Administration;

    $administrator->addCategory($name, $userId, $adminId);
    header('Location: administration.php?allCats=');
}

/* Delete Category */
if(isset($_GET['delete-category'])){
    $categoryId = $_GET['category-id'];
    $administrator = new Administration;

    $administrator->deleteCategory($categoryId);
    header('Location: administration.php?allCats=');
}

/* Restore Category */
if(isset($_GET['restore-category'])){
    $categoryId = $_GET['category-id'];
    $administrator = new Administration;

    $administrator->restoreCategory($categoryId);
    header('Location: administration.php?allCats=');
}

/* Add New Motivatio Message */
if(isset($_POST['save-mot-message'])){
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
    $adminId = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : NULL;
    $title = filter_input(INPUT_POST, 'new-mot-title', FILTER_SANITIZE_STRING);
    $text = filter_input(INPUT_POST, 'new-mot-msg', FILTER_SANITIZE_STRING);
    $administrator = new Administration;

    $administrator->addMotMessage($title, $text, $userId, $adminId);
    header('Location: administration.php?allMMsgs=');
}

/* Delete Motivation Message */
if(isset($_GET['delete-message'])){
    $messageId = $_GET['message-id'];
    $administrator = new Administration;

    $administrator->deleteMotMessages($messageId);
    header('Location: administration.php?allMMsgs=');
}

/* Delete Contact Message */
if(isset($_GET['del-cont-message'])){
    $contMsgId = $_GET['contMsgId'];

    $administrator = new Administration;

    $administrator->deleteContMessage($contMsgId);
    header('Location: administration.php?allCMsgs=');
}

echo $template;