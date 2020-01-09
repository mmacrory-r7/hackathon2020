<!DOCTYPE html>
<html>
  <head>
    <title>Same Site Cookie Attribute - Print Headers Function</title>
    <meta charset="utf-8">
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
        <h1>Recieved From Browser:</h1>
      </div>
    </div>
<?php
    $headers = getallheaders();
    foreach($headers as $header)
    {
        echo $header;
        echo "<br>";
    }
?>
  </body>
</html>