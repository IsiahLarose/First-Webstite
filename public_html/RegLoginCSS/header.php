<head>
    <title>
        IT 202 Simple survey
    </title>
    <link rel="stylesheet" style="text/css" href="style.css">
</head>
<style>
    .center {
        text-align-last: center;
        border: 2px solid black;
    }
    li {
        float: center;
    }

    a {
        display: block;
        padding: 8px;
        background-color: none;
    }
    ul {
        list-style-type: center;
        margin: 0;
        padding: 8px;
    }
</style>
<?php
    require("config.php");
    session_start();
?>
<nav>
    <ul>
        <li>
            <a href="home.php">Home</a>
        </li>
        <li>
            <a href="login.php">login</a>
        </li>
        <li>
            <a href="register.php">register</a>
        </li>
        <li>
            <a href="logout.php">logout</a>
        </li>
    </ul>
</nav>