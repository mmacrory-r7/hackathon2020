<!DOCTYPE html>
<html>
    <head>
        <title> Session Fixation </title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css">
    </head>

    <?php
    session_start();
    ?>
    
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
                <h1> Session Fixation </h1>
                <p>
                As we know different users have unique session ID when an attacker sniff the session 
                via man-in-middle attack or via XSS and steal session ID or session token this is 
                called session hijacking. When an attacker sends the stealing session ID to the web 
                server, server match that ID from database stored session ID. If they both matched 
                to each other then the server reply with HTTP 200 OK and attacker get successfully 
                access without submitting proper Identification.
                <br><br>
                This page has a cookie containing the session ID which makes it vulnerable to session 
                fixation.
                </p>
                <form method="post">
                    <div id="div_login">
                        <h2>Login</h2>
                            <div>
                                <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />
                            </div>
                            <br>
                            <div>
                                <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" placeholder="Password" />
                            </div>
                            <br><br>
                            <div>
                                <input type="submit" value="Submit" name="but_submit" id="but_submit" />
                            </div>
                    </div>
                </form>
            </div>
            <?php 
                if(isset($_POST['but_submit'])) {
                    include "config.php";

                    $uname = mysqli_real_escape_string($con,$_POST['txt_uname']);
                    $password = mysqli_real_escape_string($con, $_POST['txt_pwd']);

                    if ($uname != "" && $password != "") {

                        $sql_query = "select count(*) as cntUser from users where username='".$uname."' and password='".$password."'";
                        $result = mysqli_query($con,$sql_query);
                        $row = mysqli_fetch_array($result);
                    
                        $count = $row['cntUser'];

                        if($count > 0)
                        {
                            $_SESSION['uname'] = $uname;
                            header('Location: home.php');
                        }
                        else
                        {
                            echo "Invalid username and password";
                        }
                    }
                }
                ?>
        </div>
        <script>
            document.cookie="sessionid=1234";
        </script>
    </body>
</html>