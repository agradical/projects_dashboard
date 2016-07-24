<?php

session_start();

require_once('classes/DB.php');
require_once('classes/User.php');
require_once('classes/Project.php');

$DB = new DB();

$conn = $DB->getConnection();

$name = '';

if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}

if (!isset($login)) {
    if(isset($_SESSION) && isset($_SESSION['username'])) {
        $user = new User($_SESSION['username']);
        $name = $user->firstname;
    }
    else {
        header('Location: /project/home.php');
        exit();
    }
}

?>
