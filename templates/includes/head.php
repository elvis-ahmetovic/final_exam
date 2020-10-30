<?php
$url = $_SERVER['PHP_SELF'];

switch($_SERVER['PHP_SELF']){
    case '/upapp/index.php':
        $pageTitle = 'Home';
        break;
    case '/upapp/register.php':
        $pageTitle = 'Register';
        break;
    case '/upapp/profile.php':
        $pageTitle = 'Profile';
        break;
    case '/upapp/messages.php':
        $pageTitle = 'Messages';
        break;
    case '/upapp/results.php':
        $pageTitle = 'Results';
        break;
    case '/upapp/administration.php':
        $pageTitle = 'Administration';
        break;
    case '/upapp/adminUsers.php':
        $pageTitle = 'Administration';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!--External CSS-->
    <link rel="stylesheet" href="templates/css/main.css">

    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/45a453ed2d.js" crossorigin="anonymous"></script>
    
    <title><?php echo "UP | " .  $pageTitle; ?></title>
</head>
<body>

    <?php 
    switch($_SERVER['PHP_SELF']){
        case '/upapp/index.php':
            include('includes/navbar.php');
            break;
        case '/upapp/register.php':
            include('includes/navbar.php');
            break;
        case '/upapp/register.php':
            break;
        case '/upapp/profile.php':
            include('includes/navbar.php');
            break;
        case '/upapp/messages.php':
            include('includes/navbar.php');
            break;
        case '/upapp/results.php':
            include('includes/navbar.php');
            break;
    }
    ?>
    
    <div class="container-fluid">