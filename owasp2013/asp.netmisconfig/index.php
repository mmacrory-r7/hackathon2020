<!DOCTYPE html>
<html>
    <head>
        <title> ASP.NET Misconfiguration </title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css">
    </head>

    <body class="body1">
        <div id="content">
            <div id="header" class="ui-dark-header">
                <div id="r7-logo">
                    <a href="../../index.html"><img class="logo" src="../../resources/images/Rapid7_logo.png"></a>
                </div>
            </div>

            <div id="main">
                <div id="launch" class="launchSuite">
                    <h1> ASP.NET Misconfiguration </h1>
                    <h2> About this page: </h2>
                    <p>
                    There are multiple different types of ASP.NET misconfiguration. This page is detailing 
                    how to expose the debug function. The debug verb supported by IIS web servers can be 
                    manipulated to reveal information about the system and plan a form of attack. The debug
                    verb is intended for debugging or testing a web server, it is not required for web 
                    applications to function. ASP.NET allows remote debugging of web applications, if 
                    configured to do so. By default, debugging is subject to access control and requires 
                    platform-level authentication. If an attacker can successfully start a remote debugging 
                    session, this is likely to disclose sensitive information about the web application and 
                    supporting infrastructure that may be valuable in formulating targeted attacks against 
                    the system.
                    <br><br>
                    As this vulnerability is related to ASP.NET and must be ran on a windows server via IIS,
                    it is not feasible to include a vulnerable page on this site. Below are the instructions
                    on how to set up an ASP.NET application and trigger the ASP.NET Misconfiguration vulnerability.

                    <h2> Instructions </h2>
                    <h3> Step One: </h3>
                    <p>
                        Install Visual Studio 
                    </p>
                    <h3> Step Two: </h3>
                    <p>
                        Open Visual Studio, and from the start window choose <b> Create a new project </b>
                    </p>
                    <h3> Step Three: </h3>
                    <p>
                    On the <b>Create a new project window</b>, enter or type ASP.NET in the search box. After you 
                    apply the language and platform filters, choose the <b>ASP.NET Web Application (.NET Framework)</b> 
                    template, and then choose <b>Next</b>.
                    </p>
                    <h3> Step Four: </h3>
                    <p>
                    In the <b>Configure your new project</b> window, type or enter a name in the <b>Project name</b> 
                    box. Then, choose <b>Create</b>.
                    </p>
                    <h3> Step Five: </h3>
                    <p>
                    In the <b>Create a new ASP.NET Web Application</b> window, select <b>MVC</b> and click <b> Next</b>.
                    </p>
                    <h3> Step Six: </h3>
                    <p>
                    Now that the project is created, navigate to the <b>Solution Explorer</b>. Open the <b>Views</b> folder,
                    continue to the <b>Shared</b> folder and open the <b>Web.config file</b>.
                    </p>
                    <h3> Step Seven: </h3>
                    <p>
                        In the <b>Web.config</b> file, navigate to the compilation line and ensure debug is set to true 
                        <b><mark>&lt;complilation debug="true"&gt;<mark></b>. This will enable debugging and therefore 
                        will make the page vulnerable.
                    </p>
                    <h3> Step Eight: </h3>
                    <p>
                        The app will by default run on <b>IIS Express</b>. In order to test for the vulnerability, you must
                        run the app in debug moce via IIS Express. This will open a browser with the app loaded. Use the 
                        address of the browser to hit the site.
                    
                </div>
            </div>
        </div>
    </body>
</html>