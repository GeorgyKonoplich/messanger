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
$to_userid = $_POST['to_userid'];

$sqlCommand = "SELECT id, username FROM users WHERE id='$to_userid' LIMIT 1";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());

while ($row = mysqli_fetch_array($query)){
	$TOid = $row["id"];
	$TOuser = $row["username"];
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
		Welcome, 
		<?php 
			print $username;
			require_once "pm_check.php"; 
		?>
		</br>
		<table width="800" border="0">
			<form method="post" action="pm_send_to.php">
				<tr>
					<td width="185">Sending to:</td>
					<td width="605"><input name="to_username" type="text" id="to_username" readonly="readonly" value="<?php print $TOuser; ?>" 
					size="40" style="border:hidden1"/> </td>
				</tr>
				<tr>
					<td width="185">Title:</td>
					<td width="605"><input name="title" type="text" id="title" size="40"/> </td>
				</tr>
				<tr>
					<td width="185">Message:</td>
					<td width="605"><textarea name="message" id="message" cols="41" rows="10"></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="submit1" id="submit1" value="Send message to <?php print $TOuser; ?>"/>
					<input name="to_userid" type="hidden" id="to_userid" value="<?php print $TOid; ?>"/>
					<input name="userid" type="hidden" id="userid" value="<?php print $pid; ?>"/>
					<input name="from_username" type="hidden" id="from_username" value="<?php print $username; ?>"/>
					<input name="senddate" type="hidden" id="senddate" value="<?php echo date("1, jS F Y, g:i:s a"); ?>"/></td>
				</tr>

			
				<?php 
				if ($_POST['submit1']){
					$to_username = $_POST['to_username'];
					$title = $_POST['title'];
					$message = $_POST['message'];
					$to_userid = $_POST['to_userid'];
					$userid = $_POST['userid'];
					$from_username = $_POST['from_username'];	
					$senddate = $_POST['senddate'];
					require_once("includes/connect_i.php");

					$query = mysqli_query($myConnection, "INSERT INTO pm_outbox (userid, username, to_userid, to_username, title, content, senddate)
					VALUES('$userid', '$from_username', '$to_userid', '$to_username', '$title', '$message', '$senddate')") or die (mysqli_error($myConnection));
					$query = mysqli_query($myConnection, "INSERT INTO pm_imbox (userid, username, from_id, from_username, title, content, recieve_date)
					VALUES('$to_userid', '$to_username', '$userid', '$from_username', '$title', '$message', '$senddate')") or die (mysqli_error($myConnection));
					echo "<meta http-equiv=\"refresh\" content=\"0; URL=pm_outbox.php\">";
					exit();
					
				}
				?>
			</form>
		</table>
		</center>
	</body>
</html>