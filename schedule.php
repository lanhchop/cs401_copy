<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $q = $_SERVER['QUERY_STRING'];
    $x = 4;

    // $valid = true;

    // if ($valid) {
    //     require_once 'Dao/userDao.php';
    //     $userDao = new userDao();
    //     $userId = $userDao -> createUser($name, $username, $password);

    //     session_start();
    //     $_SESSION['username'] = $username;
    //     $_SESSION['userId'] = $userId;

    //     echo "An account has been successfully created!";
    //     header("Location: index.php");
    // }
}