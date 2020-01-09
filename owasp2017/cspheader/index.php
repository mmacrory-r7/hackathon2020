<!DOCTYPE html>
<html>
    <head>
        <title> Content Security Policy Header </title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css">
    </head>
    
    <body class="body1">
         <meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src https://*; child-src 'none';">
        <div id="content">
            <div id="header" class="ui-dark-header">
                <div id="r7-logo">
                    <a href="../../index.html"><img class="logo" src="../../resources/images/Rapid7_logo.png"></a>
                </div>
            </div>
        </div>
        <div id="main"> 
            <div id="launch" class="launchSuite">

                <h1> Content Security Policy Header </h1>
                <p>
                Content Security Policy (CSP) is an added layer of security that helps to detect and mitigate 
                certain types of attacks, including Cross Site Scripting (XSS) and data injection attacks. These attacks 
                are used for everything from data theft to site defacement to distribution of malware. The HTTP 
                Content-Security-Policy response header allows web site administrators to control resources the user agent 
                is allowed to load for a given page. With a few exceptions, policies mostly involve specifying server 
                origins and script endpoints. This helps guard against cross-site scripting attacks (XSS).
                </p>
            </div>
        </div>
    </body>
</html>