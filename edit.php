<?
session_start();
require_once("includes/connect.php");
require_once("includes/connect_i.php");

$sqlCommand = "SELECT id, username FROM users WHERE username='" . $_SESSION['username'] . "'";
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error());
while ($row = mysqli_fetch_array($query)){
	$pid = $row["id"];
	$username = $row["username"];
}
mysqli_free_result($query);


if(isset($_POST['submit'])){

    $err = array();
    # �������� �����

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])){
        $err[] = "����� ����� �������� ������ �� ���� ����������� �������� � ����";

    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30){

        $err[] = "����� ������ ���� �� ������ 3-� �������� � �� ������ 30";

    }

    # ���������, �� ��������� �� ������������ � ����� ������
    $query = mysql_query("SELECT COUNT(id) FROM users WHERE username='".mysql_real_escape_string($_POST['login'])."'");

    if(mysql_result($query, 0) > 0){
        $err[] = "������������ � ����� ������� ��� ���������� � ���� ������";

    }

    # ���� ��� ������, �� ��������� � �� ������ ������������
    if(count($err) == 0){
        $login = $_POST['login'];

		$query = mysqli_query($myConnection, "UPDATE users SET username='$login' WHERE id='$pid'")  or die (mysqli_error($myConnection));;
		$_SESSION['username'] = $login;
        header("Location: index.php"); exit();

    }else{
        print "<b>��� ��������� ����� ��������� ��������� ������:</b><br>";
        foreach($err AS $error){
            print $error."<br>";

        }
    }
}
?>


<html>
<head>
	<link href="images/style.css" rel="stylesheet" type="text/css" /> 
</head>
<body>
<a href="index.php">back</a></br>
<center>
������������� �������<br/>
���: <?php print $username; ?></br>

<form method="POST">

�������� ���: <input name="login" type="text"><br>

<input name="submit" type="submit" value="���������">

</form>
</center>
</body>
</html>
