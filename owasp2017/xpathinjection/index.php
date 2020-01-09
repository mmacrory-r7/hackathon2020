<!DOCTYPE html>
<html>
    <head>
        <title> XPath Injection page </title>
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
        <h1> XPath Injection Page</h1>
        <h3> About this page:</h3>
        <p>
            XPath Injection is an attack technique used to exploit applications that construct XPath queries from user-supplied
            input to query or navigate XML documents. Malicious input can lead to unauthorised access or 
            exposure of sensitive information such as structure and content of XML document.
            <br>
            On this page the XPath Injection is taking place through the login field, by using a query ABCD' or '*'. This will 
            bypass authentication and allow unauthorised access to potentially sensitive data.
        </p>
        <hr>
        <h2> Login</h2>
        <form action= "..//xpathinjection/formhandler.php" method ="post">

        <label for="username">Username:</label>
        <input type="text" id="username" name="uname">
        <label for="password">Password:</label>
        <input type="password" id="password" name="pwd">

        <input type="submit" value="Submit">
        <hr>
            </div>
        </div>
    </body>
</html>