<html>

<head>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Hanalei Fill">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    <link rel="shortcut icon" src="favicon.ico" />
</head>


<body class="body">
    <header>
        <title>Meeple Like Us</title>
        <div class="navbar">
            <a href="index.php" class="title"><img src="logo.png" class="logo">Meeple Like Us</a>
            <span class="username">
                <?php
                    session_start();
                    if (isset($_SESSION["username"])){
                        echo "hi " . $_SESSION["username"];
                        echo '<button><a class="logoutButton" href="logout.php"> LOGOUT </a></button>';
                        // echo '<div>' . phpversion() . '</div';
                    } else{
                        echo '<a href="login.php">Sign In</a>';
                    }
                ?>
            </span>
        </div>
    </header>

    <?php
    require_once("Dao/eventDao.php");
    require_once("Dao/scheduleDao.php");
    
    $eventDao = new eventDao();
    $events = $eventDao->getFutureEvents();
    
    $scheduleDao = new scheduleDao();
    
    foreach ($events as $event){
        $attendees = $scheduleDao->getAttendees($event_id);
        $seats = '';
        foreach ($attendees as $attendee) {
            $seats .= '<div class="circle"></div>';
        }
              
       echo <<<HTML
<div class="gameListCard gameContainer">
    <div class="profile">
        <span class="avatar"></span>
        <p>User #{$event['host_user_id']}</p>
    </div>
    <div class="gameInfo">
        <span class="gameTitle">{$event['game']}</span>
        <p>{$event['location']}</p>
        <p>{$event['date']}</p>
        <p>{$event['players']} Players</p>
    </div>
    <div class="seating">
        <div>
            {$seats}
        </div>
        <form method="POST">
            <button type="submit" class="join" >Join</button>
        </form>
    </div>
</div>
HTML;
    }

    ?>
    <a href="newGame.php">
        <img src="img/add.png" class="addGame">
    </a>

    <footer>
        <div class="footerbar">
            Meeple Like Us 	&copy; by Lanh Nguyen
            </button>
        </div>
    </footer>

</body>

</html>