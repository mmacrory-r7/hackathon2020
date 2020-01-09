<?php 
	if(isset($_POST['submit'])){ 
		
		$con = mysqli_connect('127.0.0.1','root','');  

		if(!$con)  
		{  
				echo 'not connect to the server';  
				die(mysqli_error);
		}  
	
		if(!mysqli_select_db($con,'persistentxss'))  
		{  
				echo 'database not selected';  
				die(mysqli_error);
		}  

		$name = $_POST['name'];  
		$message = $_POST['message'];   	
	
		$sql = "INSERT INTO person ( Name, Message ) VALUES ('$name','$message')"; 
	
		if(!mysqli_query($con, $sql))  
		{  
				echo 'Not inserted';			
		}   
	}
?>

<!DOCTYPE html>
<html>  
	<head>  
		<title> Persistent XSS Page </title>  
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
		<h1>Persistent XSS Message Board</h1>  
		<h2>About This Page</h2>
		<p>
		Vulnerable to persistent XSS attack via the 'name' field.
		<br><br>
		Example:
		<br>
		Insert <i>&lt;script&gt;alert("Persistent XSS")&lt;/script&gt;</i> in name field.
		This will be inserted in the database.
		
		Then reloading the page <i>http:/..//persistentxss.test</i>, the contents of the
		database will be loaded, resulting in an alert box on the page.
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
	$con = mysqli_connect('127.0.0.1','root','');  
		
	if(!$con)  
	{  
			echo 'not connect to the server';  
			die(mysqli_error);
	}  

	if(!mysqli_select_db($con,'persistentxss'))  
	{  
			echo 'database not selected';
			die(mysqli_error);			
	}  
	
	$results = $con->query("SELECT * FROM person LIMIT 500");
	while($row = mysqli_fetch_array($results))
	{
		?>
			<tr>
			<td><?php echo 'Name: '; echo $row['Name'];?></td>
			<br>
			<td><?php echo 'Message: '; echo $row['Message'];?></td>
			<br><br>
			</tr>
		<?php
	}
	?><hr><?php
?>  