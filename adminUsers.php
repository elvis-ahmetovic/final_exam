<?php
include_once('config/init.php');

$template = new Template('templates/adminUsers.php');

/* Displaying users or coaches */
if(isset($_GET['users'])){
    $template->users = Administration::users();
    $template->title="Lista Korisnika";
}elseif(isset($_GET['coaches'])){
    $template->users = Administration::coaches();
    $template->title="Lista Trenera";
}else{
    $template->users = Administration::banned();
    $template->title="Lista Svih Banovanih";
    //header('Location: administration.php');
};

/* Ban User */
if(isset($_POST['banUser'])){
    $administrator = new Administration;

    $usersId = $_POST['id'];
    $administrator->banUser($usersId);
    header('Location: adminUsers.php?users');
}

/* Ban Coach */
if(isset($_POST['banCoach'])){
    $administrator = new Administration;

    $usersId = $_POST['id'];
    $administrator->banUser($usersId);
    header('Location: adminUsers.php?coaches');
}

/* Ban Coach */
if(isset($_POST['ban'])){
    $administrator = new Administration;

    $usersId = $_POST['id'];
    $administrator->banUser($usersId);
    header('Location: adminUsers.php?banned');
}

/* Set User as Admin */
if(isset($_POST['setUserAdmin'])){
    $administrator = new Administration;

    $usersId = $_POST['id'];
    $administrator->setAdmin($usersId);
    header('Location: adminUsers.php?users');
}

/* Set Coach as Admin */
if(isset($_POST['setCoachAdmin'])){
    $administrator = new Administration;

    $usersId = $_POST['id'];
    $administrator->setAdmin($usersId);
    header('Location: adminUsers.php?coaches');
}

echo $template;