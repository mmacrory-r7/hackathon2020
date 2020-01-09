<!DOCTYPE html>
<html>  
	<head>  
		<title>  
			SQL Injection Page  
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
		<h1>SQL Injection Employee Lookup Page</h1>  
		<h2>About This Page</h2>
		<p>
		Vulnerable to SQL injection attack via the 'name' field.
		</p>
		<hr>  
		<h2>Lookup Employee by Department ID</h2>
		<form method="post" id="username">   
			<label>Department to Search</label><br><br>  
			<input type="text" placeholder="Search department here ..." name="departmentid">  
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
    $con = mysqli_connect('127.0.0.1','root','');  
      
    if(!$con)  
    {  
        echo 'not connect to the server';  
        die(mysqli_error);
    }  

    if(!mysqli_select_db($con,'sqlinjection'))  
    {  
        echo 'database not selected';
        die(mysqli_error);			
    }  

    if(isset($_POST['departmentid']))
    {
      $departmentid = $_POST['departmentid'];

      $results = $con->query("SELECT employee_name, employee_email, employee_phone, employee_departmentid, employee_managerid FROM employees WHERE employee_departmentid=$departmentid LIMIT 5000");
      ?><h2>Details of Department</h2><br><?php
      while($row = mysqli_fetch_array($results))
      {
        ?>
          <tr>
          <td><?php echo 'Name: '; echo $row['employee_name'];?></td>
          <br>
          <td><?php echo 'Email: '; echo $row['employee_email'];?></td>
          <br>
          <td><?php echo 'Phone Number: '; echo $row['employee_phone'];?></td>
          <br>
          <td><?php echo 'Department ID: '; echo $row['employee_departmentid'];?></td>
          <br>
          <td><?php echo 'Manager ID: '; echo $row['employee_managerid'];?></td>
          <br><br>
          </tr>
        <?php
      }
    }
    ?><hr><?php
  }
?>