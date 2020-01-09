<!DOCTYPE html>
<html>
    <head>
        <title> Parameter Fuzzzing Page</title>
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
            <h1> Parameter Fuzzing Page </h1>
             <p>
            This is the parameter fuzzing home page. Parameter fuzzing is a Black Box software testing technique, which consists in finding 
            implementation bugs using malformed/semi-malfored data injection in an automated fashion.
            </p>
            <div id="container">
                <form method="get" id="pform">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                        <div id="lower">
                            <input type="submit" value="login">
                        </div>
                </form>

                <?php
    /**
    * Check if the 'url' GET variable is set
    * Example - http://localhost/?url=http://testphp.vulnweb.com/images/logo.gif
    */
    if(isset($_GET['username']))
    {
        $username = $_GET['username'];

        /**
        * Send a request vulnerable to SSRF since
        * no validation is being done on $url
        * before sending the request
        */
        $image = fopen($username, 'rb');

        /**
        * Send the correct response headers
        */
        //header("Content-Type: image/png");

        /**
        * Dump the contents of the image
        */
        fpassthru($image);
    }
?>

            </div>
        </div>
    </div>
    </body>
</html>