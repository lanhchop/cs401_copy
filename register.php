<?php
session_start();
$_SESSION['username']=$_POST["username"];

// $query = sprintf("",
//             mysqli_real_escape_string($_POST["name"]),
//             mysqli_real_escape_string($_POST["username"]),
//             mysqli_real_escape_string($_POST["password"]));

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $valid = true;

    if (empty($name) || strlen($name) < 1) {
        $nameError = "Please enter your name";
        $valid = false;
    }
    if (empty($username) || strlen($username) < 1) {
        $usernameError = "Please enter a new username";
        $valid = false;
    }
    if (empty($password) || strlen($password) < 6) {
        $passwordError = "Please enter a password with more than 6 characters";
        $valid = false;
    }

    if ($valid) {
        require_once 'Dao/userDao.php';
        $userDao = new userDao();
        $userId = $userDao -> createUser($name, $username, $password);

        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $userId;

        echo "An account has been successfully created!";
        header("Location: index.php");
    }
}



// TODO insert stuff into a user table in the database..
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
        <a href="index.php" class="title"><img src="logo.png" class="logo"></img>Meeple Like Us</a>
    </div>
</header>

<body class="body">
    <div class="card">
        <div class="loginCard">
            Create Account
        </div>
        <form method="POST" action="register.php">
            <label>
                Name
                <?php
                echo "<input name=\"name\" class=\"input\" value=\"{$name}\">";
                echo "<div class=\"error\" >{$nameError}</div>";
                ?>
            </label>
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
            <button class="register">
                <a href="login.php">sign in</a>
            </button>
            <button type="submit" class="loginButton">
                okay
            </button>
        </form>
    </div>
</body>

</html>