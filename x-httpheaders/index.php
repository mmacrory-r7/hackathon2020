<html>  
	<head>  
		<title>  
			X-HTTP Header Page
		</title> 
	<link rel="stylesheet" href="../resources/stylesheets/main.css">
	</head>
	<body class="body1">
    <div id="content" >
       <div id="header" class="ui-dark-header">
         <div id="r7-logo">
           <a href="../index.html"><img class="logo" src="../resources/images/Rapid7_logo.png"></a>
         </div>
       </div>
    </div>
    <div id="main">
       <div id="launch" class="launchSuite">
            <h1>X-HTTP Headers Page<h1>
            <h2>Vulnerabilities included:</h2>
            <h3>X-Content-Type-Options</h3>
                <br>
                    <p>
                         The X-Content-Type-Option response HTTP header is a marker used by the server to indicate
                         that the MIME types advertised in the Content-Type headers should not be changed and should be followed.
                    </p>
                <br>

                <h3>X-Frame-Options</h3>
                <br>
                    <p>
                    The X-Frame-Options response header can be used to indicate whether or not a browser should  be allowed to render a page in a frame,
                    iframe, embed or object. Sites can use this to avoid clickjacking attacks, by ensuring tahat their content is not embedded
                    into other sites. This added security is only provided if the user accessing the document is using a browser supporting X-Frame-Options.
                    </p>
                <br>
                <h3>X-Powered-By </h3>
                <br>
                    <p>
                        Sepecifies the technology supporting the web application. Version details are often in X-Runtime, X-Version, or X-AspNet-Version.
                    </p>
                <br>
                <h3>X-XSS-Protection</h3>
                <br>
                    <p>
                        The HTTP-X-XSS-Protection response header is a feature of Internet Explorer, Chrome and Safari, that stops pages from loading when
                        they detect reflected cross-site-scripting attacks. Although, these protections are largely unnecessary in modern browsers when sites
                        implement a strong Content-Security-Policy that disables the use of inline JavaScript, they can still provide protections for users
                        of older web browsers that don't yet support CSP.
                    </p>
                <br>

            The relevent flags for each of these has not been included in this page and therefore it is vulnerable to all of the above.
            </p>
         </div>
       </div>
	</body>  
</html>