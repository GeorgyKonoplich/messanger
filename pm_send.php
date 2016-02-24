<?php
	session_start();
	require_once "includes/connect.php";

	$sql="SELECT id, username FROM users WHERE showing='1'";
	$result = mysql_query($sql);

	$options="";
	while ($row = mysql_fetch_array($result)){
	    $USERid = $row['id'];
		$USERname = $row['username'];
		$options.= "<OPTION VALUE=\"$USERid\">".$USERname."</OPTION>";
	}

?>

<html>
	<head>
		<title> messenger </title>
		<link href="images/style.css" rel="stylesheet" type="text/css" /> 
	</head>

	<body>
	<center>	
		Welcome, <?php print $_SESSION['username'];?>!
		<?php  require_once "pm_check.php"; ?>
		</br>
		<table width="800" border="0">
			<form name="form" id="form" method="post" action="pm_send_to.php" onsubmit="return validate_form();">
				<tr>
				 	<td width="185">Select User:</td>
				 	<td width="605"><select name="to_userid" id="to_userid">
				 	<OPTION VALUE=0>
				 	<?php echo $options; ?>  
				 	</td>
				</tr>
				<tr>
				 	<td colspan="2"><input type="submit" name="submit" id="submit" value="Select User"></td>
				</tr>
			</form>	
	  
	    </table>
	  </center>
	</body>
</html>