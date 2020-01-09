<!DOCTYPE html>
<html>
    <head>
        <title> SQL Parameter Check </title>
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
                <h1> SQL Parameter Check </h1>
                <h2> About this page: </h2>
                <p>
                If the database injection attack can be used to read arbitrary data, then users' stored information 
                such as authentication credentials, e-mail address, social security number, or financial information
                will be exposed. Some databases provide methods for executing system commands via SQL queries. Thus, 
                a successful injection attack could compromise the database host and other hosts on its local network 
                even if they are protected from the Internet by a firewall. a firewall.
                </p>
                <div id="container">
                    <form action='formhandler.php' method='GET'>
                        <div id="div_login">
                            <h2> Login </h2>
                            <div>
                                <input type="text" id="txt_uname" name="query" value="SELECT * FROM accounts WHERE name = 'admin'" />
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
            </body>
        </html>