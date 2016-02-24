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
//check for all messages in the inbox

$sqlCommand = "SELECT COUNT(id) AS numbers FROM pm_imbox WHERE userid='$pid'";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());
$result = mysqli_fetch_array($query);
$inboxMessagesTotal = $result['numbers'];



?>



<html>
	<head>
		<title> messenger </title>
		<link href="images/style.css" rel="stylesheet" type="text/css" /> 
	</head>

	<body>
	<center>
		<?php if ($_SESSION['username']) { ?>
		Welcome, <?php print $username;?>!
		<?php  require_once "pm_check.php"; ?>
		</br>  
		<?php 
			require_once "includes/connect.php"; 
		    $sql = "SELECT * FROM pm_imbox WHERE userid='$pid' ORDER by id DESC";
			$result = mysql_query($sql);

			$count = mysql_num_rows($result);
		?>
		<table width="800" border="0">
		<form name="form1" method="post" action="pm_inbox.php">
			<tr>
				<td width="41" align="center">#</td>
				<td width="490">Title:</td>
				<td width="255">From:</td>
			</tr>
			<?php
			 	while($rows=mysql_fetch_array($result)){
			?>
			<?php if ($rows['viewed'] == 0){ //show messages in bold ?>
			<tr>
				<td width="41" align="center"><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $rows['id']; ?>" /></td>
				<td width="490"><a href="pm_view_in.php?in=<?php echo $rows['id']; ?>"><b><?php echo $rows['title']; ?> </b></a></td>
				<td width="255"><?php echo $rows['from_username']; ?></td>
			</tr>
			<?php } else if ($rows['viewed'] == 1) { ?>
			<tr>
				<td width="41" align="center"><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $rows['id']; ?>" /></td>
				<td width="490"><a href="pm_view_in.php?in=<?php echo $rows['id']; ?>"><?php echo $rows['title']; ?></a></td>
				<td width="255"><?php echo $rows['from_username']; ?></td>
			</tr>
			<?php } ?>
			<?php } ?>
			<tr>
				<td colspan ="3" align="center"> <?php if ($inboxMessagesTotal > 0) {?> <input type="submit" name="delete" id="delete" value="Delete Selected Messages"/>
				<?php }else { print "Thre are no messages in your Inbox"; }	?></td>
			</tr>
			<?php
				if ($_POST['delete']){
					$checkbox = $_POST['checkbox'];
					$delete = $_POST['delete'];
					if ($delete){
						for ($i = 0; $i < $count; $i++){
							$del_id = $checkbox[$i];
							$sql = "DELETE FROM pm_imbox WHERE id='$del_id'";
							$result = mysql_query($sql);
							if ($result){
								echo "<meta http-equiv=\"refresh\" content=\"0;URL=pm_inbox.php\">";
							}
						}
						mysql_close();
					}else
					{
						
					}
			   	}
			?>
		</form>
		</table>
		<?php  } else { ?> Please login <a href="login.php">Login to your account</a> <?php } ?>
	</center>	
	</body>

</html>