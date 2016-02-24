<?php

session_start();
require_once("includes/connect_i.php");

$sqlCommand = "SELECT id, username FROM users WHERE username='" . $_SESSION['username'] . "'";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());
while ($row = mysqli_fetch_array($query)){
	$pid = $row["id"];
	$username = $row["username"];
}
mysqli_free_result($query);

?>

<html>
	<head>
		<title> messenger </title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
		<link href="images/style.css" rel="stylesheet" type="text/css" /> 
	</head>

	<body>
	<center>
		<?php if ($_SESSION['username']) { ?>
		Welcome back, <?php print $username;?>!
		<?php  require_once "pm_check.php"; 
		  
		  } else { ?> Авторизация: <a href="login.php">Sign in</a></br>  </br>Регистрация: <a href="reg.php">Sign up</a> <?php } ?>
	</center>
	</body>

</html>