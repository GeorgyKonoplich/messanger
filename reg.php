<?
require_once("includes/connect.php");

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
        # ������� ������ ������� � ������ ������� ����������
        $password = $_POST['password'];

        mysql_query("INSERT INTO users SET username='".$login."', password='".$password."'");
        header("Location: index.php"); exit();

    }else{
        print "<b>��� ����������� ��������� ��������� ������:</b><br>";
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
<center>
<form method="POST">

����� <input name="login" type="text"><br>

������ <input name="password" type="password"><br>

<input name="submit" type="submit" value="������������������">

</form>
</center>
</body>
</html>
