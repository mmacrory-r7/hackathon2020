<!DOCTYPE html>
<HTML>
    <head>
        <title> Brute Force(Form Authentication)</title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css">
    </head>

    <body class="body1">
    <div id="content" >
       <div id="header" class="ui-dark-header">
         <div id="r7-logo">
           <a href="../../index.html"><img class="logo" src="../../resources/images/Rapid7_logo.png"></a>
         </div>
       </div>
    </div>
    <div id="main">
       <div id="launch" class="launchSuite">

            <h1> Brute Force (Form Authentication) Page </h1>
                    <p>
                        This page is succeptable to brute form attacks on form authentication. The password has no length or complexity
                        requirements and the number of login attempts is not limited nor tracked. The page includes no capthca and does 
                        not require multi-factor authentication.
                    </p>
                <div id="container">
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
        </body>
    </html> 