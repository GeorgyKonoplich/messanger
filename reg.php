<?
require_once("includes/connect.php");

if(isset($_POST['submit'])){

    $err = array();
    # проверям логин

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])){
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";

    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30){

        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";

    }

    # проверяем, не сущестует ли пользователя с таким именем
    $query = mysql_query("SELECT COUNT(id) FROM users WHERE username='".mysql_real_escape_string($_POST['login'])."'");

    if(mysql_result($query, 0) > 0){
        $err[] = "Пользователь с таким логином уже существует в базе данных";

    }

    # Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0){
        $login = $_POST['login'];
        # Убираем лишние пробелы и делаем двойное шифрование
        $password = $_POST['password'];

        mysql_query("INSERT INTO users SET username='".$login."', password='".$password."'");
        header("Location: index.php"); exit();

    }else{
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
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

Логин <input name="login" type="text"><br>

Пароль <input name="password" type="password"><br>

<input name="submit" type="submit" value="Зарегистрироваться">

</form>
</center>
</body>
</html>
