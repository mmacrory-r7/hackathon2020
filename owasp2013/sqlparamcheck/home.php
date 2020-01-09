<!DOCTYPE html>
<html>
    <head>
        <title> SQL Parameter check </title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css">
    </head>

    <body class="body1">
        <div id="content">
            <div id="header" class="ui-dark-header">
                <div id="r7-logo">
                    <a href="../../index.html"><img class="logo" src="../../resources/images/Rapid7_logo.png"></a>
                </div>
            </div>
        </div>
        <div id="main">
            <div id="launch" class="launchSuite">
                <h1> Home Page: </h1>
                <form method='post' action=" ">
                    <input type="submit" value="Logout" name="but_logout">
                </form>
            </div>
        </div>
    </body>
</html>
<?php
include "config.php";

//check user login or not
if(!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

//logout
if(isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
}

?>

