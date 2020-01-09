<!DOCTYPE hmtl>
<html>
    <head>
        <title> Cross Origin Resource Sharing (CORS) Page </title>
        <link rel="stylesheet" href="../../resources/stylesheets/main.css"> 
        <!-- <meta http-equiv="Access-Control-Allow-Origin"content= * >
        <meta http-equiv="Access-Control-Allow-Credentials" content="true">
        <meta http-equiv="Access-Control-Allow-Methods" content ="POST">
        <meta http-equiv="Access-Control-Allow-Headers" content="Content-Type" > -->
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
                <h1> Cross Origin Resource Sharing (CORS)</h1>

                <p>
                Cross-Origin Resource Sharing (CORS) is a mechanism that uses additional HTTP headers to tell a browser
                to let a web application running at one origin (domain) have permission to access selected resources 
                from a server at a different origin. A web application executes a cross-origin HTTP request when it 
                requests a resource that has a different origin (domain, protocol, and port) than its own origin.
                <br>
                This page attempts to get resources from local host on my windows vm
                </p>

                 <script>
                    function cors() {
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("demo").innerHTML = alert(this.responseTest);
                            }
                        };
                        xhttp.open("GET","http://172.16.233.142/CORS/index.php/", true);
                        xhttp.withCredentials = true;
                        xhttp.send();
                    }

                </script> 


               <!-- <script>
                    var req = new XMLHTTPRequest();

                    req.open('GET', 'https://webscantest.com/', true);
                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            console.log(req.responseText);
                        }
                    };
                    req.setRequestHeader('Accept', 'application/json');
                    req.send()
                </script> -->
  
              <!--  <script>
                    const invocation = new XMLHttpRequest();
                    const url = 'http://http://demo.testfire.net/';

                    function callOtherDomain() {
                        if (invocation) {
                            invocation.open('GET', url, true);
                            invocaton.onreadysatechange = handler;
                            invocation.send();
                        }
                    }
                </script>


                <script>
                    const invocation = new XMLHttpRequest();
                    const url = 'http://bar.other/resources/post-here/';
                    const body = '<?xml?><person><name>Arun</name></person>';
                        
                    function callOtherDomain() {
                    if (invocation) {
                        invocation.open('POST', url, true);
                        invocation.setRequestHeader('X-PINGOTHER', 'pingpong');
                        invocation.setRequestHeader('Content-Type', 'application/xml');
                        invocation.onreadystatechange = handler;
                        invocation.send(body); 
                    }
                    }
                </script> 

                <script>
                    function createCORSRequest (method, url) {
                        var xhr = new XMLHttpRequest();
                        if ("withCredentials" in xhr ) {

                            //check if XMLHttpRequest object has a "withCredentials" property
                            //"withCrednetials" only exists on XMLHttpRequest2 objects
                            chr.open(method, url, true);
                        } else if (typeof XDomainRequest != "undefined") {

                            //otherwise, check if XDomainRequest
                            //XDomainRequest only exists in IE, and its IE's way of making CORS requests
                            xhr = new XDomainRequest();
                            xhr.open(method, url);
                        } else {

                            //otherwise, CORS is not supported by the browser
                            chr = null;
                        }
                        return xhr;
                        }

                        // Helper method to parse the title tag from the response.
                        function getTitle(text) {
                        return text.match('<title>(.*)?</title>')[1];
                        }

                    function makeCorsRequest() {
                        // This is a sample server that supports CORS.
                    var url = 'http://demo.testfire.net';

                    var chr = createCORSRequest('GET', url);
                    if (!xhr) {
                         throw new Error('CORS not supported');
                    }

                    xhr.onload = function() {
                        var responseText = xhr.responseText;
                        var title = getTitlt(text);
                        alert('Response from CORS request to ' + url + ': ' + title);
                    };

                    xhr.onerror = function() {
                        alert('Woops, there was an error making the request.');
                    };

                    xhr.qithCredentials = true;
                    Access-Control-Allow-Credentials: true;

                    xhr.send();

                    </script> --->
            </div>
        </div>
   </body>
</html>