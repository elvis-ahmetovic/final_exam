<?php

// If is Logged In
function isLoggedIn(){
    if(isset($_SESSION['isLoggedIn'])){
        return true;
    }else{
        return false;
    }
}

// If is User set as Admin
function isUserAdmin(){
    if($_SESSION['adminStatus'] == 1){
        return true;
    }else{
        return false;
    }
}

// If Admin is Logged In
function isAdmin(){
    if(isset($_SESSION['admin'])){
        return true;
    }else{
        return false;
    }
}

/* Get age of users */
function getAge($birthDate){
    $birthDate = explode('/', $birthDate);
    $birthYear =  $birthDate[2];
    $date = date('Y');
    $age = date_diff(date_create($birthYear), date_create($date));
    
    return $age->format('%Y');
}

/* Time Difference */
function conversationCreate($dateTime){
    $createTime = new DateTime(date('d-m-Y H:i:s', strtotime($dateTime))); 
    $today = new DateTime(date('d-m-Y H:i:s'));
    $interval = $createTime->diff($today);

    switch($interval){
        case ($interval->format('%Y')>='1'):
            return $interval->format('before %Y year/s');
            break;
        case ($interval->format('%m')>='1'):
            return $interval->format('before %m month/s');
            break;
        case ($interval->format('%d')>='1'):
            return $interval->format('before %d day/s');
            break;
        case ($interval->format('%H')>='1'):
            return $interval->format('before %h hour/s');
            break;
        case ($interval->format('%i')>='1'):
            return $interval->format('before %i minute/s');
            break;
        default:
            return 'now';
            break;
    }
}

// Print Phone Number in Format xxx-xxx-xxx
function printPhoneNum($phone){
    $phone = str_split($phone, 3);

    return $phone[0] . '-' . $phone[1] . '-' . $phone[2];
}
?>