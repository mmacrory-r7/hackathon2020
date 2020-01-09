<!DOCTYPE html>
<html>
    <head>
        <title> SQL Information Leakage </title>
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

            <h1> SQL Information Leakage </h1>
            <h2> About this page:</h2>
            <p>
            Revealing system data or debugging information helps an adversary learn about the system and form a
            plan of attack. An information leak occurs when system data or debugging information leaves the program 
            through an output stream or logging function. In this case, the source of the leak is in an SQL query.
            </p>
            <div id="container">
                <form method="post">
                    <div id="div_login">
                        <h2>Login</h2>
                        <div>
                            <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" value="SELECT * FROM users WHERE name = 'admin'" />
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

                <?php

                $host = "localhost"; /* host name*/
                $user = "root"; /* User */

                $con = mysqli_connect($host, $user);

                if(isset($_POST['but_submit'])) {
                    
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
                            header('Location: index.php');
                        }
                        else
                        {
                            echo "Access denied for user:", 'user';
                        }
                    }
                }

                ?>

            </div> 
        </div>
    </body>
</html>