<?php
include_once('config/init.php');

$template = new Template('templates/index.php');

// Check if isset users ID
$id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

$template->motivationMessages = Output::messages(); // Set $motivationMessages array

$template->coaches = Coach::getcoaches(); // Set $coaches array


// Check if is set search button
if(isset($_GET['search'])){
    $str = filter_input(INPUT_GET, 'searchcoach', FILTER_SANITIZE_STRING);

    $template->findCoaches = Search::searchCoaches($id, $str); // Set $findCoaches array
    $template->str = $str; // $str variable
}

/* Login User */
if(isset($_POST['login'])){
    $user = new User;

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $user->setUsername($username);

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $user->setPassword($password);

    if($user->login()){
        header('Location: index.php');
    }else{
        header('Location: index.php?action=error');
    }
}

/* Logout User */
if(isset($_POST['logout'])){
    $user = new User;

    if($user->logout()){
        header('Location: index.php');
    }
}


/* Create a new conversation */
if(isset($_POST['createNewConversation'])){
    $user = new User;

    $text = filter_input(INPUT_POST, 'newText', FILTER_SANITIZE_STRING);
    $user->setText($text);

    $msg_to = isset($_POST['msg_to']) ? $_POST['msg_to'] : NULL;
    $user->createNewConversation($id, $msg_to);
}

 
/* Send contact message */
if(isset($_POST['contact'])){
    $contact = new Contact; // Contact object
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

    $name = isset($_SESSION['name']) ? $_SESSION['name'] : $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $contact->setName($name);

    $lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : $_POST['lastname'];
    $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
    $contact->setLastname($lastname);

    $email = isset($_SESSION['email']) ? $_SESSION['email'] : $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $contact->setEmail($email);

    $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
    $contact->setText($text);
    
    if($contact->insertContact($userId)){
       header('Location: index.php?action=csuccess');
    }
}

$template->unreadedMessages = User::unreadedMessages($id); // Show unreaded messages

echo $template;
?>