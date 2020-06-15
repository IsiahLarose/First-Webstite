<head>
    <title>My site</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
require("config.php");
session_start();
?>
<p>
    Welcome to my Simple Survey!
</p>
<img src="https://drive.google.com/file/d/1nnHCwmO06JtuPlUIy3wbiC6WQw03J4SK/view?usp=sharing" alt="Thinking">
<nav>
    <ul>
        <li>
            <a href="home.php"> Home </a>
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
