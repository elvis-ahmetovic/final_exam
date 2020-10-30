<?php
include_once('config/init.php');

$template = new Template('templates/profile.php');

/* Check if is set user's ID */
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$template->user = User::getUser($userId); // Get all information's of current user

/* Change User's Avatar */
if(isset($_POST['saveAvatar'])){
    $user = new User; // Object User

    $avatar = isset($_FILES['avatar']) ? $_FILES['avatar']['name'] : 'noimage.png';

    $user->uploadAvatar();
    if($user->updateAvatar($userId, $avatar)){
        $success = 'Uspješno ste promijenili vašu sliku profila';
        header('Location: profile.php?success=' . $success);
    }
}

/* Change Password */
if(isset($_POST['newPassword'])){
    $user = new User; // Object User

    $password = filter_input(INPUT_POST, 'newPass', FILTER_SANITIZE_STRING);
    $password = md5($password);
    $column = 'password';

    if($user->changeUserInfos($userId, $column, $password)){
        $success = 'Uspješno ste promijenili vašu lozinku';
        header('Location: profile.php?success=' . $success);
    }
}

/* Change Email */
if(isset($_POST['saveEmail'])){
    $user = new User; // Object User

    $email = filter_input(INPUT_POST, 'newEmail', FILTER_SANITIZE_STRING);
    $column = 'email';

    if($user->changeUserInfos($userId, $column, $email)){
        $success = 'Uspješno ste promijenili vaš email';
        header('Location: profile.php?success=' . $success);
    }
}

/* Change City */
if(isset($_GET['saveCity'])){
    $user = new User; // Object User

    $city = filter_input(INPUT_GET, 'newCity', FILTER_SANITIZE_STRING);
    $column = 'city';

    if($user->changeUserInfos($userId, $column, $city)){
        $success = 'Uspješno ste promijenili vaš grad';
        header('Location: profile.php?success=' . $success);
    }
}

$template->coach = Coach::getCoach($userId); // Get all information's of current coach

/* Advertise yourself, become a coach */
if(isset($_POST['advertise'])){
    $coach = new Coach;

    $categoryId = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
    $coach->setCategoryId($categoryId); var_dump($categoryId);

    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
    var_dump($price = number_format($price, 2));
    $coach->setPrice($price);

    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $coach->setPhone($phone);

    $titleMsg = filter_input(INPUT_POST, 'titleMsg', FILTER_SANITIZE_STRING);
    $coach->setTitleMsg($titleMsg);

    $textMsg = filter_input(INPUT_POST, 'textMsg', FILTER_SANITIZE_STRING);
    $coach->setTextMsg($textMsg);
    
    if($coach->becomeCoach($userId)){
        $_SESSION['coachStatus'] = 1;
        $success = 'Uspješno ste se oglasili';
        header('Location: profile.php?success=' . $success);
    }
}

/* Change Category */
if(isset($_GET['saveCategory'])){
    $coach = new Coach;

    $coachId = $template->coach->coachId;
    $categoryId = filter_input(INPUT_GET, 'newCategory', FILTER_SANITIZE_STRING);
    $column = 'categoryId';

    if($coach->changeCoachInfos($coachId, $column, $categoryId)){
        $success = 'Uspješno ste promijenili vašu kategoriju';
        header('Location: profile.php?success=' . $success);
    }
}

/* Change Phone */
if(isset($_GET['savePhone'])){
    $coach = new Coach;

    $coachId = $template->coach->coachId;
    $phone = filter_input(INPUT_GET, 'newPhone', FILTER_SANITIZE_STRING);
    $column = 'phone';

    if($coach->changeCoachInfos($coachId, $column, $phone)){
        $success = 'Uspješno ste promijenili vaš broj telefona';
        header('Location: profile.php?success=' . $success);
    }
}

/* Change Price */
if(isset($_GET['savePrice'])){
    $coach = new Coach;

    $coachId = $template->coach->coachId;
    $price = filter_input(INPUT_GET, 'newPrice', FILTER_SANITIZE_STRING);
    $price = number_format($price, 2);
    $column = 'price';

    if($coach->changeCoachInfos($coachId, $column, $price)){
        $success = 'Uspješno ste promijenili vašu cijenu';
        header('Location: profile.php?success=' . $success);
    }
}

/* Change Title */
if(isset($_GET['saveTitle'])){
    $coach = new Coach;

    $coachId = $template->coach->coachId;
    $title = filter_input(INPUT_GET, 'newTitle', FILTER_SANITIZE_STRING);
    $column = 'titleMsg';

    if($coach->changeCoachInfos($coachId, $column, $title)){
        $success = 'Uspješno ste promijenili naslov vaše poruke';
        header('Location: profile.php?success=' . $success);
    }
}

/* Change Message TExt */
if(isset($_GET['saveText'])){
    $coach = new Coach;

    $coachId = $template->coach->coachId;
    $text = filter_input(INPUT_GET, 'newText', FILTER_SANITIZE_STRING);
    $column = 'textMsg';

    if($coach->changeCoachInfos($coachId, $column, $text)){
        $success = 'Uspješno ste promijenili sadržaj vaše poruke';
        header('Location: profile.php?success=' . $success);
    }
}

if($_SESSION['coachStatus'] == 1)
$template->notes = Coach::getNotes($userId); // Print out all notes for particular coach

/* Insert New Note */
if(isset($_GET['saveNote'])){
    $coach = new Coach;

    $noteBody = filter_input(INPUT_GET, 'newNote', FILTER_SANITIZE_STRING);
    $coach->setNoteBody($noteBody);

    if($coach->newNote($userId)){
        header('Location: profile.php');
    }
}

/* Delete Note */
if(isset($_GET['delete-note'])){
    $coach = new Coach;

    $noteId = filter_input(INPUT_GET, 'noteId', FILTER_SANITIZE_STRING);

    if($coach->deleteNote($noteId)){
        header('Location: profile.php');
    }
}

$template->categories = Output::getCategories(); // Print out all categories

$template->unreadedMessages = User::unreadedMessages($userId); // Show unreaded messages

echo $template;
?>