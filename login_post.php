<?php

session_start();

$username = $_POST['login'];
$password = $_POST['password'];

if ($username && $password){
	require_once("includes/connect.php");
	$query = mysql_query("SELECT * FROM users WHERE username='$username'");
	$numrows = mysql_num_rows($query);
	if ($numrows != 0){
		while($row = mysql_fetch_assoc($query)){
			$dbusername = $row['username'];
			$dbpassword = $row['password'];

		}
		if ($username == $dbusername && $password == $dbpassword){
			
			$_SESSION['username'] = $username;
			header("Location: index.php"); exit();
		}else{
			echo "Incorrect password";

		}
	}else{ 
	die ("Account does not exist");
	}

}else{
	die("Please fill in both fields!");

}

?>