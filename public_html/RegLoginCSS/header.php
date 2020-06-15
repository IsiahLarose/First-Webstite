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
<img width="100" height="200" src="https://cliply.co/wp-content/uploads/2019/09/391909180_THINKING_FACE_400px.gif">
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
