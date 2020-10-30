<?php
include_once('config/init.php');

$template = new Template('templates/register.php');



if(isset($_POST['register'])){ 
    $user = new User;
    
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $user->setName($name);

    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $user->setLastname($lastname);

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $user->setUsername($username);

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $user->setEmail($email);

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $user->setPassword($password);

    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $user->setCity($city); 

    $birthDate = filter_input(INPUT_POST, 'pippo', FILTER_SANITIZE_STRING);
    $user->setBirthDate($birthDate);
    
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $user->setGender($gender);

    if($user->register())
        header('Location: index.php?action=success');
}

echo $template;
?>




                