<?php
require "dtabase/db.php";
?>

<?php
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
	$_SESSION['remb_user'] = $inform; ?>
	
	<?= header("Location: ./registration.php")?>

<?php
	$info->close();
	$mysqli->close();
}else{
    $errors[] = "Пароль введен неверно!";
}
}else{
	$errors[] = "Пользователь с таким логином не найден!";
}

 if(!empty($errors)){?>
<div class="container">
 <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Данные некорректны!</strong> <?=array_shift($errors)?>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
   </button>
 </div>
</div>
   <?php }
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" href="bootstrap/css/bootstrap.min.css">
	<style>
		body {
			background-image: url("picture/enter.jpg");
		}
	</style>
	</head>
<body>
 <div align="right">
  <div class="mt-3 col">
   <a class="btn btn-danger" btn-lg" href="./logout.php"" role="button">Выход</a>
  </div>
 </div>
<div class="jumbotron container" align="center">
<form action="./login.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1"><strong>Логин</strong></label>
    <input type="text" class="form-control form-control" name="login" placeholder="Введите логин">
    <small id="emailHelp" class="form-text text-muted">Мы никогда не рассказываем личные данные пользователей!</small>
  </div>
  <div class="form-group">
  <label for="exampleInputPassword1"><strong>Пароль</strong></label>
    <input type="password" class="form-control" name="password" placeholder="Введите пароль">
</div>
<div>
<button type="submit" name="do_login" class="btn btn-primary">Войти</button>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>