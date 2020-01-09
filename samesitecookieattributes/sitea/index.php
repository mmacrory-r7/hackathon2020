<?php
setcookie("cookie1", "WithoutSameSite", array("expires" => mktime().time()+60*60*24*30, "secure" => false));
setcookie("cookie2", "SameSiteNone",    array("expires" => mktime().time()+60*60*24*30, "secure" => false, "samesite" => "none"));
setcookie("cookie3", "SameSiteStrict",  array("expires" => mktime().time()+60*60*24*30, "secure" => false, "samesite" => "strict"));
setcookie("cookie4", "SameSiteLax",     array("expires" => mktime().time()+60*60*24*30, "secure" => false, "samesite" => "lax"));
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Same Site Cookie Attribute - Site A</title>
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

        <h1>Same Site Cookie Attribute - Site A</h1>
        This site is setting 4 cookies:
        <br>
          
        <ol>
          <li>Cookie without SameSize attribute</li>
          <li>Cookie with SameSite=None</li>
          <li>Cookie with SameSite=Stirct</li>
          <li>Cookie with SameSite=Lax</li>
        </ol>
        Please click on the link below:
        <br>
          <!--a href="http://samesiteb.test/index.php">Another page that links to this site</a-->
         <a href="samesitecookieattributes/siteb/index.php">Another page that links to this site</a>
      </div>
    </div>
  </body>
</html>