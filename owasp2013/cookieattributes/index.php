<!DOCTYPE html>
<html>
  <head>
    <title>Cookie Attributes Page</title>
    <meta charset="utf-8">
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
           <h2>Cookie Attributes Test Page</h2>
                <p>
                    This page is vulnerable as the HTTP-only cookie attribute is set to false, and therefore
                    cookies are vulnerable and can be stolen as they are sent over HTTP and are not secure.
                    <br>
                    <br>
                    The cookie is automatically applied when this page is opened.
                    <br>
                    <br>
                    Please ensure cookies are cleared before opening this page to avoid a false positive.
                </p>
       </div>
    </div>
  </body>
</html>

<?php
setcookie("cookie", "cookie_value", time() + (86400 * 30), "/", null, false, false);
?>