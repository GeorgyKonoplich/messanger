<?php

session_start();
require_once("includes/connect_i.php");

if (!$_GET['in']){
	$pageid2 = '1';
}else{
	$pageid2 = str_replace("[^0-9]", "", $_GET['in']);
}

$sqlCommand = "SELECT id, username FROM users WHERE username='" . $_SESSION['username'] . "'";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());
while ($row = mysqli_fetch_array($query)){
	$pid = $row["id"];
	$username = $row["username"];
}
mysqli_free_result($query);

$sqlCommand = "SELECT id, userid, from_id, from_username, title, content, recieve_date FROM pm_imbox WHERE id='$pageid2' AND userid='$pid'";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());
while ($row = mysqli_fetch_array($query)){
	$hid = $row["id"];
	$huserid = $row["userid"];
	$hfrom_id = $row["from_id"];
	$hfrom_username = $row["from_username"];
	$htitle = $row["title"];
	$hcontent = $row["content"];
	$hrecieve_date = $row["recieve_date"];
}
mysqli_free_result($query);

$query = mysqli_query($myConnection, "UPDATE pm_imbox SET viewed='1' WHERE id='$pageid2'")  or die (mysqli_error($myConnection));;

?>

<html>
	<head>
		<title> messenger </title>
		<link href="images/style.css" rel="stylesheet" type="text/css" /> 
	</head>

	<body>
	<center>	
		<?php  require_once "pm_check.php"; ?>
		</br>
		<?php print $htitle; ?>
		</br>
		<?php print $hcontent; ?>
		</br>
		<?php print $hrecieve_date; ?>  
	</center>		
	</body>

</html>