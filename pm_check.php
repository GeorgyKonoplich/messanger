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

//check for new messages

$sqlCommand = "SELECT COUNT(id) AS numbers FROM pm_imbox WHERE userid='$pid' AND viewed='0'";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());
$result = mysqli_fetch_array($query);
$inboxMessagesNew = $result['numbers'];

//check for all messages in the inbox

$sqlCommand = "SELECT COUNT(id) AS numbers FROM pm_imbox WHERE userid='$pid'";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());
$result = mysqli_fetch_array($query);
$inboxMessagesTotal = $result['numbers'];

//check for all messages in the outbox

$sqlCommand = "SELECT COUNT(id) AS numbers FROM pm_outbox WHERE userid='$pid'";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());
$result = mysqli_fetch_array($query);
$outboxMessages = $result['numbers'];

?>

<?php if ($_SESSION['username']) {?>
</br>
Message System: <a href="pm_inbox.php">Inbox</a> <?php if ($inboxMessagesNew > 0) { print "<b>(".$inboxMessagesNew.")</b>";}else {} ?>
<?php print $inboxMessagesTotal; ?>, <a href="pm_outbox.php">Outbox</a> <?php print $outboxMessages; ?>, <a href="pm_send.php">Send New Message</a>
|| <a href="edit.php">Edit Profile</a> || <a href="logout.php">Logout</a><?php } else { print "You must be logged in first"; } ?> 

