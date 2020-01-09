<!DOCTYPE html>
<html>
    <head>
        <title> Unvalidated Redirect </title>
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
                <h1> Unvalidated Redirect </h1>
                <h2> About this page: </h2>
                <p>
                Unvalidated redirects are possible when a web application accepts untrusted input that could 
                cause the web application to redirect the request to a URL contained within untrusted input. 
                By modifying untrusted URL input to a malicious site, an attacker may successfully launch a 
                phishing scam and steal user credentials. Because the server name in the modified link is 
                identical to the original site, phishing attempts may have a more trustworthy appearance. 
                Unvalidated redirect can also be used to maliciously craft a URL that would pass the 
                application's access control check and then forward the attacker to privileged functions that 
                they would normally not be able to access.
                </p>

                <form>
                    <label for="url">URL:</label>
                    <input type="text" id="url" name="url">
                    <input type="submit" value="Go">
                </form>

                <script>
                    response.sendRedirect(request.getParameter("url"));
                </script>

                <?php
                $redirect_url= $_GET['url'];
                header("Location: " .$redirect_url);
                ?>

            </div>
        </div>
    </body>
</html>