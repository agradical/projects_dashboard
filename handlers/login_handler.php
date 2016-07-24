<?php

$login = 1;
include('../application.php');

if(isset($_POST)) {
    
    $arr = array('success'=>0);
    if(isset($_POST['type']) && $_POST['type'] == 'signup') {
        $username = $_POST['username'];
        $password = $_POST['passowrd'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        
        $user = new User();
        $user_id = $user->registerNewUser($username, $password, $firstname, $lastname);
        
        if ($user_id) {
            $arr = array('success'=>1);
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
        
            $user->registerNewSession($user_id, session_id());
        }
        
    }

    else if(isset($_POST['type']) && $_POST['type'] == 'login') {
        $username = $_POST['username'];
        $password = $_POST['passowrd'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        
        $user = new User();
        $user_id = $user->checkCredentials($username, $password);
        
        if ($user_id) {
            $arr = array('success'=>1);
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
        
            $user->registerNewSession($user_id, session_id() );
        }
    }
    else {
        
    }
 
    header('Content-Type: application/json');
    echo json_encode($arr);
}

?>
