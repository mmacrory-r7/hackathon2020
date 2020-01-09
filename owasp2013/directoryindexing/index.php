<!DOCTYPE html>
<html>
    <head>
        <title> Directory Indexing </title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css">
    </head>
    <body class="body1">
        <div id="content">
            <div id="header" class="ui-dark-header">
                <div id="r7-logo">
                    <a href="../index.html"><img class="logo" src="../../resources/images/Rapid7_logo.png"></a>
                </div>
            </div>
        </div>
        <div id="main">
            <div is="launch" class="launchSuite">
                <h1> Directory Indexing </h1>
                <h2> About this page: </h2>
                <p> 
                When a user types in a request for a page on a web site, the web server processes the request, 
                searches the web document root directory for the default file name, and then sends this page 
                to the user. If the server cannot find the page, it will issue a directory listing and send the 
                output in HTML format to the user. This action allows the contents of unintended directory 
                listings to be disclosed to the user because of software vulnerabilities combined with a specific 
                web request. This information leak can provide an attacker with the information necessary to launch 
                further attacks against the system.
                <br> <br>
                In this case, the vulnerability does not specifically trigger on this page, but rather by the directory
                structure within the main website which can be indexed and traversed by the scan engine, or a potential
                hacker.
                </p>
            </div>
        </div>
    </body>
</html>