<?php
include_once('config/init.php');

$template = new Template('templates/messages.php');

/* Check if is set user's ID */
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;


/* Get All Coaches in New Message */
$template->coaches = Coach::getAllCoaches();


/* Print All Conversations of Particular USer */
$template->conversations = User::allConversations($userId);


/* Check if is set conversations ID */
$conv_id = isset($_GET['conversation_id']) ? $_GET['conversation_id'] : NULL;


/* Print All Messages of particular conversation */
if(isset($_GET['open']))
    $template->convMessages  = User::conversationMessages($conv_id, $userId);
else
    $template->convMessages = '';

/* Send message in particular cpnversation */
if(isset($_POST['sendRespond'])){
    $user = new User;

    $text = filter_input(INPUT_POST, 'respondMessage', FILTER_SANITIZE_STRING);
    $user->setText($text);

    $to = isset($_GET['to']) ? $_GET['to'] : NULL; 

    $user->respondMessage($conv_id, $userId, $to);
        header('Location: messages.php?open=1&conversation_id='.$conv_id.'&to='.$to);
    
}

/* Create a new conversation */
if(isset($_POST['createNewConversation'])){
    $user = new User;

    $text = filter_input(INPUT_POST, 'newText', FILTER_SANITIZE_STRING);
    $user->setText($text);

    $msg_to = isset($_POST['msg_to']) ? $_POST['msg_to'] : NULL;

    $lid = $user->createNewConversation($userId, $msg_to);
    header('Location: messages.php?open=1&conversation_id='.$lid.'&to='.$msg_to);
}

/* Delete Conversation */
if(isset($_GET['deleteConversation'])){
    $user = new User;

    $conv_id = $_GET['conversation_id'];
    
    if($user->deleteConversation($userId, $conv_id)){
        header('Location: messages.php');
    }
}

$template->unreadedMessages = User::unreadedMessages($userId); // Show unreaded messages

echo $template;
?>