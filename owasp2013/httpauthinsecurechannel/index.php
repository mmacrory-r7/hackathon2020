<!DOCTYPE html>
<html>
    <head>
        <title> HTTP Authentication over Insecure Network </title>
        <meta charset="utf-8">
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
            <div id="launch" class="launchSuite">
                <h1> HTTP Authentication over Insecure Network </h1>
                <p>
                In the context of an HTTP transaction, basic access authentication is a method for an HTTP user 
                agent to provide a user name and password when making a request. This directory is protected using 
                Basic Authentication over an HTTP connection. With Basic Authentication the user credentials are 
                sent as cleartext and because HTTPS is not used, they are vulnerable to packet sniffing.
                </p>
                <div id="container">
                    <h2> Login form: </h2>
                    <form action="../httpauthinsecurechannel/formhandler.php" method="get">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="uname">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="pwd">

                    <input align="center" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </body>
    </head>
</html>