<head>
    <title>My site</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
require("config.php");
session_start();
?>
<nav>

    <ul>
        <p>
            Welcome to my Simple Survey!
        </p>
        <li>
            <a href="home.php" Home </a>
        </li>
        <li>
            <a href="login.php">Login</a>
        </li>
        <li>
            <a href="register.php">Register</a>
        </li>
        <li>
            <a href="logout.php">Logout</a>
        </li>
    </ul>
</nav>
