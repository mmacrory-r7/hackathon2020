<html>
<body>
  Your username is: <?php echo $_GET["uname"]; ?>
  Your password is: <?php echo $_GET["pwd"]; ?>
  Your email is: <?php echo $_GET["em"]; ?>

  <?php
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Text to send if user hits Cancel button';
        exit;
    } else {
        echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
        echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
    }
  ?>

</body>
</html>