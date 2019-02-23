
<?php
require "dtabase/db.php";
?>

<?php
if(isset($_POST['signup'])){
	//registration here
	$errors = [];
	if(trim($_POST['login']) == ''){
	$errors[] = "Введите логин";
    }

    if(trim($_POST['email']) == ''){
	$errors[] = "Введите email";
    }
    
    if($_POST['password'] == ''){
	$errors[] = "Введите пароль";
    }

    if($_POST['password_2'] != $_POST['password']){
    	$errors[] = "Повторный пароль введен неверно!";
    }
    $mysqli = new mysqli("localhost", "root", "", "registration");
    $result = $mysqli->query(
    	"SELECT * FROM users WHERE users_login = '$_POST[login]';");
    $rows = $result->num_rows;
    if($rows > 0){
    	$errors[] = "Пользователь с таким логином уже существует!";
    }
    $result->close();

    $result = $mysqli->query(
    	"SELECT * FROM users WHERE users_email = '$_POST[email]';");
    $rows = $result->num_rows;
    if($rows > 0){
    	$errors[] = "Пользователь с таким email уже существует!";
    }
    $result->close();
    $mysqli -> close();
    
    if(empty($errors)){
    	//it is ok, regisration
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $mysqli = new mysqli("localhost", "root", "", "registration");
    $mysqli->query(
    	"INSERT INTO users VALUES(
    		NULL,
    		'$login',
    		'$email',
    		'$password');");
    $mysqli->close();
    echo'<div style="color: green;">Вы успешно зарегистрированы!</div><hr>';
    }else{
    	echo'<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }
}
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("./strawberry.jpg");
        }
    </style>
    </head>
<body>
<form action="./signup.php" method="POST">
    <div class="container">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Пользователь</span>
  </div>
  <input type="text" name="login" class="form-control" aria-label="login" aria-describedby="basic-addon1" placeholder="Ваш логин">
</div>

<div class="input-group mb-3">
  <input type="email" name="email" class="form-control" placeholder="Ваш email" aria-label="Recipient's email" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2">@example.net</span>
  </div>
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Идентификатор</span>
  </div>
  <input type="password" name="password" class="form-control" aria-label="password" aria-describedby="basic-addon1" placeholder="Ваш пароль">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Повторный идентификатор</span>
  </div>
  <input type="password" name="password_2" class="form-control" aria-label="password" aria-describedby="basic-addon1" placeholder="Повторите ваш пароль">
</div>
</div>

<div class="container" align="center">
	<button type="button" name="signup" class="btn btn-success btn-lg">Регистрация</button>
</div>

</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>