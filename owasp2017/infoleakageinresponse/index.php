<!DOCTYPE html>
<HTML>
    <head>
        <title> Information Leakage In Response</title>
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

            <h1> Information Leakage In Response</h1>
                    <p>
                    Information Leakage (CWE-200) is a category of software vulnerabilities in which information is unintentionally 
                    disclosed to end-users, potentially aiding attackers in their efforts to breach application security. The key 
                    criteria for Information Leakage is that the exposure is  unintentional and useful to attackers. Information 
                    Leakage is different than the failure to protect sensitive information at rest and in-transit.  This is a 
                    legitimate concern, and involves the exposure of any sensitive data stored and processed by the application.  
                    Information Leakage involves the exposure of information that would facilitate attacks on the application or 
                    other infrastructure, such as insight into the application design, deployment, or organizational details. 
                    <br> <br>
                    This vuln only works when ran on windows.
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
                 if ($uname != "" && $password != "") {
                     echo "logged in";
                 } else {
                    echo "Invalid username and password";
                 }
                 ?>

                <!--?php 
                /*if(isset($_POST['but_submit'])) {
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
                ?>*/ -->
        </body>
    </html> 