<?php
$host = "localhost"; /* host name*/
$user = "root"; /* User */
$dbname = "sessionupgrade"; /* Database name */

$con = mysqli_connect($host, $user);

// Check connection
if(!$con)  
{  
    die("Connection failed: " . mysqli_error($con));
}  

$sel = mysqli_select_db($con, $dbname);
if(!$sel)  
{  
    die("Database selection failed: " . mysqli_error($con));
}  