<!DOCTYPE html>
<html>
    <head>
        <title> File Inclusion </title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css">
    </head>
​
    <body class="body1">
        <div id="content">
            <div id="header" class="ui-dark-header">
                <div id="r7-logo">
                    <a href="../../index.html"><img class="logo" src="../../resources/images/Rapid7_logo.png"></a>
                </div>
            </div>
​       </div>
        <div id="main">
            <div id="launch" class="launchSuite">
                <h1> File Inclusion </h1>
                <h2> About this page: </h2>
                <p>
                The File Inclusion vulnerability allows an attacker to include a file, 
                usually exploiting a "dynamic file inclusion" mechanisms implemented in 
                the target application. The vulnerability occurs due to the use of 
                user-supplied input without proper validation. This can lead to something 
                as outputting the contents of the file, but depending on the severity, it 
                can also lead to: 
                <br><br>>Code execution on the web server 
                <br>>Code execution on the client-side such as JavaScript which can lead to other attacks such as cross site scripting (XSS) 
                <br>>Denial of Service (DoS) 
                <br>>Sensitive Information Disclosure
                </p>
                <form>
                    <label for="url">Sitename:</label>
                    <input type="text" id="url" name="url">
                    <input type="submit" value="Upload">
                    <br><br><br>
                </form>
                <?php
                $url = $_GET['url'];
                if (isset ($url)) { 
                echo '<iframe name="Framename" src="'.urldecode($url).'" width="1000" height="400" frameborder="0" scrolling="auto" class="frame-area"></iframe>';
                } else { // display a static page if no url parameter was received
                echo '<iframe name="Framename" src="http://demo.testfire.net/" width="1000" height="400" frameborder="0" scrolling="auto" class="frame-area"></iframe>';
                }
                ?>
            </div>
        </div>
    </body>
</html>