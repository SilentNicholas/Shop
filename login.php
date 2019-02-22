<?php
require "dtabase/db.php";

if(isset($_POST['do_login'])){
	$errors = [];
	$mysqli = new mysqli("localhost", "root", "", "registration");
	$user = $mysqli->query(
		"SELECT users_login FROM users WHERE users_login = '$_POST[login]';");
$users = $user->fetch_row();
if($users[0] == $_POST['login']){
	//if login exist
	$user->close();
$pass = $mysqli->query(
		"SELECT users_password FROM users WHERE users_login = '$_POST[login]';");
$row_pass = $pass->fetch_row();
if(password_verify($_POST['password'], $row_pass[0])){
//it is ok remember user
	$pass->close();
	$info = $mysqli->query(
		"SELECT * FROM users WHERE users_login = '$_POST[login]';");
	$inform = $info->fetch_row();
	$_SESSION['remb_user'] = $inform;
	echo'<div style="color: green;">Вы успешно авторизованы!<br>
	Можете перейти на <a href="./registration.php">главную</a> страницу!</div><hr>';
	$info->close();
	$mysqli->close();
}else{
    $errors[] = "Пароль введен неверно!";
}
}else{
	$errors[] = "Пользователь с таким логином не найден!";
}

 if( ! empty($errors)){
    	echo'<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }
}
?>

<form action="./login.php" method="POST">

<p>
	<p><strong>Логин</strong></p>
	<p><input type="text" name="login"></p>
</p>

<p>
	<p><strong>Пароль</strong></p>
	<input type="password" name="password">
</p>

<p>
	<button type="submit" name="do_login">Войти</button>
</p>

</form>