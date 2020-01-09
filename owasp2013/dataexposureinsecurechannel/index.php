<!DOCTYPE html>
<html>
    <head>
        <title> Sensitive Data Exposure over Insecure Channel </title>
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
                <h1> Sensitive Data Exposure over Insecure Channel </h1>
                <h2> About this page: </h2>
                <p>
                    <br>
                    Sensitive data such as credit card numbers, social security numbers are sent without using an 
                    encrypted connection. Information sent in clear text is not encrypted and therefore, can be 
                    intercepted. Encrypting the transmission of data makes it difficult to intercept sensitive 
                    information as it travels between two parties. It is recommended to use an encrypted connection 
                    Secure Socket Layer (SSL). In addition, all data sent over an encrypted SSL connection is 
                    protected with a mechanism for detecting tampering. This page exposes this vulnerability by 
                    insecurely sending user input from the form to the form handler page.
                    <br>
                    <br>
                </p>
                <div id="container">
                    <form action="../dataexposureinsecurechannel/formhandler.php" method="get">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="uname">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="pwd">

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="em">
                        <input align="center" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </head>
</html>