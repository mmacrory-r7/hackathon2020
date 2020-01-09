<!DOCTYPE html>
<html>
    <head>
        <title> Local Storage Usage </title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css">
    </head>

    <script>
        window.localStorage.setItem('name', 'Meabh');
        window.localStorage.getItem('name');
    </script>

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

                <h1> Local Storage Usage </h1>
                <h2> About this page: </h2>
                <p>
                LocalStorage is a type of web storage that allows Javascript websites and apps to store and 
                access data right in the browser with no expiration date. This means the data stored in the 
                browser will persist even after the browser window has been closed.
                <br> <br>
                Please note: Chrome automatically rejects Local Stroage Usage, so for the vuln to be triggered,
                as a result when running in AppSpider you MUST specify Internet Explorer as the browser to be 
                used.
                </p>
            </div>
        </div>
    </body>
</html>