<!DOCTYPE html>
<HTML>
    <head>
        <title> Bowser Cache Info Module </title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css">
        <meta http-equiv=”Cache-Control” content=”public” />
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

                <h1> Browser Cache Directive</h1>
                <p>
                Browser cache is a temporary storage area in memory or on disk that holds the most recently downloaded 
                Web pages. As you jump from Web page to Web page, caching those pages in memory lets you quickly go back
                to a page without having to download it from the Web again. In order to ensure that the latest page is 
                displayed, the browser compares the dates of the cached page with the current Web page. If the Web page 
                has not changed, the cached page is displayed immediately. If the Web page has changed, it is downloaded, 
                displayed and cached.
                <br>
                When you quit the browser session, the cached pages are stored on disk. Settings in your Web browser let 
                you set the amount of space to use for the cache, which is essentially a disk folder, and the length of 
                time to hold the pages.
                <br>
                The browser cache can store sensitive information such as what is happening in this page. This is bad 
                practice as it can lead to the leaking of sensitive information.
                </p>

                <div id="container">
                    <form>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                            <div id="lower">
                                <input type="submit" value="Login">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>