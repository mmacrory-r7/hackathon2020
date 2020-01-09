<!DOCTYPE html>
<html>
    <head>
        <title> Sensitive Data Exposure </title>
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
                <h1> Sensitive Data Exposure Page </h1>
                <h2> About this page: </h2>
                <p>
                    <br>
                    <br>
                    sensitive data exposure occurs when an application or program, does not adequately protect
                    information such as passwords, payment info, or health data. With this information, 
                    cybercriminals can make fraudulent purchases, access a victim’s personal accounts, or even 
                    personal blackmail.
                    <br>
                    In this case, the page included a form with a POST request to trigger a form re-submission 
                    from the browser cache.
                    <br>
                    <br>
                </p>
                <form method="post" id="username">
                    <label> Username</label>
                    <input type="text" placeholder="Username: " name="uname">
                    <input type="submit" value="Search" name="search">
                </form>
            </div>
        </div>
    </body>
</html>