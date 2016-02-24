<?php

session_start();
require_once("includes/connect_i.php");

if (!$_GET['out']){
	$pageid = '1';
}else{
	$pageid = str_replace("[^0-9]", "", $_GET['out']);
}

$sqlCommand = "SELECT id, username FROM users WHERE username='" . $_SESSION['username'] . "'";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());
while ($row = mysqli_fetch_array($query)){
	$pid = $row["id"];
	$username = $row["username"];
}
mysqli_free_result($query);

$sqlCommand = "SELECT id, userid, to_userid, to_username, title, content, senddate FROM pm_outbox WHERE id='$pageid' AND userid='$pid'";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());
while ($row = mysqli_fetch_array($query)){
	$hid = $row["id"];
	$huserid = $row["userid"];
	$hfrom_id = $row["to_userid"];
	$hfrom_username = $row["to_username"];
	$htitle = $row["title"];
	$hcontent = $row["content"];
	$hrecieve_date = $row["senddate"];
}
mysqli_free_result($query);

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
		To: <?php print $hfrom_username; ?>
		</br>
		<?php print $htitle; ?>
		</br>
		<?php print $hcontent; ?>
		</br>
		<?php print $hrecieve_date; ?>  
	</center>	
	</body>

</html>