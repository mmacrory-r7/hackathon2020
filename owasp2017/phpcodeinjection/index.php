<!DOCTYPE html>
<html>
    <head>
        <title>
            PHP Injection Page
        </title>
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
        <div id ="main">
            <div id="launch" class="launchSuite">
                <h1> PHP Injection Code</h1>
                <h2> About this page:</h2>
                <br>
                <p>
                PHP code injection vulnerability allows the attacker to insert malicious PHP code straight
                into a program/script from some outside source. Added code is a part of the application 
                itself with the same permissions as application.
                <br>
                <br>
                This is a sample php script to Input a ID number and print some output , This script doesn't 
                contain sanitizing or filtering code which makes it prone to Arbitrary Code Injection vulnerability.
                </p>
                <br>
                <table>
                    <form method="GET">
                        <h3>Input</h3>
                        <input type="text" name="command" value="command"/><br><br>
                        <!--input type="submit" name="submit" class="own" value="Submit"/-->
                    </form>
                </table>
                <br>
                <hr>
                <br>
                <h3>Output</h3>
                <?php                  
                    $command = str_replace('\'', "", $_GET['command']);
                    $command = str_replace(".", "", $command);
                    $output = eval($command.';');
                    echo $output;
                ?>
            </div>
        </div>
    </body>
</html>
