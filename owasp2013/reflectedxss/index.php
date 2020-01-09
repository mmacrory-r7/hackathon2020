<!DOCTYPE html>
<html>  
	<head>  
		<title> Reflected XSS Page </title>  
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
		<h1>Reflected XSS Message Board</h1>  
		<h2>About This Page</h2>
		<p>
		Vulnerable to reflected XSS attack via the 'name' field.
		<br>
		<br>
		Example:
		<br>
		Insert <i>&lt;script&gt;alert("Persistent XSS")&lt;/script&gt;</i> in username field.
		
    Hitting submit button will result in page <i>http:/../reflectedxss.test</i>, 
    an alert box on the page.
		</p>
		<hr>  
		<h2>Enter Message</h2>
		<form method="post" id="messageboard">   
			<label>Name</label><br><br>  
			<input type="text" placeholder="Enter name here ..." name="name">  
			<br><br>  
			<label>Message</label><br><br>  
			<textarea name="message" placeholder="Enter text here ..."></textarea>
			<br><br>
			<input type="submit" value="Submit" name="submit">  
		</form>  
		<hr>
		<h2>Messages</h2>
			</div>
		</div>
	</body>  
</html> 

<?php 
	if(isset($_POST['submit'])){ 
		?>
		<tr>
		<td><?php echo 'Name: '; echo $_POST['name'];?></td>
		<br>
		<td><?php echo 'Message: '; echo $_POST['message'];?></td>
		<br><br>
		</tr>
		<?php
	}
	?><hr><?php
?>