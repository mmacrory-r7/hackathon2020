<!DOCTYPE html>
<HTML>
    <head>
        <title> Informatiom Disclosure in Scripts </title>
       <!-- <meta charset="utf-8"> -->
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
                <h1> Information Disclosure in Scripts </h1>
                <h2> About this page: </h2>
                <p>
                Information disclosure is when an application fails to properly protect sensitive and 
                confidential information from parties that are not supposed to have access to the subject
                matter in normal circumstances. These type of issues are not exploitable in most cases, 
                but are considered as web application security issues because they allows malicious hackers
                to gather relevant information which can be used later in the attack lifecycle, in order to 
                achieve more than they could if they didn’t get access to such information.
                </p>
                    <script>
                        xhttp.open("GET","http://172.16.233.142/owasp2017/informationdisclosure/index.php/", true);
                    </script>
                    <?php
                    
                    #IP address is 172.16.233.143 
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>