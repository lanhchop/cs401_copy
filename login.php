<?php


// $query = sprintf("",
//     mysqli_real_escape_string($_POST["username"]),
//     mysqli_real_escape_string($_POST["password"]));

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $valid = true;
    if (empty($username) || strlen($username) < 1) {
        $usernameError = "Please enter a username";
        $valid = false;
    }
    if (empty($password) || strlen($password) < 5) {
        $passwordError = "The password is incorrect. Please try again.";
        $valid = false;
    }

    if ($valid) {
        require_once 'Dao/userDao.php';
        $userDao = new userDao();
        $userRecord = $userDao -> getUser($username);
        if (!$userRecord || $userRecord["password"] !==$password) {
            $noUserError = "The username or password was incorrect.";
        } else {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $userRecord['user_id'];
            echo "You have been successfully signed in.";
            header("Location: index.php");
        }
    }
}

?>

<html>

<head>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Hanalei Fill">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    <link rel="shortcut icon" src="favicon.ico" />
</head>

<header>
    <title>Meeple Like Us</title>
    <div class="navbar">
        <a href="index.php" class="title"><img src="logo.png" class="logo">Meeple Like Us</a>
    </div>
</header>

<body class="body">
    <div class="card">
        <div class="loginCard">
            Sign In
        </div>
        <form method="POST" action="login.php">
            <label>
                Username
                <?php
                    echo "<input name=\"username\" class=\"input\" value=\"{$username}\">";
                    echo "<div class=\"error\">{$usernameError}</div>";
                ?>
            </label>
            <label>
                Password
                <?php
                    echo "<input type=\"password\" name=\"password\" class=\"input\">";
                    echo "<div class=\"error\">{$passwordError}</div>";
                ?>
            </label>
            <?php
                echo "<div class=\"error\">{$noUserError}</div>";
            ?>
            <button class="register">
                <a href="register.php">
                    register
                </a>
            </button>
            <button type="submit" class="loginButton">
                okay
            </button>
        </form>
    </div>
</body>

</html>