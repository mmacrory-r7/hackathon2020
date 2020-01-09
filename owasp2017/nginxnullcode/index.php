<!DOCTYPE html>
<html>
    <head>
        <title> Nginx Null Code </title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css">
    </head>

    <body class="body1">
        <div id="context">
            <div id="header" class="ui-dark-header">
                <div id="r7-logo">
                    <a href="../../index.html"><img class="logo" src="../../resources/images/Rapid7_logo.png"></a>
                </div>
            </div>
        </div>
        <div id="main">
            <div id="launch" class="launchSuite">
                <h1> Nginx Null Code </h1>
                <h2> About this page: </h2>
                <p>
                The Embedding NULL Bytes/characters technique exploits applications that don’t properly handle 
                postfix NULL terminators. It is used as a technique to perform other attacks, like directory 
                browsing, path traversal, SQL injection, execution of arbitrary code, among others. It can be 
                found lots of vulnerable applications and exploits available to abuse systems using this 
                technique.
                </p>
                <h2> Instructions </h2>
                    <h3> Step One: </h3>
                    <p>
                       Download NGINX on your server. https://www.maketecheasier.com/install-nginx-server-windows/
                       When selecting a version to download, <mark>choose nginx-0.7.69 pgp</mark> as any versions more recent 
                       than this automatically protect against this vulnerability.
                    </p>
                    <h3> Step Two: </h3>
                    <p>
                        Download PHP. As the NGINX version is specific to an older version, the php must be compatible. 
                        Download version 5.3.6 og PHP from 19/03/2011.
                    </p>
                    <h3> Step Three: </h3>
                    <p>
                    Create a page hosted locally, which contains a <b>user defined php include</b> that allows the 
                    attacker to provide an arbitrary file via the URL query string. This file will then be included
                    without any validation by the php section of the code.<br><br>
                    The php code could resemble the following snippet:<br>
                    <mark>&lt;?php <br> 
                    $whatever = addslashes($_REQUEST['whatever']); <br>
                    include("/path/to/program/" . $whatever . "/header.htm");<br>
                    ?>
                    </mark> <br> which would result in the following url: <br>
                    <b>http://vuln.example.com/phpscript.php?whatever=../../../etc/passwd<mark>%00</mark> </b><br>
                        Note the <b>%00</b> at the end of the URL. This is the null character string which will trigger the vulnerability.
                    </p><br>
                    <h3> Note: </h3>
                    <p>
                     The reason that we have not created this page in the same way as we have the others is due to the need for a certain PHP 
                     version to run this page, it would result in the entire site having to be run on this previpus version of PHP. This is not 
                     feasible as the majority of the pages hosted on this site require the most recent version of php in order to work properly.
                    </p>
            </div>
        </div>
    </body>
</html>