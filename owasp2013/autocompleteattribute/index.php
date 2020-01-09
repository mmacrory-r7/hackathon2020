<!DOCTYPE html>
<html>
    <head>
        <title> 
        Autocomplete Attribute
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
        <div id="main">
            <div id="launch" class="launchSuite">
                <h1> Autocomplete Attribute </h1>
                <h2> About this page: </h2>
                <p>
                The autocomplete attribute specifies whether or not an input field should have autocomplete enabled.
                Autocomplete allows the browser to predict the value. When a user starts to type in a field, the 
                browser should display options to fill in the field, based on earlier typed values.
                <br>
                In this page, the password field in the form will be vulnerable due to being an autocompleted attribute.
                <br>
                <br> 
                </p>
                <div id="container">
                    <form method="POST">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" autocomplete="on">
                        <div id="lower">
                            <input type="submit" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
<html>

