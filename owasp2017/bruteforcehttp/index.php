<!DOCTYPE html>
<HTML>
    <head>
        <title> Brute Force(HTTP Authentication)</title>
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

            <h1> Brute Force (HTTP Authentication) Page </h1>
                    <p>
                        This page is succeptable to brute form attacks on HTTP authentication. The page is not protected with HTTP Basic Authentication and 
                        is therefore vulnerable to various types of brute force attacks.
                    </p>
                <div id="container">
                    <form>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                            <div id="lower">
                                <input type="submit" value="Login">
                            </div>
                    </form>
                 </div>
                </div>
             </div>
        </body>
    </hmtl>