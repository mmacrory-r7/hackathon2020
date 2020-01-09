<html>  
	<head>  
		<title>  
			OS Command Injection Page  
		</title>
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
            <h1>OS Command Injection Archive Text Count Page</h1>
            <h2>About This Page</h2>
            <p>
            Vulnerable to OS command injection attack via the 'search' field.
            <br><br>
            <b>Example:</b>
            <br><br>
            We can inject shell commands into the command run by the php script behind this page.<br>
            The page executes <i>shell_exec(find /I /C /N &lt;searchstring&gt; &lt;filetosearch&gt;)</i> (for Windows) or <i>shell_exec(grep -cni &lt;searchstring&gt; &lt;filetosearch&gt;)</i> (for Unix) and outputs the result to the screen.
            <br><br>
            By carefully crafting input by closing the search string early and joining commands using the '&amp;' character, e.g. <i><b>" &amp; tasklist &amp;</b></i> (for Windows) or <i><b>" &amp; ps -ef &amp;</b></i> (for Unix), we can make the command executed by <i>shell_exec(</i><br>
            instead evaulate as e.g. <i><b>shell_exec(find /I /C /N "" &amp; tasklist &amp; &lt;filetosearch&gt;)</b></i> thereby allowing us to run arbitrary commands on the underlying OS of the web server hosting this page.
            </p>
            <hr>
            <h2>Search the archive</h2>
            <form method="post" id="text">
                <label>Text to Search</label><br><br>
                <input type="text" placeholder="Search archive here ..." name="searchstring">
                <br><br>
                <input type="submit" value="Search" name="search">
            </form>
            <hr>
	    </div>
    </div>
	</body>  
</html> 

<?php 

	if(isset($_POST['search'])){ 
    
    if(!isset($_POST['searchstring'])) {

      ?><h2>Search Results</h2><br><?php
      ?>
        <tr>
        <td><?php echo 'An error occurred. Search string not specified.'?></td>
        <br><br>
        </tr>
      <?php
      die();
    }
    else {
      
      if(strcasecmp(substr(PHP_OS, 0, 3), 'WIN') == 0){
        // We are running Windows so lets use batch commands
        $occurrences = shell_exec('find /I /C "'.$_POST['searchstring'].'" "C:\\xampp\\htdocs\\oscommandinjection\\archive.txt"');
        $locations = shell_exec('find /I /N "'.$_POST['searchstring'].'" "C:\\xampp\\htdocs\\oscommandinjection\\archive.txt"');
      }
      else
      {
        // Assume Unix so run bash commands
        $occurrences = shell_exec('grep -ci '.$_POST['searchstring'].' /c/xampp/htdocs/oscommandinjection/archive.txt');
        $locations = shell_exec('grep -ni '.$_POST['searchstring'].' /c/xampp/htdocs/oscommandinjection/archive.txt');
      }

      ?><div id="launch" class="launchSuite"><h2>Search Results</h2><?php
      ?>
        <tr>
        <td><?php echo 'Search string: '; echo $_POST['searchstring'];?></td>
        <br>
        <td><?php echo 'Occurrences: '; echo $occurrences;?></td>
        <br>
        <td><?php echo 'Locations: '; echo $locations;?></td>
        <br><br>
        </tr></div>
      <?php
    }
  }
?>